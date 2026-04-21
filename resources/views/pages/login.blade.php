    @extends('layouts.app')
    @section('title')
        Login
    @endsection

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @endpush

    @push('scripts')
    <script src="{{ asset('js/login.js') }}"></script>
    @endpush

    @section('h1')
        Inicio de sesion
    @endsection

    @section('content')

        <div class="container d-flex align-items-center justify-content-center min-vh-100">
            <div class="login-container">
                <div class="text-center mb-4">
                    <div class="text-center mb-0">
                        <img src="{{ asset('images/logoSF.png') }}" alt="logo" class="logo-img-grande">
                    </div>
                    <h2>Huellas Felices</h2>
                    <p class="text-muted">Inicia sesion de tu cuenta</p>
                </div>

                <div class="card p-4 shadow">
                    <div class="d-flex bg-light rounded p-1 mb-4">
                        <button type="button" id="btnLogin" class="btn btn-tab active w-50">Iniciar sesion</button>
                        <button type="button" id="btnRegister" class="btn btn-tab w-50">Registrarse</button>
                    </div>

                    <form id="formulario">
                        <div class="mb-3 d-none fade-slide"  id="grupoNombre">
                            <label class="form-label">Nombre Completo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" id="nombre" class="form-control" placeholder="Juan Perez">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo Electronico</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" id="email" class="form-control" placeholder="correo@ejemplo.com">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" id="password" class="form-control" placeholder="••••••••">
                                <button class="btn btn-outline-secondary" type="button" id="togglePass">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3 d-none fade-slide"  id="grupoConfirm">
                            <label class="form-label">Confirmar Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" id="confirmPassword" class="form-control" placeholder="••••••••">
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mb-3">
                            <div>
                                <input type="checkbox"> Recordame
                            </div>

                            <a href="#" class="link-success">¿Olvidaste tu contraseña?</a>
                        </div>

                        <button type="submit" id="submitBtn" class="btn btn-success w-100 mb-3">
                            Iniciar Sesion
                        </button>
                    </form>

                    <div class="divider text-center my-3">
                        <span>o</span>
                    </div>

                    <button class="btn btn-outline-secondary w-100">
                        <i class="bi bi-google">Continuar con Google</i>
                    </button>
                </div>

                <p class="text-center mt-3 small">Al registrarte, aceptas nuestros
                    <a href="/terminosUsos" class="text-success">Terminos y Condiciones</a>
                </p>
            </div>
        </div>

    @endsection