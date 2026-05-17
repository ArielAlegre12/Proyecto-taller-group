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
            </div>
        </section>
        <section class="container py-5">
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
                            <input type="text" class="form-control campo-editable" value="{{ $usuario->nombre}}" disabled>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label>
                                Email
                            </label>

                            <input type="text" class="form-control campo-editable" value="{{ $usuario->email }}" disabled>
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

            <div class="card-perfil mt-5 animar">
                <h3 class="mb-4">
                    Turnos Domesticos
                </h3>

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
                            {{ $turno->fechaYHora }}
                        </p>
                    </div>
                @empty
                    <div class="sin-turnos">
                        No tiene turnos domesticos.
                    </div>
                @endforelse
            </div>
            <div class="card-perfil mt-5 animar">
                <h3 class="mb-4">
                    Turno Produccion
                </h3>

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
                            {{ $turno->fechaYHora }}
                        </p>
                    </div>
                @empty
                    <div class="sin-turnos">
                        No tiene turnos de produccion.
                    </div>
                @endforelse
            </div>

            <!--Por ahora es un modelado, pero más adelante recibira datos de la compra-->
            <div class="card-perfil mt-5 animar">
                <h3 class="mb-4">
                    Historial de Compras
                </h3>

                <div class="row">
                    @foreach($productos as $producto)

                        <div class="col-md-4 mb-4">
                            <div class="producto-card">
                                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}"
                                    class="img-compra">
                                <h4>
                                    {{ $producto->nombre }}
                                </h4>

                                <p class="producto-descripcion">
                                    {{ $producto->descripcion }}
                                </p>

                                <div class="precio">
                                    ${{ number_format($producto->precio, 2, ',', '.') }}
                                </div>

                                <hr>
                                <div class="detalle-compra">
                                    <!--acá recibira la fecha de compra, de momento sólo la fecha de la creación del prod-->
                                    <p>
                                        <strong>Fecha:</strong>
                                        {{ $producto->created_at->format('d/m/y') }}
                                    </p>
                                    <!--Luego obtendremos la info de la compra-->
                                    <p>
                                        <strong>Método de pago:</strong>
                                        Tarjeta
                                    </p>
                                    <!--Habrá que verificar el estado-->
                                    <p>
                                        <strong>Estado:</strong>
                                        <span class="badge bg-success">Entregado</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection