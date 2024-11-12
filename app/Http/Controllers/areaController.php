<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeAreasrequest;
use App\Http\Requests\updateAreasrequest;
use App\Models\area;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class areaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // LLamamos al modelo areas
        $areas = area ::get();

        return view('areas.areas-usuarios',['areas' => $areas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeAreasrequest $request)
    {
        //dd($request);
        try{
            DB::beginTransaction();
            $areas = area::create($request->validated());
            DB::commit();

        }catch(Exception $e){
            DB::rollBack();

        }
        return redirect()->route('areas.index')->with('success','area registrada exitosamente');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateAreasrequest $request, area $area)
    {
        //
         //dd($request);
         try{
            DB::beginTransaction();
            $area -> update($request -> validated());
            DB::commit();
            return redirect()->route('areas.index');
        } catch (Exception $e){
            DB::rollBack();
            return redirect()->route('areas.index');
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
        try{
            $area = area::findOrFail($id);
            $area -> delete();
            return redirect()->route('areas.index');

        }catch(Exception $e){
            return redirect()->route('areas.index');

        }
    }
}
