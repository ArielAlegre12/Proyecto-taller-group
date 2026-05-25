@extends('layouts.admin')

@section('admin-content')
    <div class="container mt-5">
        <h2 class="mb-4">Agregar producto</h2>

        <!--Errores de validación-->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/backend/admin/productos" method="POST" enctype="multipart/form-data">
            @csrf
            <!--nombre-->
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
            </div>

            <!--descripción-->
            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
            </div>

            <!--precio-->
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" name="precio" class="form-control" step="0.01" value="{{ old('precio') }}">
            </div>

            <!--stock-->
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" min="0" value="{{ old('stock') }}">
            </div>

            <!--imagen-->
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input type="file" name="imagen" class="form-control">
            </div>

            <!--cateogria animal-->
            <div class="mb-3">
                <label class="form-label">Animal</label>

                <div class="d-flex gap-2">
                    <select name="categoria_animal_id" class="form-select">
                        <option value="">Seleccionar</option>

                        @foreach ($categoriasAnimales as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_animal_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>

                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#modalCategoriaAnimal" title="Agregar">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>
            </div>

            <!--categoria producto-->
            <div class="mb-3">
                <label class="form-label">Tipo</label>

                <div class="d-flex gap-2">
                    <select name="categoria_producto_id" class="form-select">
                        <option value="">Seleccionar</option>

                        @foreach ($categoriasProductos as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_producto_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>

                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCategoriaProducto" title="Agregar">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>
            </div>

            <!--botón-->
            <button type="submit" class="btn btn-primary" title="Guardar producto">
                Guardar producto
            </button>
        </form>

        <!--modal para agregar categoría animal-->
            <div class="modal fade" id="modalCategoriaAnimal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('categorias.animales.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Nueva categoría animal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre de la categoría">
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!--modal para agreagar categoría producto-->
            <div class="modal fade" id="modalCategoriaProducto" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('categorias.productos.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Nueva categoría producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre de la categoría">
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection