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
            <h3>${{ number_format($ventas->sum('total'), 2, ',', '.') }}</h3>
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

    <!--tabla ventas-->
    <div class="admin-panel">
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
                                @elseif($venta->estado == 'cancelado')
                                    <span class="badge bg-danger">Cancelado</span>
                                @endif
                            </td>
                            <td>
                                <div class="acciones-producto d-flex gap-2">
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
                                            title="Marcar como enviado" {{ $venta->estado != 'pagado' ? 'disabled' : '' }}>
                                            <i class="bi bi-truck"></i>
                                        </button>
                                    </form>

                                    <!--entregado-->
                                    <form action="/backend/admin/ventas/{{ $venta->id }}/entregado" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button class="btn btn-dark btn-sm" data-bs-toggle="tooltip"
                                            title="Marcar como entregado" {{ $venta->estado != 'enviado' ? 'disabled' : '' }}>
                                            <i class="bi bi-check2-circle"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
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