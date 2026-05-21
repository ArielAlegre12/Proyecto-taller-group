@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tiendaStyle.css') }}">
@endpush

@section('title')
    Tienda
@endsection

@section('h1')
    Tienda <i class="bi bi-shop-window"></i>
    <p class="lead">Encontra el producto que buscas</p>
@endsection

@section('content')

    <div class="tienda-container animar">

        <!--SIDEBAR(barra lateral)-->
        <aside class="sidebar"> <!--aside para contenido secundario-->
            <h4>Animales</h4>
            <ul>
                <li data-filtro-animal="todos" class="activo">Todos</li>
                @foreach ($categoriasAnimales as $categoria)
                    <li data-filtro-animal="{{ strtolower($categoria->nombre) }}">
                        {{ $categoria->nombre }}
                    </li>
                @endforeach
            </ul>
        </aside>

        <div class="contenido-tienda">
            <!--BARRA DE TIPOS-->
            <div class="filtro-tipo">
                <button data-tipo="todos" class="activo" aria-pressed="true">Todos</button>
                @foreach ($categoriasProductos as $categoria)
                    <button data-tipo="{{ strtolower($categoria->nombre) }}">
                        {{ $categoria->nombre }}
                    </button>
                @endforeach
            </div>

            <!--PRODUCTOS-->
            <main class="productos" id="contenedor-productos">

                @forelse($productos as $producto)
                    <div class="card-producto" data-id="{{ $producto->id }}" data-nombre="{{ $producto->nombre }}"
                        data-precio="{{ $producto->precio }}" data-imagen="{{ $producto->imagen }}"
                        data-animal="{{ strtolower(optional($producto->categoriaAnimal)->nombre ?? 'desconocido') }}"
                        data-tipo="{{ strtolower(optional($producto->categoriaProducto)->nombre ?? 'desconocido') }}"
                        data-stock="{{ $producto->stock }}">

                        <div class="info-producto">
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                            <p>{{ $producto->nombre }}</p>
                        </div>

                        <div class="bottom-producto">
                            <p class="precio">
                                <strong>${{ number_format($producto->precio, 0, ',', '.') }}</strong>
                            </p>
                            <p class="stock">Stock: {{ $producto->stock }}</p>

                            @if ($producto->stock > 0)
                                <div class="cantidad">
                                    <button>-</button>
                                    <span class="numero">1</span>
                                    <button>+</button>
                                </div>
                            @endif
                        </div>
                        @auth
                            @if ($producto->stock > 0)
                                <button class="btn-agregar">Agregar</button>
                            @else
                                <button class="btn-agregar btn-disabled" disabled>Sin stock</button>
                            @endif
                        @endauth

                        @guest
                            <button class="btn-agregar btn-disabled" disabled>
                                Inicia sesión para comprar
                            </button>
                        @endguest
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
    <script src="{{ asset('js/animaciones.js') }}"></script>
@endpush

@push('scripts')
    <script type="module" src="{{ asset('js/tiendaJS/mainTienda.js') }}"></script>
@endpushi