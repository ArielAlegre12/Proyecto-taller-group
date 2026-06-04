@extends('layouts.admin')
@section('admin-content')
    <div class="admin-header mb-4">
        <div>
            <h2>Turnos</h2>
            <p>Gestiona los turnos domésticos y de producción</p>
        </div>
    </div>

    <!--turnos domésticos-->
    <div class="admin-panel mb-5">
        <h3 class="mb-4">
            <i class="bi bi-house-heart"></i>
            Turnos domésticos
        </h3>

        <div class="table-responsive">
            <table class="table table-align-middle">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($turnosDomesticos as $turno)
                        <tr>
                            <td>{{ $turno->nombreDueño }}</td>
                            <td>{{ \Carbon\Carbon::parse($turno->fechaYHora)->format('d/m/y | H:i') }}</td>

                            <td>
                                @if($turno->estado == 'pendiente')
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @elseif($turno->estado == 'reprogramado')
                                    <span class="badge bg-info">Esperando Respuesta</span>
                                @elseif($turno->estado == 'confirmado')
                                    <span class="badge bg-success">Confirmado</span>
                                @elseif($turno->estado == 'cancelado')
                                    <span class="badge bg-danger">Cancelado</span>
                                @endif
                            </td>

                            <td>
                                <div class="acciones-producto">
                                    <!--confirmar-->
                                    <form action="/backend/admin/turnos/domesticos/{{ $turno->id }}/confirmar" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-success btn-sm"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Confirmar turno"
                                            {{ in_array($turno->estado, ['confirmado', 'reprogramado']) ? 'disabled' : ''}}>
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>

                                    <!--reprogramar-->
                                    <button class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-placement="top"
                                        title="Reprogramar turno"
                                        data-bs-target="#modalReprogramarDomestico{{ $turno->id }}"
                                        {{ $turno->estado == 'cancelado' ? 'disabled' : '' }}>
                                        <i class="bi bi-calendar-event"></i>
                                    </button>

                                    <!--cancelar-->
                                    <button class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#cancelarDomestico{{ $turno->id }}"
                                        title="Cancelar turno"
                                        {{ $turno->estado == 'cancelado' ? 'disabled' : '' }}>
                                        <i class="bi bi-x-lg"></i>
                                    </button>

                                    <!--modal-->
                                    <div class="modal fade" id="modalReprogramarDomestico{{ $turno->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Reprogramar turno</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <form action="/backend/admin/turnos/domesticos/{{ $turno->id }}/reprogramar" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-body">
                                                        <label class="form-label">Nueva fecha y hora</label>
                                                        <input type="datetime-local" name="fechaYHora" class="form-control" 
                                                                value="{{ \Carbon\Carbon::parse($turno->fechaYHora)->format('Y-m-d\TH:i') }}"
                                                                min="{{ now()->format('Y-m-d\TH:i') }}" required>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-warning">Reprogramar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--modal cancelar-->
                                    <div class="modal fade" id="cancelarDomestico{{ $turno->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Cancelar turno</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                 
                                                <form action="/backend/admin/turnos/domesticos/{{ $turno->id }}/cancelar" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <label class="form-label">Motivo de cancelacion</label>

                                                        <textarea name="motivo" class="form-control" rows="4" required></textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Volver</button>

                                                        <button class="btn btn-danger">Cancelar turno</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </td>
                        </tr>
                        <!--empty se usa como directiva para comprobar si la var esta vacia o nula-->
                        <!--en este caso muestra si no hay turnos registrados-->
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                No hay turnos domésticos registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!--turnos producción-->
    <div class="admin-panel">
        <h3 class="mb-4">
            <i class="bi bi-building"></i>
            Turnos de producción
        </h3>

        <div class="table-responsive">
            <table class="table table-align-middle">
                <thead>
                    <tr>
                        <th>Establo</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($turnosProduccion as $turno)
                        <tr>
                            <td>{{ $turno->nombreEstablo }}</td>
                            <td>{{ \Carbon\Carbon::parse($turno->fechaYHora)->format('d/m/y | H:i') }}</td>

                            <td>
                                @if ($turno->estado == 'pendiente')
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @elseif($turno->estado == 'reprogramado')
                                    <span class="badge bg-info">Esperando Respuesta</span>
                                @elseif($turno->estado == 'confirmado')
                                    <span class="badge bg-success">Confirmado</span>
                                @elseif($turno->estado == 'cancelado')
                                    <span class="badge bg-danger">Cancelado</span>
                                @endif
                            </td>

                            <td>
                                <div class="acciones-producto">
                                    <!--confirmar-->
                                    <form action="/backend/admin/turnos/produccion/{{ $turno->id }}/confirmar" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-success btn-sm"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Confirmar turno"
                                            {{ in_array($turno->estado, ['confirmado', 'reprogramado']) ? 'disabled' : ''}}>
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>

                                    <!--reprogramar-->
                                    <button class="btn btn-warning btn-sm"
                                        data-bs-placement="top"
                                        title="Reprogramar turno"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalReprogramarProduccion{{ $turno->id }}"
                                        {{ $turno->estado == 'cancelado' ? 'disabled' : '' }}>
                                        <i class="bi bi-calendar-event"></i>
                                    </button>

                                    <!--cancelar-->
                                    <button class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#cancelarProduccion{{ $turno->id }}"
                                        title="Cancelar turno"
                                        {{ $turno->estado == 'cancelado' ? 'disabled' : '' }}>
                                        <i class="bi bi-x-lg"></i>
                                    </button>

                                    <!--modal-->
                                    <div class="modal fade" id="modalReprogramarProduccion{{ $turno->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Reprogramar turno</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <form action="/backend/admin/turnos/produccion/{{ $turno->id }}/reprogramar" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-body">
                                                        <label class="form-label">Nueva fecha y hora</label>
                                                        <input type="datetime-local" name="fechaYHora" class="form-control" 
                                                                value="{{ \Carbon\Carbon::parse($turno->fechaYHora)->format('Y-m-d\TH:i') }}"
                                                                min="{{ now()->format('Y-m-d\TH:i') }}" required>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-warning">Reprogramar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!--modal cancelar-->
                                    <div class="modal fade" id="cancelarProduccion{{ $turno->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Cancelar turno</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                 
                                                <form action="/backend/admin/turnos/produccion/{{ $turno->id }}/cancelar" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <label class="form-label">Motivo de cancelacion</label>

                                                        <textarea name="motivo" class="form-control" rows="4" required></textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Volver</button>

                                                        <button class="btn btn-danger">Cancelar turno</button>
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
                            <td colspan="4" class="text-center text-muted py-4">
                                No hay turnos de producción registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection