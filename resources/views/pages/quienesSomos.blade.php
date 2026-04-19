@extends('layouts.app')

@section('title')
    Quiénes Somos
@endsection

@section('h1')
    Quiénes Somos
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/quienesSomos.css') }}">

@endpush
@section('content')

    <div class="container mt-5">
        <div class="form-container">
            <h2 class="titulo-sobre">Sobre Huellas Felices</h2>

            <p>Somos la tienda online de productos para mascotas número uno en Argentina. Aquí podrás encontrar todo lo
                que necesites para tu mascota. Disponemos de más de 30.000 productos pensados para que disfruten
                ellos y tú te los lleves siempre al mejor precio.

                Comenzamos en 2026 nuestro proyecto web con la premisa de mejorar la experiencia de compra online y
                ayudar a nuestros clientes a disfrutar al máximo de sus mascotas. Nuestro éxito se basa en ofrecerte
                siempre los productos de calidad que necesitas sin importar su ubicación geográfica en un plazo de
                tiempo récord.
                Sabemos que lo necesitas y lo quieres cuanto antes.</p>

            <div class="row mt-4">
                <div class="col-md-6 order-md-1 text-center mb-3">
                    <img src="{{ asset('images/persona_perro.jpg') }}" alt="img-sobre">
                </div>

                <div class="col-md-6 order-md-2">
                    <h2 class="titulo-sobre">
                        Tu veterinaria y tienda de confianza
                    </h2>
                    <p>Nuestro objetivo es brindar una atención de calidad tanto en el ámbito clínico como en la
                        comercialización de productos, asegurando el bienestar de cada mascota y la tranquilidad de sus
                        dueños.</p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6 order-md-1 text-center">
                    <img src="{{ asset('images/perro_chica.jpg') }}" alt="img-sobre">
                </div>


                <div class="col-md-6 ">
                    <h2 class="titulo-sobre order-md-2">
                        Pasion por los animales
                    </h2>
                    <p>Contamos con atención veterinaria para animales domésticos y de producción, ofreciendo
                        servicios como consultas, vacunación, controles sanitarios y visitas a domicilio o en campo.</p>

                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6 order-md-1 text-center mb-3">
                    <img src="{{ asset('images/gatito.jpg') }}" alt="img-sobre">
                </div>

                <div class="col-md-6 order-md-2">
                    <h2 class="titulo-sobre">
                        Compras y entregas adaptadas a ti
                    </h2>
                    <p>Además, disponemos de una tienda donde podrás encontrar alimentos balanceados,
                        medicamentos veterinarios y accesorios esenciales para el cuidado diario de tus mascotas y podemos
                        entregar tus
                        productos favoritos a tu domicilio.</p>

                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6 order-md-2 text-center">
                    <img src="{{ asset('images/gatito2.jpg') }}" alt="img-sobre">
                </div>

                <div class="col-md-6 order-md-1">
                    <h2 class="titulo-sobre">
                        Disponibles siempre para ayudarte
                    </h2>
                    <p class="text-justify">¿Tienes alguna duda? Puedes encontrar todas las respuestas en nuestras Preguntas Frecuentes. Nos
                        comprometemos a ofrecer productos de calidad y asesoramiento personalizado, ayudando a cada cliente
                        a elegir la mejor opción para sus necesidades.</p>
                </div>
            </div>

            <h2 class="titulo-sobre-equipo text-center mt-5">Nuestro equipo</h2>

            <div class="container mt-5">
                <div class="row g-4">
                    
                    <div class="col-md-6 d-flex">
                        <div class="card h-100">
                            <div class="row g-0">
                                <div class="img-vete col-md-4">
                                    <img src="{{ asset('images/giuli.jpg') }}"
                                        class="img-fluid w-100 h-100 object-fit-cover" alt="mujer-vete">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Dra. Giuliana Miranda</h5>
                                        <p class="card-text">La Dra. Giuliana Miranda forma parte del equipo de Huellas
                                            Felices
                                            y se
                                            especializa en la atención de animales de producción. Cuenta con experiencia en
                                            sanidad,
                                            control y manejo de ganado, brindando un servicio profesional orientado al
                                            bienestar
                                            animal
                                            y a la mejora de la producción.</p>
                                        <p class="card-text"><small class="text-body-secondary">Ultima actualizacion hace 3
                                                minutos</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 d-flex">
                        <div class="card h-100">
                            <div class="row g-0">
                                <div class="img-vete col-md-4">
                                    <img src="{{ asset('images/veterinario.jpg') }}"
                                        class="img-fluid h-100 w-100 object-fit-cover" alt="hombre-vete">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Dr. Pedro Sanchez</h5>
                                        <p class="card-text text-justify">El Dr. Pedro Sánchez forma parte del equipo de Huellas Felices
                                            y se
                                            encarga de la atención general veterinaria, brindando consultas, vacunaciones y
                                            controles sanitarios para animales domésticos. Además, participa en el área de
                                            ventas, asesorando a los clientes en la elección de productos y garantizando una
                                            atención completa orientada al bienestar de cada mascota.</p>
                                        <p class="card-text"><small class="text-body-secondary">Ultima actualizacion hace 3
                                                minutos</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection