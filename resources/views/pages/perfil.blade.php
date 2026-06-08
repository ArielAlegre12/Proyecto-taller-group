@extends('layouts.app')

@section('title')
    Mi Perfil
@endsection

@section('h1')
    Mi Perfil
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/perfil.js') }}"></script>
@endpush

@section('content')
    <div class="perfil-container">
        <div class="container">
            <ul class="nav nav-pills mb-4 justify-content-center perfil-tabs animar" id="perfilTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="perfil-tab" data-bs-toggle="pill" data-bs-target="#perfil"
                        type="button">Perfil</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="turnos-tab" data-bs-toggle="pill" data-bs-target="#turnos" type="button">
                        Historial de Turnos
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="compras-tab" data-bs-toggle="pill" data-bs-target="#compras" type="button">
                        Historial de Compras
                    </button>
                </li>
            </ul>
        </div>
        <section class="perfil-header animar">
            <div class="container">
                <div class="perfil-info">
                    <div class="perfil-avatar">
                        {{ strtoupper(substr($usuario->nombre, 0, 1)) }}
                    </div>
                    <div>
                        <h2>
                            {{ $usuario->nombre }}
                        </h2>

                        <p>
                            {{ $usuario->email }}
                        </p>

                        <span class="perfil-rol">
                            {{ $usuario->rol->nombre }}
                        </span>
                    </div>
                </div>
                <hr class="perfil-linea">
            </div>
        </section>
        <section class="container py-5">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="perfil">
                    <div class="card-perfil animar">
                        <div class="card-header-custom">
                            <h3>
                                Informacion Personal
                            </h3>

                            <button class="btn-custom" id="btnEditar">
                                Editar
                            </button>
                        </div>
                        <form action="{{ route('perfil.actualizar') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label>
                                        Nombre
                                    </label>

                                    <input type="text" name="nombre" class="form-control campo-editable" value="{{ $usuario->nombre }}" disabled>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label>
                                        Email
                                    </label>

                                    <input type="email" name="email" class="form-control campo-editable" value="{{ $usuario->email }}" disabled>
                                </div>

                            </div>

                            <div class="botones-edicion d-none" id="botonesGuardar">
                                <button type="submit" class="btn-guardar">
                                    Guardar
                                </button>

                                <button type="button" class="btn-cancelar" id="btnCancelar">
                                    Cancelar
                                </button>

                            </div>
                        </form>
                        
                    </div>
                </div>

                <div class="tab-pane fade" id="turnos">
                    <div class="card-perfil mt-5 animar">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3>
                                Turnos Domesticos
                            </h3>

                            <a class="btn-custom" href="{{ route('pages.turnos.domestico') }}">Agregar</a>
                        </div>
                        @forelse($turnosDomesticos as $turno)

                            <div class="turno-card">

                                <h4>
                                    {{ $turno->nombreMascota }}
                                </h4>

                                <p>
                                    <strong>Dueño:</strong>
                                    {{ $turno->nombreDueño }}
                                </p>

                                <p>
                                    <strong>Tipo:</strong>
                                    {{ $turno->tipoMascota }}
                                </p>

                                <p>
                                    <strong>Motivo:</strong>
                                    {{ $turno->motivo }}
                                </p>

                                <p>
                                    <strong>Fecha:</strong>
                                    {{ \Carbon\Carbon::parse($turno->fechaYHora)->format('d/m/y | H:i') }}
                                </p>

                                <p>
                                    <strong>Estado:</strong>

                                    @if ($turno->estado == 'pendiente')
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    @elseif($turno->estado == 'reprogramado')
                                        <span class="badge bg-info">Reprogramado</span>
                                    @elseif($turno->estado == 'confirmado')
                                        <span class="badge bg-success">Confirmado</span>
                                    @elseif($turno->estado == 'cancelado')
                                        <span class="badge bg-danger">Cancelado</span>
                                    @endif
                                </p>

                                <div class="turno-acciones">
                                    @if ($turno->estado == 'pendiente')
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#cancelarDomestico{{ $turno->id }}">
                                            Cancelar turno
                                        </button>
                                    @endif

                                    @if ($turno->estado == 'reprogramado')
                                        <div class="alert alert-warning mt-3">
                                            <strong>El horario fue modificado por la veterinaria.</strong>

                                            <br>

                                            Fecha anterior:
                                            {{ \Carbon\Carbon::parse($turno->fecha_original)->format('d/m/Y H:i') }}

                                            <br>

                                            Nueva fecha:
                                            {{ \Carbon\Carbon::parse($turno->fechaYHora)->format('d/m/Y H:i') }}
                                        </div>

                                        <div class="d-flex gap-2">
                                            <form action="/perfil/turnos/domesticos/{{ $turno->id }}/aceptar" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <button class="btn btn-success">
                                                    Aceptar horario
                                                </button>
                                            </form>

                                            <form action="/perfil/turnos/domesticos/{{ $turno->id }}/rechazar" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <button class="btn btn-danger">
                                                    Cancelar turno
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="sin-turnos">
                                No tiene turnos domesticos.
                            </div>
                        @endforelse


                    </div>
                    <div class="card-perfil mt-5 animar">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3>
                                Turno Produccion
                            </h3>

                            <a class="btn-custom" href="{{ route('pages.turnos.produccion') }}">Agregar</a>
                        </div>
                        @forelse($turnosProduccion as $turno)

                            <div class="turno-card">

                                <h4>
                                    {{ $turno->nombreProdu }}
                                </h4>

                                <p>
                                    <strong>Establo:</strong>
                                    {{ $turno->nombreEstablo }}
                                </p>

                                <p>
                                    <strong>Animal:</strong>
                                    {{ $turno->tipoAnimal }}
                                </p>

                                <p>
                                    <strong>Cantidad:</strong>
                                    {{ $turno->cantidad }}
                                </p>

                                <p>
                                    <strong>Servicio:</strong>
                                    {{ $turno->tipoServicio }}
                                </p>

                                <p>
                                    <strong>Fecha:</strong>
                                    {{ \Carbon\Carbon::parse($turno->fechaYHora)->format('d/m/y | H:i') }}
                                </p>

                                <p>
                                    <strong>Estado:</strong>

                                    @if ($turno->estado == 'pendiente')
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    @elseif($turno->estado == 'reprogramado')
                                        <span class="badge bg-info">Reprogramado</span>
                                    @elseif($turno->estado == 'confirmado')
                                        <span class="badge bg-success">Confirmado</span>
                                    @elseif($turno->estado == 'cancelado')
                                        <span class="badge bg-danger">Cancelado</span>
                                    @endif
                                </p>

                                <div class="turno-acciones">
                                    @if ($turno->estado == 'pendiente')
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#cancelarProduccion{{ $turno->id }}">
                                            Cancelar turno
                                        </button>
                                    @endif

                                    @if ($turno->estado == 'reprogramado')
                                        <div class="alert alert-warning mt-3">
                                            <strong>El horario fue modificado por la veterinaria.</strong>

                                            <br>

                                            Fecha anterior:
                                            {{ \Carbon\Carbon::parse($turno->fecha_original)->format('d/m/Y H:i') }}

                                            <br>

                                            Nueva fecha:
                                            {{ \Carbon\Carbon::parse($turno->fechaYHora)->format('d/m/Y H:i') }}
                                        </div>

                                        <div class="d-flex gap-2">
                                            <form action="/perfil/turnos/produccion/{{ $turno->id }}/aceptar" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <button class="btn btn-success">
                                                    Aceptar horario
                                                </button>
                                            </form>

                                            <form action="/perfil/turnos/produccion/{{ $turno->id }}/rechazar" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <button class="btn btn-danger">
                                                    Cancelar turno
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="sin-turnos">
                                No tiene turnos de produccion.
                            </div>
                        @endforelse


                    </div>
                </div>

                <!--Por ahora es un modelado, pero más adelante recibira datos de la compra-->
                <div class="tab-pane fade" id="compras">
                    <div class="card-perfil mt-3 animar">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3>
                                Historial de Compras
                            </h3>

                            <a class="btn-custom" href="/tienda">Agregar</a>

                        </div>
                        <div class="row">
                            @forelse ($ventas as $venta)
                                <div class="compra-card mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h4 class="mb-1">
                                                Pedido #{{ $venta->id }}
                                            </h4>

                                            <small class="text-muted">
                                                {{ $venta->created_at->format('d/m/Y H:i') }}
                                            </small>
                                        </div>

                                        <div>
                                            @if ($venta->estado == 'pendiente')
                                                <span class="badge bg-warning text-dark">
                                                    Pendiente de aprobación
                                                </span>
                                            @elseif($venta->estado == 'pagado')
                                                @if ($venta->metodo_entrega == 'retiro')
                                                    <span class="badge bg-dark">
                                                        Listo para retirar
                                                    </span>
                                                @else
                                                    <span class="badge bg-dark">
                                                        Preparando envío
                                                    </span>
                                                @endif
                                            @elseif($venta->estado == 'enviado')
                                                <span class="badge bg-primary">
                                                    En camino
                                                </span>
                                            @elseif($venta->estado == 'entregado')
                                                @if($venta->metodo_entrega == 'retiro')
                                                    <span class="badge bg-dark">
                                                        Retirado
                                                    </span>
                                                @else
                                                    <span class="badge bg-success">
                                                        Entregado
                                                    </span>
                                                @endif
                                            @elseif($venta->estado == 'cancelada')
                                                <span class="badge bg-danger">
                                                    Compra cancelada
                                                </span>

                                            @endif
                                        </div>
                                    </div>

                                    @foreach ($venta->detalles as $detalle)
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            <img src="{{ asset('storage/' . $detalle->imagen_producto) }}" width="80"
                                                class="rounded-3">

                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">{{ $detalle->nombre_producto }}</h5>
                                                <p class="mb-1 text-muted">Cantidad: {{ $detalle->cantidad }}</p>
                                                <strong>${{ number_format($detalle->subtotal, 2, ',', '.') }}</strong>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Total</strong>
                                            <strong>${{ number_format($venta->total, 2, ',', '.') }}</strong>
                                        </div>
                                        @if ($venta->estado == 'pendiente')
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#cancelarModal{{ $venta->id }}">
                                                Cancelar compra
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <hr>

                            @empty
                                <div class="sin-turnos">
                                    No tienes compras registradas.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    @foreach ($ventas as $venta)
                        @if ($venta->estado == 'pendiente')
                            <div class="modal fade" id="cancelarModal{{ $venta->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Cancelar compra</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <p>
                                                ¿Seguro que deseas cancelar el pedido
                                                <strong>#{{ $venta->id }}</strong>?
                                            </p>
                                            <p class="text-danger mb-0">
                                                Esta acción no se puede deshacer.
                                            </p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Volver
                                            </button>
                                            <form action="{{ route('ventas.cancelar', $venta->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-x-circle"></i>
                                                    Sí, cancelar compra
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
    </div>
    </div>
    </section>
    @foreach ($turnosDomesticos as $turno)
        @if ($turno->estado == 'pendiente')
            <div class="modal fade" id="cancelarDomestico{{ $turno->id }}" tabindex="-1">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cancelar turno</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            ¿Seguro que deseas cancelar este turno?
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">
                                Volver
                            </button>

                            <form action="/perfil/turnos/domesticos/{{ $turno->id }}/cancelar" method="POST">
                                @csrf
                                @method('PUT')

                                <button class="btn btn-danger">
                                    Si, cancelar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    @foreach ($turnosProduccion as $turno)
        @if ($turno->estado == 'pendiente')
            <div class="modal fade" id="cancelarProduccion{{ $turno->id }}" tabindex="-1">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cancelar turno</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            ¿Seguro que deseas cancelar este turno?
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">
                                Volver
                            </button>

                            <form action="/perfil/turnos/produccion/{{ $turno->id }}/cancelar" method="POST">
                                @csrf
                                @method('PUT')

                                <button class="btn btn-danger">
                                    Si, cancelar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection