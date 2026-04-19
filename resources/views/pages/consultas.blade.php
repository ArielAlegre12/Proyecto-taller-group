@extends('layouts.app')

@section('title')
    Consultas
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{ asset('css/consultas.css') }}">
@endpush

@section('h1')
    Consultas
@endsection

@section('content')

    <div class="container-fluid p-0">
        <section class="py-5 bg-light">
            <div class="container">
                <div class="card form-card p-4 shadow-sm">
                    <form>
                        <h4 class="mb-4">Informacion del Cliente</h4>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre Completo *</label>
                                <input type="text" class="form-control" placeholder="Juan Perez">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Telefono *</label>
                                <input type="text" class="form-control" placeholder="(123) 456789">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Correo *</label>
                                <input type="text" class="form-control" placeholder="correo@ejemplo.com">
                            </div>
                        </div>
                        <hr class="my-4">

                        <h4 class="mb-4">Informacion del Animal</h4>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Tipo de animal *</label>
                                <select id="tipoAnimal" class="form-select">
                                    <option selected disabled>Seleccionar...</option>
                                    <option value="domestico">Domestico</option>
                                    <option value="campo">Campo</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nombre del animal *</label>
                                <input type="text" class="form-control" placeholder="Firu">
                            </div>

                            <div id="domesticoFields" class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Especie *</label>
                                    <select class="form-select">
                                        <option selected disabled>Seleccionar...</option>
                                        <option>Perro</option>
                                        <option>Gato</option>
                                        <option>Ave</option>
                                        <option>Otro</option>
                                    </select>
                                </div>
                            </div>

                            <div id="campoFields" class="d-none">
                                <label class="form-label">Tipo de animal de campo</label>
                                <select class="form-select">
                                    <option selected disabled>Seleccionar...</option>
                                    <option>Bovino</option>
                                    <option>Equino</option>
                                    <option>Ovino</option>
                                    <option>Porcino</option>
                                    <option>Caprino</option>
                                    <option>Otro</option>
                                </select>
                            </div>

                            <div id="domesticoFields" class="row g-3"></div>
                            <div class="col-md-6">
                                <label class="form-label">Raza</label>
                                <input type="text" class="form-control" placeholder="Labrador, Persa, etc.">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Edad</label>
                                <input type="text" class="form-control" placeholder="2 años, 6 meses, etc">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Peso(kg)</label>
                                <input type="text" class="form-control" placeholder="25">
                            </div>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-4">Detalle de la consulta</h4>

                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Tipo de Consulta *</label>
                                <select class="form-select">
                                    <option>Consulta General</option>
                                    <option>Vacunacion</option>
                                    <option>Cirugia</option>
                                    <option>Emergencia</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Fecha y Hora *</label>
                                <input type="text" id="fechaHora" class="form-control"
                                    placeholder="Seleccionar fecha y Hora">
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

                            <div class="col-12">
                                <label class="form-label">Descripcion del Motivo de Consulta *</label>
                                <textarea class="form-control" rows="4" placeholder="Describe los sintomas o motivo de la consulta..."></textarea>
                            </div>
                        </div>

                        <button type="button" class="btn btn-success w-100 mt-4">
                            Agendar Consulta
                        </button>

                        <p class="texto-aviso">* Campos obligatorios. Te contactaremos para confirmar tu cita.</p>
                    </form>

                </div>
            </div>
        </section>
        <section class="py-5 bg-white text-center">
            <div class="container">
                <h3 class="mb-5">¿Por qué agendar con nosotros?</h3>

                <div class="row">
                    <div class="col-md-4">
                        <div class="beneficio">
                            <div class="icono">📅</div>
                            <h5>Atencion Rapida</h5>
                            <p>Confirmacion en menos de 24hs</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="beneficio">
                            <div class="icono">🐾</div>
                            <h5>Expertos Certificados</h5>
                            <p>Veterinarios con amplia experiencia y certificaciones</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="beneficio">
                            <div class="icono">⏰</div>
                            <h5>Horario Flexibles</h5>
                            <p>Abierto 7 días a la semana con emergencias 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-verde text-white text-center py-5">
            <h3>¿Tienes una emergencia?</h3>
            <p>Llámanos ahora para atención inmediata</p>
            <a href="#" class="btn btn-light">📞 +54 3791323421</a>
        </section>
    </div>
@endsection