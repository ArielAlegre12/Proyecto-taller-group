@extends('layouts.admin')
@section('admin-content')
    <div class="admin-header mb-4">
        <div>
            <h2>Detalles del usuario</h2>
            <p>Información completa del usuario</p>
        </div>
    </div>

    <div class="admin-panel">
        <div class="usuario-detalle">
            <!--avatar-->
            <div class="usuario-avatar-grande">
                {{ strtoupper(substr($usuario->nombre, 0, 1)) }}
            </div>

            <!--info-->
            <div class="usuario-info">
                <h3>{{ $usuario->nombre }}</h3>

                <p class="text-muted mb-2">{{ $usuario->email }}</p>

                @if ($usuario->rol->nombre == 'admin')
                    <span class="badge-admin">Administrador</span>
                @else
                    <span class="badge-usuario">Cliente</span>
                @endif
            </div>
        </div>

        <hr class="my-4">

        <!--datos-->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="info-card">
                    <span>ID Usuario</span>
                    <h5>#{{ $usuario->id }}</h5>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-card">
                    <span>Fecha de registro</span>
                    <h5>{{ $usuario->created_at->format('d/m/y') }}</h5>
                </div>
            </div>

        </div>

        <!--acciones-->
        <div class="mt-5 d-flex gap-3">
            <!--cambiar rol-->
            <form action="/backend/admin/usuarios/{{ $usuario->id }}/rol" method="POST">
                @csrf
                @method('PUT')

                @if ($usuario->rol->nombre == 'admin')
                    <button class="btn btn-danger">
                        Quitar Admin
                    </button>
                @else
                    <button class="btn btn-primary">
                        Convertir en Admin
                    </button>
                @endif
            </form>

            <!--volver-->
            <a href="/backend/admin/usuarios" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@endsection