<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Mantenimiento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>Reporte de Mantenimiento</h3>
    </div>
    <div class="content">
        <p><strong>PERSONAL RESPONSABLE:</strong> {{ $mantenimiento->mantenimiento_usuario->nombres }}</p>
        <p><strong>FECHA DE RETORNO:</strong> {{ $mantenimiento->mantenimiento_detalle->fecha_retorno }}</p>
        <p><strong>PROBLEMA:</strong> {{ $mantenimiento->mantenimiento_detalle->problema }}</p>
        <p><strong>DIAGNÓSTICO:</strong> {{ $mantenimiento->mantenimiento_detalle->diagnostico }}</p>
        <p><strong>OBSERVACIONES:</strong> {{ $mantenimiento->mantenimiento_detalle->observaciones }}</p>
        <p><strong>ESTADO:</strong> {{ $mantenimiento->mantenimiento_detalle->estado_mantenimiento }}</p>
    </div>
</body>
</html>
