@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/infoContactoStyle.css') }}">
@endpush

@section('title')
    Comercialización
@endsection

@section('h1')
    Información de Contacto
@endsection

@section('content')

    <div class="container my-4">

        <div class="row g-4">
            <!--info-->
            <div class="col-12 col-lg-6">
                <div class="card shadow-sm p-3 h-100">
                    <p><strong>Razón social:</strong> Huellas Felices S.A.</p>
                    <p><i class="bi bi-geo-alt-fill text-success me-2"></i>Juan Bautista Cabral 2139, W3402BKG Corrientes.
                    </p>
                    <p><i class="bi bi-telephone-fill text-success me-2"></i>+54 3791323421</p>
                    <p><i class="bi bi-envelope-fill text-success me-2"></i>huellasFelicesShop@gmail.com</p>
                    <p><i class="bi bi-clock-fill text-success me-2"></i>Lunes a Sábado de 09:00 a 18:00</p>

                    <h4 class="mt-3">Envíanos un mensaje</h4>

                    <form>
                        <label class="form-label">Nombre</label>
                        <input type="text" placeholder="Ingrese su nombre" class="form-control mb-2">

                        <label class="form-label">Email</label>
                        <input type="email" placeholder="Ingrese su correo" class="form-control mb-2">

                        <label class="form-label">Mensaje</label>
                        <textarea placeholder="Escriba su mensaje" class="form-control mb-2"></textarea>

                        <button class="btn btn-success w-100">Enviar</button>
                    </form>
                </div>
            </div>


            <!--mapa-->
            <div class="col-12 col-lg-6">
                <div class="card shadow-sm h-100">
                    <iframe class="w-100 h-100 rounded"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.318048711076!2d-58.82530232562345!3d-27.45935611626356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456b50b9fd1a8b%3A0x22618495d2b5eefd!2sFacultad%20de%20Ciencias%20Veterinarias!5e0!3m2!1ses-419!2sar!4v1776190328765!5m2!1ses-419!2sar"
                        style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                    <div class="p-2">
                        <a href="https://maps.app.goo.gl/8mFkb9423Gx77qVi6" target="_blank"
                            class="btn btn-outline-success w-100">
                            <i class="bi bi-map"></i>Cómo llegar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection