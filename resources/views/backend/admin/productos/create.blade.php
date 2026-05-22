@extends('layouts.admin')

@push('scripts')
@if (session('success'))
    <script type="module">
        mostrarToast("{{ session('success') }}", 3000);
    </script>
@endif
@endpush

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

                <select name="categoria_animal_id" class="form-select">
                    <option value="">Seleccionar</option>

                    @foreach ($categoriasAnimales as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_animal_id') == $categoria->id ? 'selected' : '' }}>
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
                        <option value="{{ $categoria->id }}" {{ old('categoria_producto_id') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!--botón-->
            <button type="submit" class="btn btn-primary">
                Guardar producto
            </button>
        </form>
    </div>
@endsection