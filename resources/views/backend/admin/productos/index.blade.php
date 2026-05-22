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

    <div class="admin-panel">
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
                    @foreach ($productos as $producto)
                        <tr class="{{ !$producto->activo ? 'producto-inactivo' : '' }}">
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
                                @if ($producto->stock <= 5)
                                    <span class="badge bg-danger">{{ $producto->stock }}</span>
                                @else
                                    <span class="badge bg-success">{{ $producto->stock }}</span>
                                @endif
                            </td>

                            <td>
                                {{ $producto->categoriaProducto?->nombre ?? 'Sin tipo' }}
                            </td>

                            <td>
                                <div class="acciones-producto">
                                    <!--ver detalles-->
                                    <button class="btn btn-info btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalVer{{ $producto->id }}"
                                        title="Ver detalles">
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
                                                                ${{ number_format($producto->precio,2,',','.') }}
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
                                                    <a href="/backend/admin/productos/{{ $producto->id }}/edit" class="btn btn-warning">
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
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Editar producto">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <!--btn eliminar-->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Eliminar producto"
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
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Cancelar eliminación de producto"
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
        </div>
    </div>
@endsection