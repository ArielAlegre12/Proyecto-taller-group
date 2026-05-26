@extends('layouts.app')
@section('title')
    Panel de administración
@endsection

@section('h1')
    Panel de administración
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')

    <div class="admin-container">
        <!--sidebar-->
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <div class="admin-logo-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <div>
                    <h3>Panel Admin</h3>
                    <span>Huellas Felices</span>
                </div>
            </div>
            
            <ul class="admin-menu">
                <li>
                    <a href="/backend/admin"><i class="bi bi-grid"></i>Dashboard</a>
                </li>
                <li>
                    <a href="/backend/admin/productos"><i class="bi bi-box-seam"></i>Productos</a>
                </li>
                <li>
                    <a href="/backend/admin/usuarios"><i class="bi bi-people"></i>Usuarios</a>
                </li>
                <li>
                    <a href="/backend/admin/turnos"><i class="bi bi-calendar-check"></i>Turnos</a>
                </li>
                <li>
                    <a href="/backend/admin/ventas"><i class="bi bi-cash-stack"></i>Ventas</a>
                </li>
                <li>
                    <a href="/backend/admin/consultas"><i class="bi bi-clipboard2-pulse"></i>Consultas</a>
                </li>
            </ul>
        </aside>

        <!--contenido dinamico-->
        <main class="admin-content">
            @yield('admin-content')
        </main>
    </div>
@endsection