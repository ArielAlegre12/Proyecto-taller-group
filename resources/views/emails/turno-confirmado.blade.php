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
        <h2 style="margin:0;">Turno Confirmado</h2>
    </div>

    <p>
        Hola <strong>{{ $turno->usuario->nombre }}</strong>.
    </p>

    <p>
        Nos complace informarte que tu turno fue confirmado correctamente.
    </p>

    <hr style="margin:25px 0;">

    <div style="background:#d1e7dd; padding:20px; border-radius:8px;">
        <p>
            <strong>Fecha y hora:</strong><br>
            {{ \Carbon\Carbon::parse($turno->fechaYHora)->format('d/m/Y H:i') }}
        </p>

        @if(isset($turno->nombreMascota))
            <p>
                <strong>Mascota:</strong><br>
                {{ $turno->nombreMascota }}
            </p>
        @endif

        @if(isset($turno->nombreEstablo))
            <p>
                <strong>Establo:</strong><br>
                {{ $turno->nombreEstablo }}
            </p>
        @endif
    </div>

    <div style="margin-top:25px;">
        <p>
            Te esperamos en la fecha indicada.
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
