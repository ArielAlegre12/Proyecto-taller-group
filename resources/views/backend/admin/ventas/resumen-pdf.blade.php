```blade
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resumen de ventas</title>
    <style>
        {!! file_get_contents(public_path('css/resumenPdf.css')) !!}
    </style>
</head>

<body>
    <!--header-->
    <div class="header">
        <div class="logo-container">
            <img src="{{ public_path('images/logoSF.png') }}" class="logo">
        </div>

        <div class="header-title">
            Resumen de ventas
        </div>

        <div class="fecha-resumen">
            Resumen desde
            <strong>
                {{ request('desde')
    ? \Carbon\Carbon::parse(request('desde'))->format('d/m/Y')
    : 'Inicio'}}
            </strong>

            hasta

            <strong>
                {{ request('hasta')
    ? \Carbon\Carbon::parse(request('hasta'))->format('d/m/Y')
    : 'Hoy'}}
            </strong>
        </div>

    </div>

    <!--cards-->
    <div class="cards">
        <div class="stat-card total-card">
            <small>Total vendido</small>

            <h3>
                ${{ number_format($totalVendido, 2, ',', '.') }}
            </h3>
        </div>

        <div class="stat-card pedidos-card">
            <small>pedidos</small>

            <h3>
                {{ $totalPedidos }}
            </h3>
        </div>

        <div class="stat-card ticket-card">
            <small>Ticket promedio</small>

            <h3>
                ${{ number_format($ticketPromedio, 2, ',', '.') }}
            </h3>
        </div>

        <div class="stat-card productos-card">
            <small>Productos vendidos</small>

            <h3>
                {{ $totalProductosVendidos }}
            </h3>
        </div>

    </div>

    <div class="two-columns">
        <!--mejores clientes-->
        <div class="section half">
            <h4>
                Mejores clientes
            </h4>

            @forelse($clienteTop as $cliente => $total)
                <div class="ranking-item">
                    {{ $cliente }}
                    <span>
                        ${{ number_format($total, 2, ',', '.') }}
                    </span>
                </div>
            @empty
                <p>Sin datos.</p>
            @endforelse
        </div>

        <!--productos destacados(más y menos vendidos)-->
        <div class="section half">
            <h4>Productos destacados</h4>
            @if ($cantidadProductos == 0)
                <p>
                    No hay datos suficientes para mostrar productos destacados.
                </p>
            @else
                <!--productos más vendidos-->
                <div class="producto-item">
                    <img src="{{ public_path('storage/' . $productosMasVendidos->first()?->imagen) }}" class="producto-img">

                    <div class="producto-info">
                        <small>Producto más vendido</small>
                        <strong>
                            {{ $productosMasVendidos->first()?->nombre ?? '-' }}
                        </strong>

                        <div class="cantidad-success">
                            {{ $productosMasVendidos->first()?->total_vendidos ?? 0 }}
                            vendido{{ ($productosMasVendidos->first()?->total_vendidos ?? 0) != 1 ? 's' : '' }}
                        </div>

                    </div>

                </div>
                @if ($cantidadProductos > 1)
                    <!--producto meno vendidos-->
                    <div class="producto-item">
                        <img src="{{ public_path('storage/' . $productoMenosVendido->imagen) }}" class="producto-img">

                        <div class="producto-info">
                            <small>Producto menos vendido</small>
                            <strong>
                                {{ $productoMenosVendido?->nombre ?? '-' }}
                            </strong>

                            <div class="cantidad-danger">
                                {{ $productoMenosVendido?->total_vendidos ?? 0 }}
                                Vendido{{ ($productoMenosVendido?->total_vendidos ?? 0) != 1 ? 's' : '' }}
                            </div>

                        </div>

                    </div>
                @endif
            @endif
        </div>
    </div>

    <div class="section full-width">
        <!--información general-->
        <h4>Información general</h4>
        <div class="info-item">
            Entrega más usada
            <strong>
                {{ ucfirst($metodoEntregaTop ?? '-') }}
            </strong>
        </div>

        <div class="info-item">
            Estado más frecuente

            <strong>
                {{ ucfirst($estadoTop ?? '-') }}
            </strong>
        </div>
    </div>

    <!--footer-->
    <div class="footer">
        Documento generado automáticamente por
        <strong>Huellas felices</strong> |
        {{ now()->format('d/m/Y H:i:s') }}hs.
    </div>
</body>

</html>