<!DOCTYPE html>
<html>

<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:40px;">

<div style="max-width:700px; margin:auto; background:white; padding:40px; border-radius:10px;">

    <div style="text-align:center;">
        <h1 style="color:#198754;">Huellas Felices 🐾</h1>
        <h2>Pedido Entregado</h2>
    </div>

    <p>Hola <strong>{{ $venta->usuario->nombre }}</strong>,</p>

    <p>
        Tu pedido fue entregado correctamente.
    </p>

    <div style="background:#f8f9fa; padding:20px; border-radius:8px;">
        <p><strong>N° Pedido:</strong> #{{ $venta->id }}</p>
        <p><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>
        <p><strong>Estado:</strong> Entregado</p>
    </div>

    <hr style="margin:30px 0;">

    <div style="text-align:center;">
        <p>Esperamos volver a verte pronto 🐾</p>
    </div>

</div>

</body>
</html>