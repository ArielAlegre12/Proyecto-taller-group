@extends('layouts.app')

@section('title')
    Comercialización
@endsection

@section('h1')
    Comercialización
@endsection

@section('content')
    <section class="comercial-header text-white d-flex align-items-center">
        <div class="container">
            <h1 class="display-5 fw-bold">Comercialización</h1>
            <p class="lead">
                Información sobre métodos de pago, envíos y políticas coerciales
            </p>
        </div>
    </section>

    <!--métodos de pago-->
    <section class="py-5">
        <div class="container">

        <div class="text-center mb-5">
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
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection