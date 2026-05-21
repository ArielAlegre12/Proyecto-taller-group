@extends('layouts.app')

@section('title')
    Comercialización
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/comercializacion.css') }}">
@endpush

@section('h1')
    Comercialización
    <p class="lead">
        Información sobre métodos de pago, envíos y políticas comerciales
    </p>
@endsection

@section('content')
    <!--métodos de pago-->
    <section class="py-5">
        <div class="container">

            <div class="text-center mb-5" id="metodos-pago">
                <h2 class="section-title">Métodos de Pago</h2>
                <p class="section-subtitle">
                    Ofrecemos múltiples opciones para que compres de forma segura
                </p>
            </div>

            <div class="row g-4">

                <div class="col-md-6">
                    <div class="card custom-card h-100">
                        <div class="d-flex gap-3">
                            <div class="icon-box">
                                <i class="bi bi-phone"></i>
                            </div>
                            <div>
                                <h5>Mercado Pago</h5>
                                <p class="text-muted">
                                    Paga con tarjetas o saldo en cuenta
                                </p>
                            </div>
                        </div>

                        <ul class="custom-list">
                            <li>Hasta 12 cuotas sin interés</li>
                            <li>Pago en efectivo</li>
                            <li>QR inmediato</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card custom-card h-100">
                        <div class="d-flex gap-3">
                            <div class="icon-box">
                                <i class="bi bi-credit-card"></i>
                            </div>
                            <div>
                                <h5>Tarjetas</h5>
                                <p class="text-muted">
                                    Aceptamos todas las principales
                                </p>
                            </div>
                        </div>

                        <ul class="custom-list">
                            <li>Visa o Mastercard</li>
                            <li>Cuotas disponibles</li>
                            <li>Pago seguro</li>
                        </ul>
                    </div>
                </div>

            </div>

            <!--destacado-->
            <div class="highlight-box mt-5">
                <div class="row align-items-center">

                    <div class="col-md-8">
                        <h4>¿Por qué elegir Mercado Pago?</h4>
                        <ul>
                            <li>Protección al comprador</li>
                            <li>Múltiples formas de pago</li>
                            <li>Seguimiento desde la app</li>
                        </ul>
                    </div>


                    <div class="col-md-4 text-center">
                        <div class="badge-box">
                            <small>Paga con</small>
                            <h5>Mercado Pago</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--section-->
    <section class="py-5 bg-light">
        <div class="container">

            <div class="text-center mb-5">
                <h2 class="section-title" id="envios">Opciones de Envío</h2>
            </div>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card custom-card h-100">
                        <i class="bi bi-truck icon-main"></i>
                        <h5>Envío a domicilio</h5>
                        <ul class="custom-list">
                            <li>Gratis en compras grandes</li>
                            <li>2-5 días hábiles</li>
                            <li>Seguimiento online</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card custom-card h-100">
                        <i class="bi bi-shop icon-main"></i>
                        <h5>Retiro en tienda</h5>
                        <ul class="custom-list">
                            <li>Sin costo</li>
                            <li>Disponible en 24hs</li>
                            <li>Retiro Rápido</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card custom-card h-100">
                        <i class="bi bi-lightnig icon-main"></i>
                        <h5>Envío express</h5>
                        <ul class="custom-list">
                            <li>Mismo día</li>
                            <li>Pedidos antes de las 12hs</li>
                            <li>Zona urbana</li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!--garantía y devoluciones-->
    <section class="py-5">
        <div class="container">
            <div class="row g-5">

                <div class="col-md-6">
                    <h3 class="section-title">Garantía de Calidad</h3>
                    <p class="section-subtitle">
                        Todos nuestros productos tienen garantía.
                    </p>

                    <div class="box-light">
                        <ul class="custom-list">
                            <li>Productos certificados</li>
                            <li>30 días de garantía</li>
                            <li>Asesoramiento veterinario</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6" id="devoluciones">
                    <h3 class="section-title">Devoluciones</h3>

                    <div class="box-light">
                        <ul class="custom-list">
                            <li>Producto sin uso</li>
                            <li>Hasta 30 días</li>
                            <li>Con comprobantes</li>
                            <li>Alimentos no aplican</li>
                        </ul>

                        <a href="/terminosUsos" class="link-primary">
                            Ver términos →
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <!--contacto-->
    <section class="contact-section text-white text-center">
        <div class="container">
            <h3>¿Tenés dudas?</h3>
            <p class="mb-4">Nuestro equipo puede ayudarte</p>

            <a href="/consultas" class="btn btn-light me-2">Consultar</a>
            <a href="/informacionContactos" class="btn btn-outline-light">Contactar</a>
        </div>
    </section>
@endsection