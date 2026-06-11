@extends('layouts.admin')

@section('admin-content')
    <div class="admin-header mb-4">
        <div>
            <h2>Productos</h2>
            <p>Gestiona los productos de la tienda</p>
        </div>

        <a href="/backend/admin/productos/create" class="btn btn-success">
            <i class="bi bi-plus-lg"></i>
            Agregar Producto
        </a>
    </div>

    <!-- filtros producos-->
     <div class="admin-panel filtros-ventas mb-4">
        <div class="d-flex align-items-center gap-2 mb-4">
            <i class="bi bi-funnel-fill text-success"></i>
            <h5 class="mb-0">Filtros</h5>
        </div>

        <form action="{{ url('/backend/admin/productos') }}" method="GET" class="preserve-scroll">
            <div class="row g-3">

                <!--buscar productos-->
                <div class="col-md-4">
                    <label class="form-label filtro-label">
                        Producto
                    </label>

                    <input type="text" name="producto" class="form-control" placeholder="Buscar producto..." value="{{ request('producto') }}">
                </div>

                <!--tipo-->
                <div class="col-md-3">
                    <label class="form-label filtro-label">
                        Tipo
                    </label>
                    <select name="tipo" class="form-select">
                        <option value="">Seleccionar</option>

                        @foreach ($categoriasProductos as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ request('tipo') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!--estado-->
                <div class="col-md-2">
                    <label class="form-label filtro-label">
                        Estado
                    </label>
                    <select name="estado" class="form-select">
                        <option value="">Todos</option>
                        <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>
                            Activos
                        </option>
                        <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>
                            Inactivos
                        </option>
                    </select>
                </div>

                <!--stock-->
                <div class="col-md-2">
                    <label class="form-label filtro-label">
                        Stock
                    </label>
                    <select name="stock" class="form-select">
                        <option value="">Todos</option>
                        <option value="bajo-stock" {{ request('stock') == 'bajo-stock' ? 'selected' : '' }}>
                            Bajo stock
                        </option>
                        <option value="sin-stock" {{ request('stock') == 'sin-stock' ? 'selected' : '' }}>
                            Sin stock
                        </option>
                    </select>
                </div>

                <!--botones-->
                <div class="col-md-1">
                    <label class="form-label filtro-label opacity-0">
                        Acciones
                    </label>
                    <div class="d-flex gap-2">
                        <button class="btn btn-success w-100">
                            <i class="bi bi-search"></i>
                        </button>

                        <a href="{{ url('/backend/admin/productos') }}" class="btn btn-outline-secondary preserve-link w-100">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>

                </div>

            </div>

        </form>

     </div>

    <!--conteo de resultados de filtrado-->
    @if (request()->hasAny(['producto', 'tipo', 'estado', 'stock']))
        <p class="text-muted mb-3">
            Resultados filtrados:
            {{ $productosActivos->total() + $productosInactivos->total() }}
            producto{{ ($productosActivos->total() + $productosInactivos->total()) != 1 ? 's' : '' }}
        </p>
    @else
        <p class="text-muted mb-3">
            Mostrando productos del catálogo
        </p>
    @endif

    <!--tabla-->
    <div class="admin-panel" id="productos-activos">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($productosActivos as $producto)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $producto->imagen) }}" class="tabla-img">
                            </td>

                            <td>
                                {{ $producto->nombre }}
                            </td>

                            <td>
                                ${{ number_format($producto->precio, 2, ',', '.') }}
                            </td>

                            <td>
                                @if ($producto->stock <= 0)
                                    <span class="badge bg-dark">Sin stock</span>
                                @elseif($producto->stock <= 5)
                                    <span class="badge bg-danger">{{ $producto->stock }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $producto->stock }}</span>
                                @endif
                            </td>

                            <td>
                                {{ $producto->categoriaProducto?->nombre ?? 'Sin tipo' }}
                            </td>

                            <td>
                                <div class="acciones-producto">
                                    <!--ver detalles-->
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalVer{{ $producto->id }}" title="Ver detalles">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    <!--modal ver detalles-->
                                    <div class="modal fade" id="modalVer{{ $producto->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detalles del producto</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-5 text-center mb-3">
                                                            <img src="{{ asset('storage/' . $producto->imagen) }}"
                                                                class="img-fluid rounded shadow-sm">
                                                        </div>

                                                        <div class="col-md-7">
                                                            <h4>{{ $producto->nombre }}</h4>
                                                            <hr>
                                                            <p>
                                                                <strong>Precio:</strong>
                                                                ${{ number_format($producto->precio, 2, ',', '.') }}
                                                            </p>
                                                            <p>
                                                                <strong>Stock:</strong>
                                                                {{ $producto->stock }}
                                                            </p>
                                                            <p>
                                                                <strong>Categoría:</strong>
                                                                {{ $producto->categoriaProducto?->nombre ?? 'Sin categoría' }}
                                                            </p>
                                                            <p>
                                                                <strong>Animal:</strong>
                                                                {{ $producto->categoriaAnimal?->nombre ?? 'Sin categoría' }}
                                                            </p>
                                                            <p>
                                                                <strong>Descripción:</strong>
                                                                {{ $producto->descripcion ?? 'Sin descripción' }}
                                                            </p>
                                                            <p class="text-muted small">
                                                                Creado:
                                                                {{ $producto->created_at->format('d/m/Y H:i') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <a href="/backend/admin/productos/{{ $producto->id }}/edit"
                                                        class="btn btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                        Editar producto
                                                    </a>

                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Cerrar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="/backend/admin/productos/{{ $producto->id }}/edit" class="btn btn-warning btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Editar producto">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <!--btn eliminar-->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Eliminar producto"
                                        data-bs-target="#modalEliminar{{ $producto->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <form action="/backend/admin/productos/{{ $producto->id }}/toggle" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="btn btn-secondary btn-sm" title="Desactivar producto">
                                            @if ($producto->activo)
                                                <i class="bi bi-eye-slash"></i>
                                            @else
                                                <i class="bi bi-eye"></i>
                                            @endif
                                        </button>
                                    </form>

                                    <!--modal eliminar-->
                                    <div class="modal fade" id="modalEliminar{{ $producto->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Eliminar producto</h5>


                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    ¿Seguro que desea eliminar
                                                    <strong>{{ $producto->nombre }}</strong>?
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Cancelar eliminación de producto"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <form action="/backend/admin/productos/{{ $producto->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger">
                                                            Si, eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $productosActivos->fragment('productos-activos')->links() }}
            </div>

            @if ($productosInactivos->count() > 0)
                <div class="accordion mt-5" id="accordionInactivos">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ request()->has('inactivos_page')  || request('estado') == 'inactivo' ? '' : 'collapsed' }}" 
                                type="button" data-bs-toggle="collapse"
                                data-bs-target="#productosInactivos">
                                Productos desactivados:
                                {{ $productosInactivos->count() }}
                            </button>
                        </h2>

                        <div id="productosInactivos" 
                            class="accordion-collapse collapse {{ request()->has('inactivos_page') || request('estado') == 'inactivo' ? 'show' : '' }}" 
                            data-bs-parent="#accordionInactivos">
                            <div class="accordion-body">
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th>Imagen</th>
                                                <th>Productos</th>
                                                <th>precio</th>
                                                <th>Stock</th>
                                                <th>Tipo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($productosInactivos as $producto)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $producto->imagen) }}" class="tabla-img">
                                                    </td>

                                                    <td>
                                                        {{ $producto->nombre }}
                                                        <br>
                                                        <span class="badge bg-secondary">Desactivado</span>
                                                        @if ($producto->stock <= 0)
                                                            <small class="text-danger d-block mt-1">Sin stock</small>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        ${{ number_format($producto->precio, 2, ',', '.') }}
                                                    </td>

                                                    <td>
                                                        @if ($producto->stock <= 5)
                                                            <span class="badge bg-danger">{{ $producto->stock }}</span>
                                                        @else
                                                            <span class="badge bg-secondary">{{ $producto->stock }}</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        {{ $producto->categoriaProducto?->nombre ?? 'Sin tipo' }}
                                                    </td>

                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="/backend/admin/productos/{{ $producto->id }}/edit" class="btn btn-warning btn-sm" title="Editar Producto">
                                                                <i class="bi bi-pencil"></i>
                                                            </a>
                                                            <form action="/backend/admin/productos/{{ $producto->id }}/toggle" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-success btn-sm" title="Reactivar Producto" {{ $producto->stock <= 0 ? 'disabled' : '' }}>
                                                                    <i class="bi bi-eye"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="mt-4">
                           {{ $productosInactivos->fragment('accordionInactivos')->links() }}
                        </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection