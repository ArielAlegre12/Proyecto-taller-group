@extends('layouts.app')
@section('title')
    Agregar Producto
@endsection
@section('content')
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

            <!--animal-->
            <div class="mb-3">
                <label class="form-label">Animal</label>

                <select name="animal" class="form-select">
                    <option value="">Seleccionar</option>
                    <option value="perros">Perros</option>
                    <option value="gatos">Gatos</option>
                    <option value="caballos">Caballos</option>
                    <option value="vacas">Vacas</option>
                    <option value="otros">Otros</option>
                </select>
            </div>

            <!--tipo-->
            <div class="mb-3">
                <label class="form-label">Tipo</label>

                <select name="tipo" class="form-select">
                    <option value="">Seleccionar</option>
                    <option value="alimentos">Alimentos</option>
                    <option value="higiene">Higiene</option>
                    <option value="accesorios">Acessorios</option>
                    <option value="salud">Salud</option>
                </select>
            </div>

            <!--botón-->
            <button type="submit" class="btn btn-primary">
                Guardar producto
            </button>
        </form>
    </div>
@endsection