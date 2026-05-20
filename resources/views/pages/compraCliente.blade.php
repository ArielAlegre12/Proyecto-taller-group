@extends('layouts.app')
@section('title')
    Finalizar compra
@endsection
@push('scripts')
    <script src="{{ asset('js/global/checkout.js') }}"></script>
@endpush

@section('content')
    <div class="container py-5">
        <div class="mb-5">
            <h1>Finalizar compra</h1>
            <p class="text-muted">Revisa tus productos y completa los datos</p>
        </div>
    </div>

    <div class="row g-4">
        <!--productos-->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h4 class="mb-4">Productos</h4>
                    @php
                        $total = 0;
                    @endphp

                    @foreach ($carrito as $item)
                        @php
                            $subtotal = $item['precio'] * $item['cantidad'];
                            $total += $subtotal;
                        @endphp

                        <div class="d-flex align-items-center gap-3 mb-4">
                            <img src="{{ asset('storage/' . $item['imagen']) }}" width="90" class="rounded-3 img-fluid">

                            <div class="flex-grow-1">
                                <h5 class="mb-1">{{ $item['nombre'] }}</h5>
                                <p class="text-muted mb-1">Cantidad: {{ $item['cantidad'] }}</p>
                                <strong>${{ number_format($subtotal, 2, ',', '.') }}</strong>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!--resumen-->
        <div class="col-lg-4">
            <form action="{{ route('cliente.finalizarCompra') }}" method="POST">
                @csrf
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Resumen</h4>

                        <!--entrega-->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Método de entrega</label>
                            <select class="form-select" name="metodo_entrega">
                                <option>Retiro en sucursal</option>
                                <option>Envío a domicilio</option>
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
                                <input type="text" class="form-control" name="numero_tarjeta" placeholder="Número de tarjeta">
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control" name="titular" placeholder="Titular">
                            </div>

                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" name="vencimiento" placeholder="MM/AA">
                                </div>

                                <div class="col">
                                    <input type="text" class="form-control" name="cvv" placeholder="CVV">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total</strong>
                            <strong>${{ number_format($total, 2, ',', '.') }}</strong>
                        </div>

                        <button type="submit" class="btn btn-success w-100 py-3">Confirmar compra</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
