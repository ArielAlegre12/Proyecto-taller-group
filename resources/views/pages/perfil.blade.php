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
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label>
                                        Nombre
                                    </label>
                                    <input type="text" class="form-control campo-editable" value="{{ $usuario->nombre}}"
                                        disabled>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>
                                        Email
                                    </label>

                                    <input type="text" class="form-control campo-editable" value="{{ $usuario->email }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="botones-edicion d-none" id="botonesGuardar">
                                <button class="btn-guardar">
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
                                                    Pendiente
                                                </span>
                                            @elseif($venta->estado == 'entregado')
                                                @if ($venta->metodo_entrega == 'retiro')
                                                    <span class="badge bg-dark">
                                                        Retirado
                                                    </span>
                                                    @else
                                                        <span class="badge bg-dark">
                                                            Entregado
                                                        </span>
                                                @endif
                                            @else
                                                <span class="badge bg-warning text-dark">
                                                    En camino
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    @foreach ($venta->detalles as $detalle)
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            <img src="{{ asset('storage/' . $detalle->producto->imagen) }}"
                                                width="80" class="rounded-3">

                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">{{ $detalle->producto->nombre }}</h5>
                                                <p class="mb-1 text-muted">Cantidad: {{ $detalle->cantidad }}</p>
                                                <strong>${{ number_format($detalle->subtotal,2,',','.') }}</strong>
                                            </div>
                                        </div>
                                    @endforeach
                                    <hr>

                                    <div class="d-flex justify-content-between">
                                        <strong>Total</strong>
                                        <strong>${{ number_format($venta->total,2,',','.') }}</strong>
                                    </div>
                                </div>

                                @empty
                                <div class="sin-turnos">
                                    No tienes compras registradas.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@if (session('success'))
    <script>
        localStorage.removeItem('carrito');
        mostrarToast("Compra realizada correctamente");
    </script>
@endif