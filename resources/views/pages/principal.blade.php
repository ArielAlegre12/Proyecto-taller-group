@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/inicioStyle.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/animaciones.js') }}"></script>
@endpush

@section('content')
    <!--sección carrusel---->
    <section id="heroCarousel" class="carousel slide carousel-fade hero" data-bs-ride="carousel" data-bs-interval="4000">

        <!--indicadores--->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>

        <!--slides--->
        <div class="carousel-inner">

            <div class="carousel-item active hero-slide"
                style="background-image:url('{{ asset('images/carrusel/slide1.png') }}')">

                <div class="hero-content">
                    <h1>Cuidamos a tus mascotas <strong>como si fueran nuestras</strong></h1>
                    <p>Atención veterinaria profesional para animales domésticos y de campo.</p>

                    <div class="hero-buttons">
                        <a href="/servicios" class="btn-primary">Ver Servicios</a>
                        <a href="/tienda" class="btn-secondary">Ir a la Tienda</a>
                    </div>
                </div>
            </div>

            <div class="carousel-item hero-slide" style="background-image:url('{{ asset('images/carrusel/slide2.png') }}')">

                <div class="hero-content">
                    <h1>Emergencias 24/7</h1>
                    <p>Siempre listos para cuidar a tu mascota en cualquier momento.</p>

                    <div class="hero-buttons">
                        <a href="/informacionContactos" class="btn-primary">Contactar</a>
                    </div>
                </div>
            </div>

            <div class="carousel-item hero-slide" style="background-image:url('{{ asset('images/carrusel/slide3.png') }}')">
                <div class="hero-content">
                    <h1>Equipo profesional certificado</h1>
                    <p>Experiencia y amor por los animales en cada consulta.</p>

                    <div class="hero-buttons">
                        <a href="/quienesSomos" class="btn-primary">Conocenos</a>
                    </div>
                </div>
            </div>
        </div>
        <!--controles-->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </section>

    <!--sección iconos--->
    <section class="features animar">

        <div class="feature">
            <i class="bi bi-heart"></i>
            <h3>Atención Personalizada</h3>
            <p>Cada mascota recibe un trato único</p>
        </div>

        <div class="feature">
            <i class="bi bi-clock"></i>
            <h3>Servicio 24/7</h3>
            <p>Emergencias siempre disponibles</p>
        </div>

        <div class="feature">
            <i class="bi bi-shield"></i>
            <h3>Instalaciones Modernas</h3>
            <p>Equipamiento de última generación</p>
        </div>

        <div class="feature">
            <i class="bi bi-award"></i>
            <h3>Professionales</h3>
            <p>Equipo certificado y con experiencia</p>
        </div>
    </section>

    <!--cta-->
    <section class="cta animar">
        <h2>¿Necesitas atención urgente?</h2>
        <p>Contáctanos ahora y te atendemos</p>

        <a href="tel:+543791323421" class="cta-btn">Llamar ahora</a>
    </section>
@endsection