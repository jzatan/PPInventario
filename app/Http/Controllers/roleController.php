<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Termwind\Components\Raw;

class roleController extends Controller
{
    
    function __construct() {

        $this->middleware('permission:ver-roles',['only'=>['index']]);
        $this->middleware('permission:create-roles',['only'=>['create']]);
        $this->middleware('permission:store-roles',['only'=>['store']]);
        $this->middleware('permission:editar-roles',['only'=>['edit']]);
        $this->middleware('permission:update-roles',['only'=>['update']]);
        $this->middleware('permission:delete-roles',['only'=>['destroy']]);

    }

    public function index()
    {
        //
        $roles = Role::all();
        return view('privilegios.roles-users', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permisos = Permission::all();
        return view('privilegios.store-roles', compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permission' => 'required|array',
            'permission.*' => 'exists:permissions,id'
        ]);

        try {
            DB::beginTransaction();

            // Crear el rol
            $role = Role::create([
                'name' => $validated['name'],
                'guard_name' => 'web'
            ]);

            // Obtener los permisos como colección
            $permissions = Permission::whereIn('id', $validated['permission'])->get();

            // Asignar permisos al rol
            $role->syncPermissions($permissions);

            DB::commit();

            return redirect()
                ->route('roles.index')
                ->with('success', 'Rol y permisos asignados correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear el rol o asignar permisos: ' . $e->getMessage());

            return redirect()
                ->route('roles.index')
                ->withErrors(['error' => 'Hubo un error al crear el rol o asignar los permisos.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        $permisos = Permission::all();
        return view('privilegios.update-roles', compact('role', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validación
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permission' => 'required|array',
            'permission.*' => 'exists:permissions,id'
        ]);

        try {
            DB::beginTransaction();

            // Obtener el rol
            $role = Role::findOrFail($id);

            // Actualizar el nombre
            $role->update(['name' => $validated['name']]);

            // Obtener los permisos como colección
            $permissions = Permission::whereIn('id', $validated['permission'])->get();

            // Sincronizar permisos (esto elimina los permisos antiguos y asigna los nuevos)
            $role->syncPermissions($permissions);

            DB::commit();

            return redirect()
                ->route('roles.index')
                ->with('success', 'Rol y permisos actualizados correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar el rol o permisos: ' . $e->getMessage());

            return redirect()
                ->route('roles.index')
                ->withErrors(['error' => 'Hubo un error al actualizar el rol o los permisos.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            DB::beginTransaction();

            // Buscar el rol
            $role = Role::findOrFail($id);

            // Verificar si el rol está en uso
            if ($role->users->count() > 0) {
                return redirect()
                    ->route('roles.index')
                    ->withErrors(['error' => 'No se puede eliminar el rol porque está asignado a uno o más usuarios.']);
            }

            // Eliminar los permisos asociados al rol
            $role->syncPermissions([]);

            // Eliminar el rol
            $role->delete();

            DB::commit();

            return redirect()
                ->route('roles.index')
                ->with('success', 'Rol eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar el rol: ' . $e->getMessage());

            return redirect()
                ->route('roles.index')
                ->withErrors(['error' => 'Hubo un error al eliminar el rol.']);
        }
    }
}
