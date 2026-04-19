@extends('layouts.app')
@section('title')
    Turnos de produccion
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/turno_domestico.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('h1')
    Animales Domésticos
@endsection

@section('content')

    <div class="container">
        <div class="form-container">

            <div class="container mt-5">
                <div class="mb-3">
                    <label class="form-label">Nombre del dueño</label>
                    <input type="text" class="form-control" placeholder="Ingrese su nombre">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nombre de la mascota</label>
                    <input type="text" class="form-control" placeholder="Nombre de la mascota">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo de mascota</label>
                    <input type="text" class="form-control" placeholder="Tipo de la mascota">
                </div>

                <div class="mb-3">
                    <label class="form-label">Motivo</label>
                    <select class="form-select">
                        <option select disabled>Seleccionar</option>
                        <option>Consulta General</option>
                        <option>Vacunacion</option>
                        <option>Urgencia</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha y Hora</label>
                    <input type="text" id="fechaHora" class="form-control" placeholder="Seleccionar fecha y Hora">
                </div>

                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                <script>
                    flatpickr("#fechaHora", {
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        minDate: "today",
                        time_24hr: true
                    });
                </script>

                <button type="button" class="btn btn-success w-100">
                    Confirmar Turno
                </button>
            </div>
        </div>
    </div>

@endsection