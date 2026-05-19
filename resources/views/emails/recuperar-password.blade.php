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
        <h2 style="color:#198754;">Recuperacion de contraseña</h2>

        <p>Hola, recibimos una solicitud para recuperar tu contraseña.</p>

        <p>Tu codigo de verificacion es:</p>

        <h1 style="
            letter-spacing:8px;
            color:#198754;
            font-size:40px;
        ">{{ $codigo }}</h1>

        <p style="color:#666;">Si no solicitaste este codigo, ignora el mensaje.</p>
        <hr style="margin:30px 0; border:none; border-top:1px solid #ddd;">
        <small style="color:#999;">
            Huellas Felices
        </small>
    </div>
</body>

</html>