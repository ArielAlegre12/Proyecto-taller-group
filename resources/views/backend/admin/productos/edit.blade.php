@extends('layouts.admin')
@section('admin-content')
    <div class="container mt-5">
        <h2 class="mb-4">Editar Producto</h2>

        <!--errores-->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/backend/admin/productos/{{ $producto->id }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!--nombre-->
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $producto->nombre) }}">
            </div>

            <!--descripción-->
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>

            <!--precio-->
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" name="precio" class="form-control" step="0.01" value="{{ old('precio', $producto->precio) }}">
            </div>

            <!--stock-->
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" min="0" value="{{ old('stock', $producto->stock) }}">
            </div>

            <!--img actual-->
            <div class="mb-3">
                <p class="mb-2">Imagen actual</p>
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="tabla-img">
            </div>

            <!--img nueva-->
            <div class="mb-3">
                <label class="form-label">Nueva imagen</label>
                <input type="file" name="imagen" class="form-control">
            </div>

            <!--categoria animal-->
            <div class="mb-3">
                <label class="form-label">Animal</label>
                <select name="categoria_animal_id" class="form-select">
                    <option value="">Seleccionar</option>
                    @foreach ($categoriasAnimales as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_animal_id', $producto->categoria_animal_id) == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!--categoria producto-->
            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <select name="categoria_producto_id" class="form-select">
                    <option value="">Seleccionar</option>
                    @foreach ($categoriasProductos as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_producto_id', $producto->categoria_producto_id) == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">
                Actualizar producto
            </button>
        </form>
    </div>
@endsection