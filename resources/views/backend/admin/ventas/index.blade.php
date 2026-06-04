@extends('layouts.admin')
@section('admin-content')
    <div class="admin-header mb-4">
        <div>
            <h2>Ventas</h2>
            <p>Gestiona las ventas y pedidos de la tienda</p>
        </div>
    </div>

    <!--resumen-->
    <div class="resumen-grid mb-5">
        <div class="resumen-card">
            <i class="bi bi-cash-stack"></i>
            <h3>
                ${{ number_format(
                    $ventas->whereIn('estado', ['pagado', 'enviado', 'entregado'])->sum('total'),
                    2,
                    ',',
                    '.'
                ) }}
            </h3>
            <p>Total vendido</p>
        </div>

        <div class="resumen-card">
            <i class="bi bi-bag-check"></i>
            <h3>{{ $ventas->count() }}</h3>
            <p>Pedidos registrados</p>
        </div>

        <div class="resumen-card">
            <i class="bi bi-truck"></i>
            <h3>{{ $ventas->where('estado', 'enviado')->count() }}</h3>
            <p>Pedidos enviados</p>
        </div>
    </div>

    <!--productos más vendidos-->
    <div class="admin-panel mb-5">
        <h4 class="mb-4">Productos más vendidos</h4>
        
        <div class="row">
            @foreach ($productosMasVendidos as $producto)
                <div class="col-md-4 col-lg-2 mb-3">
                    <div class="top-producto-card text-center" >
                        <div class="top-producto-numero">
                            {{ $loop->iteration }}
                        </div>
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                        <strong>{{ $producto->nombre }}</strong>
                        <small>{{ $producto->total_vendidos }} Vendidos</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!--filtros-->
    <div class="admin-panel filtros-ventas mb-4">
        <div class="d-flex align-items-center gap-2 mb-4">
            <i class="bi bi-funnel-fill text-success"></i>
            <h5 class="mb-0">Filtros</h5>
        </div>

        <form action="{{ route('admin.ventas') }}" method="GET" class="preserve-scroll">
            <div class="row g-3">
                <!--buscar cliente-->
                <div class="col-md-3">
                    <input type="text" name="cliente" class="form-control" placeholder="Buscar cliente..." value="{{ request('cliente') }}">
                </div>

                <!--estado-->
                <div class="col-md-2">
                    <select name="estado" class="form-select">
                        <option value="">Estado</option>

                        <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>
                            Pendiente
                        </option>

                        <option value="pagado" {{ request('estado') == 'pagado' ? 'selected' : '' }}>
                            Pagado
                        </option>

                        <option value="enviado" {{ request('estado') == 'enviado' ? 'selected' : '' }}>
                            Enviado
                        </option>

                        <option value="entregado" {{ request('estado') == 'entregado' ? 'selected' : '' }}>
                            Entregado
                        </option>
                    </select>
                </div>

                <!--rango de fecha desde-->
                <div class="col-md-2">
                    <input type="date" name="desde" class="form-control" value="{{ request('desde') }}" max="{{ now()->toDateString() }}">
                </div>

                <!--rango de fecha hasta-->
                <div class="col-md-2">
                    <input type="date" name="hasta" class="form-control" value="{{ request('hasta') }}" min="{{ request('desde')}}" max="{{ now()->toDateString() }}">
                </div>

                <!--método de entrega-->
                <div class="col-md-2">
                    <select name="entrega" class="form-select">
                        <option value="">Entrega</option>

                        <option value="domicilio" {{ request('entrega') == 'domicilio' ? 'selected' : ''}}>
                            Domicilio
                        </option>

                        <option value="retiro" {{ request('entrega') == 'retiro' ? 'selected' : '' }}>
                            Retiro
                        </option>
                    </select>
                </div>

                <!--botones-->
                <div class="col-md-1 d-flex gap-2">
                    <!--buscar-->
                    <button class="btn btn-success w-100">
                        <i class="bi bi-search"></i>
                    </button>
                    <!--resetear filtros-->
                    <a href="{{ route('admin.ventas') }}" class="btn btn-outline-secondary preserve-link w-100">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>

            </div>
        </form>
    </div>

    <!--tabla ventas-->
    <div class="admin-panel">
        <h4 class="mb-4">Tabla de ventas</h4>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Pedido</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($ventas as $venta)
                        <tr>
                            <td>#{{ $venta->id }}</td>
                            <td>{{ $venta->usuario->nombre }}</td>
                            <td>${{ number_format($venta->total, 2, ',', '.') }}</td>
                            <td>{{ $venta->created_at->format('d/m/Y') }}</td>

                            <td>
                                @if ($venta->estado == 'pendiente')
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @elseif($venta->estado == 'enviado')
                                    <span class="badge bg-info">Enviado</span>
                                @elseif($venta->estado == 'entregado')
                                    <span class="badge bg-success">Entregado</span>
                                @elseif($venta->estado == 'pagado')
                                    <span class="badge bg-primary">Pagado</span>
                                @elseif($venta->estado == 'cancelada')
                                    <span class="badge bg-danger">Cancelada</span>
                                @endif
                            </td>
                            <td>
                                <div class="acciones-producto d-flex gap-2">
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#ventaModal{{ $venta->id }}" title="Ver detalles">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    <!--pagado-->
                                    <form action="/backend/admin/ventas/{{ $venta->id }}/pagado" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                                            title="Marcar como pagado" {{ $venta->estado != 'pendiente' ? 'disabled' : '' }}>

                                            <i class="bi bi-cash"></i>
                                        </button>
                                    </form>

                                    <!--envidado-->
                                    <form action="/backend/admin/ventas/{{ $venta->id }}/enviado" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button class="btn btn-primary btn-sm" data-bs-toggle="tooltip"
                                            title="Marcar como enviado"
                                            {{ $venta->estado != 'pagado' ||
                                                $venta->metodo_entrega == 'retiro' ? 'disabled' : '' }}>
                                            <i class="bi bi-truck"></i>
                                        </button>
                                    </form>

                                    <!--entregado-->
                                    <form action="/backend/admin/ventas/{{ $venta->id }}/entregado" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button class="btn btn-dark btn-sm" data-bs-toggle="tooltip"
                                            title="Marcar como entregado"
                                            {{ (
                                                    $venta->metodo_entrega == 'domicilio' &&
                                                    $venta->estado != 'enviado'
                                                    ) || 
                                                (
                                                    $venta->metodo_entrega == 'retiro' &&
                                                    $venta->estado != 'pagado'
                                                )
                                                    ? 'disabled' : ''
                                                }}>
                                            <i class="bi bi-check2-circle"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>

                        <!--modal ventas-->
                        <div class="modal fade" id="ventaModal{{ $venta->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detalle del pedido #{{ $venta->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!--info-->
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <p>
                                                    <strong>Cliente:</strong>
                                                    {{ $venta->usuario->nombre }}
                                                </p>

                                                <p>
                                                    <strong>Email:</strong>
                                                    {{ $venta->usuario->email }}
                                                </p>

                                                <p> <!--ucfirst: Convierte el primer carácter en una mayúscula-->
                                                    <strong>Estado:</strong>
                                                    {{ ucfirst($venta->estado) }}
                                                </p>
                                            </div>

                                            <div class="col-md-6">
                                                <p>
                                                    <strong>Fecha:</strong>
                                                    {{ $venta->created_at->format('d/m/Y H:i:s') }}
                                                </p>

                                                <p>
                                                    <strong>Método de pago:</strong>
                                                    {{ ucfirst($venta->metodo_pago ?? 'Tarjeta') }}
                                                </p>

                                                <p>
                                                    <strong>Entrega:</strong>
                                                    {{ ucfirst($venta->metodo_entrega ?? 'Retiro') }}
                                                </p>
                                            </div>

                                        </div>
                                        <hr>
                                        <!--productos-->
                                        <h6 class="mb-3">Productos comprados</h6>
                                        @foreach ($venta->detalles as $detalle)
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <img src="{{ asset('storage/' . $detalle->producto->imagen) }}" width="70"
                                                    class="rounded-3">

                                                <div class="flex-grow-1">
                                                    <h6 class="mb-1">{{ $detalle->producto->nombre }}</h6>
                                                    <small class="text-muted">Cantidad: {{ $detalle->cantidad }}</small>
                                                </div>

                                                <strong>${{ number_format($detalle->subtotal, 2, ',', '.') }}</strong>
                                            </div>
                                        @endforeach

                                        <hr>

                                        <div class="d-flex justify-content-between">
                                            <strong>Total</strong>
                                            <strong>${{ number_format($venta->total, 2, ',', '.') }}</strong>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-bag-x fs-2 d-block mb-2"></i>
                                No hay ventas registradas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection