@extends('layouts.admin')
@section('admin-content')
    <div class="admin-header mb-4">
        <div>
            <h2>Usuarios</h2>
            <p>Gestiona los usuarios del sistema</p>
        </div>
    </div>

    <!--filtros usuarios-->
    <div class="admin-panel filtros-ventas mb-4">

        <div class="d-flex align-items-center gap-2 mb-4">
            <i class="bi bi-funnel-fill text-success"></i>
            <h5 class="mb-0">Filtros</h5>
        </div>

        <form action="{{ url('/backend/admin/usuarios') }}" method="GET" class="preserve-scroll">
            <div class="row g-3">

                <!--nombre-->
                <div class="col-md-3">
                    <label class="form-label filtro-label">
                        Usuario
                    </label>

                    <input type="text" name="nombre" class="form-control" placeholder="Buscar usuario..."
                        value="{{ request('nombre') }}">
                </div>

                <!--email-->
                <div class="col-md-3">
                    <label class="form-label filtro-label">
                        Email
                    </label>

                    <input type="text" name="email" class="form-control" placeholder="Correo..."
                        value="{{ request('email') }}">
                </div>

                <!--rol-->
                <div class="col-md-2">
                    <label class="form-label filtro-label">
                        Rol
                    </label>

                    <select name="rol" class="form-select">
                        <option value="">
                            Seleccionar
                        </option>
                        <option value="admin" {{ request('rol') == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                        <option value="cliente" {{ request('rol') == 'cliente' ? 'selected' : '' }}>
                            Cliente
                        </option>

                    </select>
                </div>

                <!--desde-->
                <div class="col-md-2">
                    <label class="form-label filtro-label">
                        Desde
                    </label>

                    <input type="date" name="desde" class="form-control" value="{{ request('desde') }}"
                        max="{{ now()->toDateString() }}">
                </div>

                <!--hasta-->
                <div class="col-md-1">
                    <label class="form-label filtro-label">
                        Hasta
                    </label>

                    <input type="date" name="hasta" class="form-control" value="{{ request('hasta') }}"
                        min="{{ request('desde') }}" max="{{ now()->toDateString() }}">
                </div>

                <!--botones-->
                <div class="col-md-1">
                    <label class="form-label filtro-label opacity-0">
                        Acciones
                    </label>

                    <div class="d-flex gap-2">
                        <button class="btn btn-success w-100 ">
                            <i class="bi bi-search"></i>
                        </button>

                        <a href="{{ url('/backend/admin/usuarios') }}"
                            class="btn btn-outline-secondary w-100 preserve-link">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>

                    </div>

                </div>

            </div>
        </form>
    </div>

    @if (request()->hasAny(['nombre', 'email', 'rol', 'desde', 'hasta']))
        <p class="text-muted mb-3">
            Resultados filtrados:
            {{ $usuarios->count() }} usuario{{ ($usuarios->count() ?? 0) != 1 ? 's' : '' }}
        </p>
    @else
        <p class="text-muted mb-3">
            Mostrando {{ $usuarios->count() }} usuario{{ ($usuarios->count() ?? 0) != 1 ? 's' : '' }}
        </p>
    @endif

    <div class="admin-panel">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>
                                <div class="avatar-usuario">
                                    {{ strtoupper(substr($usuario->nombre, 0, 1)) }}
                                </div>
                            </td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                @if ($usuario->rol->nombre == 'admin')
                                    <span class="badge-admin">Admin</span>
                                @else
                                    <span class="badge-usuario">Cliente</span>
                                @endif
                            </td>
                            <td>
                                <div class="acciones-producto">
                                    <!--ver-->
                                    <a href="/backend/admin/usuarios/{{ $usuario->id }}" class="btn btn-info btn-sm"
                                        data-bs-toggle="toolip" data-bs-placement="top" title="Ver datos de usuario">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <!--cambiar rol-->
                                    <form action="/backend/admin/usuarios/{{ $usuario->id }}/rol" method="POST">

                                        @csrf
                                        @method('PUT')

                                        @if ($usuario->rol->nombre == 'admin')
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="toolip" data-bs-placement="top"
                                                title="Cambiar rol">
                                                <i class="bi bi-shield-lock"></i>
                                            </button>
                                        @else
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="toolip" data-bs-placement="top"
                                                title="Cambiar rol">
                                                <i class="bi bi-shield"></i>
                                            </button>
                                        @endif
                                    </form>

                                    <!--eliminar-->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-toggle="toolip"
                                        data-bs-placement="top" title="Eliminar usuario"
                                        data-bs-target="#modalEliminar{{ $usuario->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <!--modal eliminar-->
                                    <div class="modal fade" id="modalEliminar{{ $usuario->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Eliminar usuario</h5>


                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    ¿Seguro que desea eliminar
                                                    <strong>{{ $usuario->nombre }}</strong>?
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <form action="/backend/admin/usuarios/{{ $usuario->id }}" method="POST">
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