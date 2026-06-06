<!DOCTYPE html>
<html>

<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:40px;">

    <div style="max-width:700px; margin:auto; background:white; padding:40px; border-radius:10px;">

        <div style="text-align:center; margin-bottom:30px;">
            <h1 style="color:#198754;">Huellas Felices 🐾</h1>
            <h2>Pago Confirmado</h2>
        </div>

        <p>Hola <strong>{{ $venta->usuario->nombre }}</strong>,</p>

        <p>
            Te informamos que hemos recibido correctamente el pago de tu pedido.
        </p>

        <div style="background:#f8f9fa; padding:20px; border-radius:8px; margin:25px 0;">
            <p><strong>N° de venta:</strong> #{{ $venta->id }}</p>
            <p><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>
            <p><strong>Estado:</strong> Pagado</p>
        </div>

        <p>
            Tu pedido comenzará a procesarse y te avisaremos cuando sea enviado.
        </p>

        <hr style="margin:30px 0;">

        <div style="text-align:center; color:#777;">
            <p>Gracias por confiar en Huellas Felices 🐾</p>
        </div>

    </div>

</body>
</html>