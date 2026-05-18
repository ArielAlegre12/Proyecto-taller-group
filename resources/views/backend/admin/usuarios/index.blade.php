@extends('layouts.admin')
@section('admin-content')
    <div class="admin-header mb-4">
        <div>
            <h2>Usuarios</h2>
            <p>Gestiona los usuarios del sistema</p>
        </div>
    </div>

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
                                    <a href="/backend/admin/usuarios/{{ $usuario->id }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <!--cambiar rol-->
                                    <form action="/backend/admin/usuarios/{{ $usuario->id }}/rol" method="POST">

                                        @csrf
                                        @method('PUT')

                                        @if ($usuario->rol->nombre == 'admin')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="bi bi-shield-lock"></i>
                                            </button>
                                        @else
                                            <button class="btn btn-primary btn-sm">
                                                <i class="bi bi-shield"></i>
                                            </button>
                                        @endif
                                    </form>

                                    <!--eliminar-->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
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