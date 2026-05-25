<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:40px;">
    
    <div style="
        max-width:600px;
        margin:auto;
        background:white;
        padding:40px;
        border-radius:10px;
        text-align:center;
    ">
    <h2 style="color:#198754;">Nueva Consulta</h2>
    <p><strong>Cliente:</strong>{{ $consulta->nombre }}</p>
    <p><strong>Telefono:</strong>{{ $consulta->telefono }}</p>
    <p><strong>Email:</strong>{{ $consulta->email }}</p>
    <p><strong>Animal:</strong>{{ $consulta->nombre_animal }}</p>
    <p><strong>Tipo:</strong>{{ $consulta->tipo_animal }}</p>
    <p><strong>Consulta:</strong>{{ $consulta->tipo_consulta }}</p>
    <p><strong>Fecha:</strong>{{ $consulta->fecha_hora }}</p>
    <p><strong>Descripcion:</strong>{{ $consulta->descripcion}}</p>
    </div>
</body>
</html>