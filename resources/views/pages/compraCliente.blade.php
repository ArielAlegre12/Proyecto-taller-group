@extends('layouts.app')
@section('title')
    Finalizar compra
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/finalizarCompra.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('js/global/checkout.js') }}"></script>
@endpush

@section('content')
    <div class="container py-5 checkout-container">
        <div class="mb-5">
            <h1 class="checkout-title">Finalizar compra</h1>
            <p class="text-muted">Revisa tus productos y completa los datos</p>
        </div>


        <div class="row g-4">
            <!--productos-->
            <div class="col-lg-8">
                <div class="card checkout-card">
                    <div class="card-body p-4">
                        <h4 class="mb-4">
                            <i class="bi bi-bag-check me-2"></i>
                            Productos
                        </h4>
                        @php
                            $total = 0;
                        @endphp

                        @foreach ($carrito as $item)
                            @php
                                $subtotal = $item['precio'] * $item['cantidad'];
                                $total += $subtotal;
                            @endphp

                            <div class="d-flex align-items-center gap-3 producto-item">
                                <img src="{{ asset('storage/' . $item['imagen']) }}" class="producto-img">

                                <div class="flex-grow-1">
                                    <h5 class="producto-nombre mb-1">{{ $item['nombre'] }}</h5>
                                    <p class="producto-cantidad mb-1">Cantidad: {{ $item['cantidad'] }}</p>
                                    <strong class="producto-precio">${{ number_format($subtotal, 2, ',', '.') }}</strong>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!--resumen-->
            <div class="col-lg-4 align-items-start">
                <div class="resumen-sticky">
                    <form action="{{ route('cliente.finalizarCompra') }}" method="POST">
                        @csrf
                        <div class="card checkout-card">
                            <div class="card-body p-4">
                                <h4 class="mb-4">
                                    <i class="bi bi-receipt me-2"></i>
                                    Resumen
                                </h4>
                                <p class="text-muted mb-3">
                                    {{ collect($carrito)->sum('cantidad') }} productos en tu compra
                                </p>
                                <!--entrega-->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Método de entrega</label>
                                    <select class="form-select" name="metodo_entrega">
                                        <option value="retiro">Retiro en sucursal</option>
                                        <option value="domicilio">Envío a domicilio</option>
                                    </select>
                                </div>

                                <!--pago-->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Método de pago</label>
                                    <select class="form-select" name="metodo_pago" id="metodoPago">
                                        <option value="tarjeta">Tarjeta</option>
                                        <option value="mercadopago">Mercado pago</option>
                                        <option value="efectivo">Efectivo</option>
                                    </select>
                                </div>

                                <!--datos de la tarjeta-->
                                <div id="datosTarjeta">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="numero_tarjeta"
                                            placeholder="Número de tarjeta">
                                    </div>

                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="titular" placeholder="Titular">
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" name="vencimiento" placeholder="MM/AA"
                                                maxlength="5">
                                        </div>

                                        <div class="col">
                                            <input type="text" class="form-control" name="cvv" placeholder="CVV">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between mb-4 resumen-total">
                                    <strong>Total</strong>
                                    <strong>${{ number_format($total, 2, ',', '.') }}</strong>
                                </div>

                                <button type="submit" class="btn btn-success w-100 py-3 btn-confirmar">Confirmar
                                    compra</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection