@extends('layouts.app')
@section('title')
    Recuperar Contraseña
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/recuperar-password.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/recuperar-password.js') }}"></script>
    <script src="{{ asset('js/animaciones.js') }}"></script>
@endpush

@section('h1')
    Recuperar Contraseña
@endsection

@section('content')

    <div class="recovery-container">
        <div class="card recovery-card shadow animar">
            <div class="card-body p-5">
                <h2 class="text-center mb-4 animar">
                    Recuperar Contraseña
                </h2>

                <p class="text-muted text-center mb-4 animar">
                    Recupera el acceso a tu cuenta
                </p>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @php
                    $step = session('step', 'email');
                @endphp

                @if ($step == 'email')
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label animar">
                                Correo electronico
                            </label>

                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <button class="btn btn-success w-100 animar">
                            Enviar codigo
                        </button>
                    </form>
                @endif
                @if ($step == 'codigo')
                    <form action="{{ route('password.codigo') }}" method="POST">
                        @csrf

                        <input type="hidden" name="email" value="{{ session('email') }}">

                        <div class="mb-4">
                            <label class="form-label animar">
                                Codigo de verificacion
                            </label>

                            <input type="text" name="codigo" class="form-control codigo-input" maxlength="6" required>
                        </div>

                        <button class="btn btn-success w-100 animar">
                            Verificar codigo
                        </button>
                    </form>

                @endif
                @if ($step == 'password')

                    <form action="{{ route('password.cambiar') }}" method="POST" id="passwordForm">
                        @csrf

                        <input type="hidden" name="email" value="{{ session('email') }}">

                        <div class="mb-3">
                            <label class="form-label animar">
                                Nueva Contraseña
                            </label>

                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-4">
                            <label class="form-label animar">
                                Confirmar contraseña
                            </label>

                            <input type="password" name="password_confirmation" class="form-control" required>

                            <small id="passwordError" class="text-danger d-none">
                                Las contraseñas no coinciden
                            </small>
                        </div>

                        <button class="btn btn-success w-100 animar">
                            Cambiar Contraseña
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection