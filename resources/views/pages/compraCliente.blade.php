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

@php
    $esAdmin = auth()->check() && auth()->user()->rol->nombre === 'admin';
@endphp


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
                                $producto = $item->producto;
                                $subtotal = $producto->precio * $item->cantidad;
                                $total += $subtotal;
                            @endphp

                            <div class="d-flex align-items-center gap-3 producto-item">
                                <img src="{{ asset('storage/' . $producto->imagen) }}" class="producto-img">

                                <div class="flex-grow-1">
                                    <h5 class="producto-nombre mb-1">{{ $producto->nombre }}</h5>
                                    <p class="producto-cantidad mb-1">Cantidad: {{ $item->cantidad }}</p>
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
                                    <select class="form-select" name="metodo_entrega" id="metodoEntrega">
                                        <option value="retiro">Retiro en sucursal</option>
                                        <option value="domicilio">Envío a domicilio</option>
                                        <option value="express">Envío express</option>
                                    </select>
                                    <!--direeción-->
                                    <div id="direccionContainer" class="mt-3 d-none">
                                        <label class="form-label fw-bold">Dirección de envío</label>
                                        <input type="text" class="form-control mb-2" name="direccion"
                                            placeholder="Calle y número">
                                        <input type="text" class="form-control mb-2" name="ciudad" placeholder="Ciudad">
                                        <input type="text" class="form-control mb-2" name="codigo_postal"
                                            placeholder="Código postal">
                                    </div>
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
                                            inputmode="numeric"
                                            placeholder="Número de tarjeta">

                                            <div id="tipoTarjeta" class="mt-2 small text-muted"></div>
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
                                            <input type="text" class="form-control" name="cvv" inputmode="numeric" placeholder="CVV">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span id="subtotal">
                                        ${{ number_format($total, 2, ',', '.') }}
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Envío</span>
                                    <span id="costoEnvio">$0</span>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between mb-4 resumen-total">
                                    <strong>Total</strong>
                                    <strong id="totalFinal">${{ number_format($total, 2, ',', '.') }}</strong>
                                </div>

                                <div id="checkoutData" data-total="{{ $total }}"></div>

                                @if ($esAdmin)
                                    <button class="btn btn-success w-100 py-3 btn-disabled" disabled>
                                        Sólo clientes
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-success w-100 py-3 btn-confirmar">
                                        Confirmar compra
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection