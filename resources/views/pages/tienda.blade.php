@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tiendaStyle.css') }}">
@endpush

@section('title')
    Tienda
@endsection

@section('h1')
    Tienda
@endsection

@section('content')

    <div class="tienda-container">

        <!--SIDEBAR-->
        <aside class="sidebar">
            <h4>Animales</h4>
            <ul>
                <li data-categoria="todos" class="activo">Todos</li>
                <li data-categoria="perros">Perros</li>
                <li data-categoria="gatos">Gatos</li>
                <li data-categoria="caballos">Caballos</li>
                <li data-categoria="vacas">Vacas</li>
            </ul>
        </aside>

        <!--PRODUCTOS-->
        <main class="productos" id="contenedor-productos">

            @forelse($productos as $producto)
                <div class="card-producto" data-categoria="{{ $producto['categoria'] }}">

                    <img src="{{ asset($producto['imagen']) }}">
                    <p>{{ $producto['nombre'] }}</p>
                    <p><strong>${{ number_format($producto['precio'], 0, ',', '.') }}</strong></p>

                    <div class="cantidad">
                        <button>-</button>
                        <span class="numero">1</span>
                        <button>+</button>
                    </div>

                    <button>Agregar</button>
                </div>

            @empty
                <div class="forelse-msj">
                    <p>No hay productos disponibles</p>
                </div>
            @endforelse

        </main>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/tiendaMain.js') }}"></script>
@endpush