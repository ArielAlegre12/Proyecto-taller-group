<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
</head>

<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:40px;">

```
<div style="max-width:700px; margin:auto; background:white; padding:40px; border-radius:10px;">

    <div style="text-align:center; margin-bottom:30px;">
        <h1 style="color:#198754; margin-bottom:10px;">Huellas Felices 🐾</h1>
        <h2 style="margin:0;">Turno Reprogramado</h2>
    </div>

    <p>
        Hola <strong>{{ $turno->usuario->nombre }}</strong>.
    </p>

    <p>
        Te informamos que tu turno fue reprogramado por nuestro equipo.
    </p>

    <hr style="margin:25px 0;">

    <div style="background:#fff3cd; padding:20px; border-radius:8px;">
        <p>
            <strong>Fecha anterior:</strong><br>
            {{ \Carbon\Carbon::parse($turno->fecha_original)->format('d/m/Y H:i') }}
        </p>

        <p>
            <strong>Nueva fecha:</strong><br>
            {{ \Carbon\Carbon::parse($turno->fechaYHora)->format('d/m/Y H:i') }}
        </p>
    </div>

    <div style="margin-top:25px;">
        <p>
            Por favor ingresa a tu perfil para aceptar o rechazar el nuevo horario.
        </p>
    </div>

    <hr style="margin:30px 0;">

    <div style="text-align:center; color:#777;">
        <p>Gracias por confiar en Huellas Felices 🐾</p>
        <p>Ante cualquier duda puedes comunicarte con nosotros.</p>
    </div>

</div>
```

</body>

</html>
