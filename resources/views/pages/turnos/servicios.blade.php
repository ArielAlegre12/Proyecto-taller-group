@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/turnos.css') }}">
@endpush

@section('title')
    Servicios de turnos
@endsection

@section('h1')
    Servicios de Turnos <i class="bi bi-calendar-check"></i>
@endsection

@section('content')

    <div class="container-fluid mt-5">
        <div class="row text-center ">
            <div class="col-12 col-md-6 mb-2">
                <a href="{{ route('pages.turnos.produccion') }}" class="btn btn-outline-success custom-btn">
                    <img src="{{ asset('images/caballo.png') }}" alt="caballo">
                    <p>Animales de producción</p>
                </a>
            </div>
            <div class="col-12 col-md-6 mb-2">
                <a href="{{ route('pages.turnos.domestico') }}" class="btn btn-outline-success custom-btn">
                    <img src="{{ asset('images/gato.png') }}" alt="gato">
                    <p>Animales domésticos</p>
                </a>
            </div>

        </div>
    </div>

@endsection