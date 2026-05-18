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
                                @if ($producto->stock <= 5)
                                    <span class="badge bg-danger">{{ $producto->stock }}</span>
                                @else
                                    <span class="badge bg-success">{{ $producto->stock }}</span>
                                @endif
                            </td>

                            <td>
                                {{ $producto->tipo }}
                            </td>

                            <td>
                                <div class="acciones-producto">
                                    <a href="/backend/admin/productos/{{ $producto->id }}/edit" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <!--btn modal-->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalEliminar{{ $producto->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>

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