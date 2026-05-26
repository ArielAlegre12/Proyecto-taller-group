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
    <h2 style="color:#198754;">Consulta Cancelada</h2>
    
    <p>Hola {{ $consulta->nombre }}, tu consulta fue cancelada.</p>

    <p>
        <strong>Motivo:</strong>
        {{ $motivo }}
    </p>

    <p>Si necesitas mas informacion, comunicate con nosotros.</p>
</div>
    
</body>
</html>