@extends('layouts.admin')

@section('admin-content')

    <div class="admin-header mb-4">
        <div>
            <h2>Detalle de consulta</h2>
            <p>Informacion completa de la consulta veterinaria</p>
        </div>
    </div>

    <div class="admin-panel">
        <div class="usuario-detalle">
            <div class="usuario-avatar-grade">
                {{ strtoupper(substr($consulta->nombre, 0, 1)) }}
            </div>

            <div class="usuario-info">
                <h3>{{ $consulta->nombre }}</h3>
                <p class="text-muted mb-2">
                    {{ $consulta->email }}
                </p>

                @if ($consulta->estado == 'Pendiente')
                    <span class="badge bg-warning text-dark">
                        Pendiente
                    </span>

                @elseif($consulta->estado == 'confirmado')
                    <span class="badge bg-success">
                        Cofirmada
                    </span>
                @endif
            </div>
        </div>
        <hr class="my-4">

        <!--datos-->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="info-card">
                    <span>Fecha de consulta</span>

                    <h5>
                        {{ \Carbon\Carbon::parse($consulta->fecha_hora)->format('d/m/Y | H:i') }}
                    </h5>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-card">
                    <span>Nombre del animal</span>
                    <h5>{{ $consulta->nombre_animal }}</h5>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-card">
                    <span>Tipo Animal</span>
                    <h5>{{ $consulta->tipo_animal }}</h5>
                </div>
            </div>

            @if($consulta->tipo_animal == 'domestico')

                <div class="col-md-6">
                    <div class="info-card">
                        <span>Especie</span>

                        <h5>{{ $consulta->especie }}</h5>
                    </div>
                </div>

            @elseif($consulta->tipo_animal == 'campo')

                <div class="col-md-6">
                    <div class="info-card">
                        <span>Tipo de animal de campo</span>

                        <h5>{{ $consulta->tipo_campo }}</h5>
                    </div>
                </div>

            @endif

            <div class="col-md-6">
                <div class="info-card">
                    <span>Tipo Consulta</span>
                    <h5>{{ $consulta->tipo_consulta }}</h5>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-card">
                    <span>Raza</span>
                    <h5>{{ $consulta->raza }}</h5>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-card">
                    <span>Edad</span>
                    <h5>{{ $consulta->edad }}</h5>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-card">
                    <span>Peso</span>
                    <h5>{{ $consulta->peso }} kg</h5>
                </div>
            </div>
        </div>

        <!--descripcion-->
        <div class="info-card mt-4">
            <span>Descripcion</span>

            <p class="mt-2 mb-0">
                {{ $consulta->descripcion }}
            </p>
        </div>

        <!--acciones-->
        <div class="mt-5 d-flex gap-3">

            <!--confirmar-->
            <form action="/backend/admin/consultas/{{ $consulta->id }}/confirmar" method="POST">
                @csrf
                @method('PUT')

                <button class="btn btn-success" {{ $consulta->estado == 'confirmardo' ? 'disabled' : '' }}>
                    Confirmar Consulta
                </button>
            </form>

            <!--boton-->
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminarConsulta">
                Eliminar Consulta
            </button>

            <!--modal-->
            <div class="modal fade" id="modalEliminarConsulta" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">
                                Eliminar consulta
                            </h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>

                        <form action="/backend/admin/consultas/{{ $consulta->id }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="modal-body">

                                <label class="form-label">
                                    Motivo de eliminación
                                </label>

                                <textarea name="motivo" class="form-control" rows="4"
                                    placeholder="Escriba el motivo de la eliminación..." required></textarea>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>

                                <button type="submit" class="btn btn-danger">
                                    Eliminar Consulta
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <a href="/backend/admin/consultas" class="btn btn-secondary">
                Volver
            </a>
        </div>
    </div>
@endsection