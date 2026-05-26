@extends('layouts.admin')

@section('admin-content')
    <div class="admin-header">
        <h2>Dashboard</h2>
        <p>Bienvenido, {{ Auth::user()->nombre }}</p>
    </div>

    <!--cards resumen-->
    <div class="resumen-grid">
        <div class="resumen-card">
            <i class="bi bi-box-seam"></i>
            <h3>{{ $totalProductos }}</h3>
            <p>Productos</p>
        </div>

        <div class="resumen-card">
            <i class="bi bi-people"></i>
                <h3>{{ $totalUsuarios }}</h3>
                <p>Usuarios</p>
        </div>

        <div class="resumen-card">
            <i class="bi bi-calendar-check"></i>
            <h3>{{ $totalTurnos }}</h3>
            <p>Turnos pendientes</p>
        </div>

        <div class="resumen-card">
            <i class="bi bi-exclamation-triangle"></i>
            <h3>{{ $stockBajo }}</h3>
            <p>Stock bajo</p>
        </div>

        <div class="resumen-card">
            <i class="bi bi-clipboard2-pulse"></i>
            <h3>{{ $totalConsultas }}</h3>
            <p>Consultas</p>
        </div>
    </div>

    <!--actividad-->
    <div class="admin-panel mt-5">
        <h3 class="mb-4">
            Actividad reciente
        </h3>

        @foreach ($ultimosUsuarios as $usuario)
            <div class="actividad-item">
                <i class="bi bi-person-plus"></i>
                Nuevo usuario registrado:
                <strong>{{ $usuario->nombre }}</strong>
            </div>
        @endforeach

        @foreach ($ultimosProductos as $producto)
            <div class="actividad-item">
                <i class="bi bi-box-seam"></i>
                Producto agregado:
                <strong>{{ $producto->nombre }}</strong>
            </div>
        @endforeach

        @foreach ($ultimosTurnosDomesticos as $turnoDomestico)
            <div class="actividad-item">
                <i class="bi bi-house-heart"></i>
                Nuevo turno doméstico:
                <strong>{{ $turnoDomestico->nombreMascota }}</strong>
            </div>
        @endforeach

        @foreach ($ultimosTurnosProduccion as $turnoProduccion)
            <div class="actividad-item">
                <i class="bi bi-building"></i>
                Nuevo turno de producción:
                <strong>{{ $turnoProduccion->nombreEstablo }}</strong>
            </div>
        @endforeach

        @foreach ($ultimasConsultas as $consulta)
            <div class="actividad-item">
                <i class="bi bi-clipboard2-pulse"></i>
                Nueva consulta registrada:
                <strong>{{ $consulta->nombre }}</strong>
            </div>        
        @endforeach
    </div>
@endsection