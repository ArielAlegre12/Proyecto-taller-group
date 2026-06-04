@extends('layouts.admin')

@section('admin-content')
    <div class="admin-header mb-4">
        <div>
            <h2>Consultas</h2>
            <p>Gestiona las consultas veterinarias</p>
        </div>
    </div>

    <div class="admin-panel">
        <h3 class="mb-4">
            <i class="bi bi -chats-dots">
                Consultas registradas
            </i>
        </h3>

        <div class="table-responsive">
            <table class="table table-aling-middle">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Animal</th>
                        <th>Consulta</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($consultas as $consulta)
                        <tr>
                            <td>{{ $consulta->nombre }}</td>
                            <td>{{ $consulta->tipo_animal }}</td>
                            <td>{{ $consulta->tipo_consulta }}</td>
                            <td>{{ \Carbon\Carbon::parse($consulta->fecha_hora)->format('d/m/y | H:i') }}</td>
                            <td>
                                @if ($consulta->estado == 'Pendiente')
                                    <span class="badge bg-warning text-dark">
                                        Pendiente
                                    </span>

                                @elseif($consulta->estado == 'confirmada')
                                    <span class="badge bg-success">
                                        Confirmada
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="acciones-producto">
                                    <!--VER-->
                                    <a href="/backend/admin/consultas/{{ $consulta->id }}" class="btn btn-primary btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Ver consulta">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <!--CONFIRMAR-->
                                    <form action="/backend/admin/consultas/{{ $consulta->id }}/confirmar" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Confirmar consulta" {{ $consulta->estado == 'confirmado' ? 'disable' : '' }}>
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>

                                    <!--boton Cancelar-->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalEliminarConsulta{{ $consulta->id }}" title="Cancelar Consulta">
                                        <i class="bi bi-x-circle"></i>
                                    </button>

                                    <!--modal-->
                                    <div class="modal fade" id="modalEliminarConsulta{{ $consulta->id }}" tabindex="-1">

                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Cancelar consulta
                                                    </h5>

                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                    </button>
                                                </div>

                                                <form action="/backend/admin/consultas/{{ $consulta->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <div class="modal-body">

                                                        <label class="form-label">
                                                            Motivo de la cancelación
                                                        </label>

                                                        <textarea name="motivo" class="form-control" rows="4"
                                                            placeholder="Escriba el motivo..." required></textarea>

                                                    </div>

                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            Cancelar
                                                        </button>

                                                        <button type="submit" class="btn btn-danger">
                                                            Cancelar Consulta
                                                        </button>

                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No hay consultas registradas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection