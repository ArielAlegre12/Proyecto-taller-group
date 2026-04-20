@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tiendaStyle.css') }}">
@endpush

@section('title')
    Tienda
@endsection

@section('h1')
    Tienda <i class="bi bi-shop-window"></i>
@endsection

@section('content')

    <div class="tienda-container">

        <!--SIDEBAR-->
        <aside class="sidebar">
            <h4>Animales</h4>
            <ul>
                <li data-filtro-animal="todos" class="activo">Todos</li>
                <li data-filtro-animal="perros">Perros</li>
                <li data-filtro-animal="gatos">Gatos</li>
                <li data-filtro-animal="caballos">Caballos</li>
                <li data-filtro-animal="vacas">Vacas</li>
            </ul>
        </aside>

        <div class="contenido-tienda">
            <!--BARRA DE TIPOS-->
            <div class="filtro-tipo">
                <button data-tipo="todos" class="activo" aria-pressed="true">Todos</button>
                <button data-tipo="alimentos" aria-pressed="false">Alimentos</button>
                <button data-tipo="higiene" aria-pressed="false">Higiene</button>
                <button data-tipo="accesorios" aria-pressed="false">Accesorios</button>
                <button data-tipo="salud" aria-pressed="false">Salud</button>
            </div>

            <!--PRODUCTOS-->
            <main class="productos" id="contenedor-productos">

                @forelse($productos as $producto)
                    <div class="card-producto"
                        data-id="{{ $producto['id'] }}"
                        data-nombre="{{ $producto['nombre'] }}"
                        data-precio="{{ $producto['precio'] }}"
                        data-imagen="{{ $producto['imagen'] }}"
                        data-animal="{{ $producto['animal'] }}"
                        data-tipo="{{ $producto['tipo'] }}">

                        <div class="info-producto">
                            <img src="{{ asset($producto['imagen']) }}">
                            <p>{{ $producto['nombre'] }}</p>
                        </div>

                        <div class="bottom-producto">
                            <p class="precio">
                                <strong>${{ number_format($producto['precio'], 0, ',', '.') }}</strong>
                            </p>

                            <div class="cantidad">
                                <button>-</button>
                                <span class="numero">1</span>
                                <button>+</button>
                            </div>
                        </div>

                        <button class="btn-agregar">Agregar</button>
                    </div>

                @empty
                    <div class="forelse-msj">
                        <p>No hay productos disponibles</p>
                    </div>
                @endforelse

                <!--msj si no hay productos de la categoria-->
                <div class="forelse-msj" id="mensaje-vacio" style="display:none;">
                    <p>No hay productos en esta categoría</p>
                </div>

            </main>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="module" src="{{ asset('js/tiendaJS/mainTienda.js') }}"></script>
@endpush