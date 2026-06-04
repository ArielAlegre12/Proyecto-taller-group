<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:40px;">

    <div style=" max-width:700px; margin:auto; background:white; padding:40px; border-radius:10px; ">

        <div style="text-align:center; margin-bottom:30px;">
            <h1 style="color:#198754; margin-bottom:10px;"> Huellas Felices 🐾 </h1>
            <h2 style="margin:0;"> Factura de Compra </h2>
        </div>

        <p>Hola <strong>{{ $venta->usuario->nombre }}</strong>, gracias por realizar tu compra.</p>

        <p>Tu pedido fue registrado correctamente.</p>

        <hr style="margin:25px 0;">

        <h3 style="margin-bottom:20px;">Detalle de la compra</h3>

        <table cellpadding="10" cellspacing="0" width="100%" style="border-collapse: collapse;">
            <thead>
                <tr style="background:#198754; color:white;">
                    <th align="left">Producto</th>
                    <th align="center">Cantidad</th>
                    <th align="right">Precio</th>
                    <th align="right">Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($venta->detalles as $detalle)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td>{{ $detalle->nombre_producto }}</td>
                        <td align="center">{{ $detalle->cantidad }}</td>
                        <td align="right">${{ number_format($detalle->precio, 2)  }}</td>
                        <td align="right">${{ number_format($detalle->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:30px;">
            <p><strong>Metodo de pago:</strong> {{ ucfirst($venta->metodo_pago) }}</p>

            <p><strong>Metodo de entrega:</strong> {{ ucfirst($venta->metodo_entrega) }}</p>

            <h2 style=" text-align:right; color:#198754; margin-top:30px;">Total: ${{ number_format($venta->total, 2)}}
                </h3>

        </div>
        <hr style="margin:30px 0;">
        <div style="text-align:center; color:#777;">
            <p> Gracias por confiar en Huellas Felices 🐾 </p>

            <p> Ante cualquier duda puedes comunicarte con nosotros. </p>

        </div>

    </div>
</body>

</html>