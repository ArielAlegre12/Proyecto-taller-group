@extends('layouts.app')

@section('title')
    Términos y Usos
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/terminos.css') }}">
@endpush

@section('h1')
    Términos y Usos
@endsection

@section('content')

    <div class="container py-5">


        <div class="card shadow mb-4 p-4">
            <div class="d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-exclamation-circle text-success fs-4"></i>
                <h2 class="mb-0">Introduccion</h2>
            </div>
            <p>Bienvenido a Huellas Felices. Al acceder y utilizar nuestro sitio web
                y servicios, usted acepta cumplir con los siguientes términos y condiciones.
                Por favor, léalos cuidadosamente antes de utilizar nuestros servicios.</p>

            <p>Si no está de acuerdo con alguno de estos términos, le solicitamos
                que no utilice nuestro sitio web ni nuestros servicios.</p>
        </div>
        <div class="card shadow mb-4 p-4">
            <h2>1.Uso del sitio web</h2>
            <div class="col-md-6 mb-3">
                <h5 class="mt-3">1.1 Acceso del sitio</h5>
                <p>El acceso a nuestro sitio web es gratuito. Nos reservamos el derecho de
                    modificar, suspender o discontinuar cualquier aspecto del sitio en cualquier
                    momento sin previo aviso.</p>
            </div>
            <h5>1.2 Uso permitido</h5>
            <p>Usted se compromete a utilizar el sitio únicamente para fines legales y de manera que no infrinja
                los
                derechos de terceros ni restrinja o inhiba el uso del sitio por parte de otros usuarios.
            </p>

            <h5>1.3 Conductas prohibidas</h5>
            <ul>
                <li>Usar el sitio para actividades fraudulentas o ilegales</li>
                <li>Intentar acceder a áreas no autorizadas del sitio</li>
                <li>Intentar acceder a áreas no autorizadas del sitio</li>
                <li>Recopilar información de otros usuarios sin su consentimiento</li>
            </ul>
        </div>

        <div class="card shadow mb-4 p-4">
            <h2>2.Servicios Veterinanrios</h2>

            <h5 class="mt-3">2.1 Profesionalidad</h5>
            <p>Todos nuestros servicios veterinarios son prestados por profesionales certificados y con
                licencia vigente. Nos comprometemos a brindar atención de la más alta calidad a su mascota.
            </p>

            <h5>2.2 Citas y cancelaciones</h5>
            <p>Las citas deben ser programadas con anticipación. Las cancelaciones deben realizarse con al
                menos 24 horas de antelación. Cancelaciones tardías o ausencias sin aviso pueden estar
                sujetas a un cargo.</p>

            <h5>2.3 Emergencias</h5>
            <p>Nuestro servicio de emergencias está disponible 24/7. Sin embargo, los servicios de
                emergencia pueden tener costos adicionales que serán informados al momento de la consulta.
            </p>
        </div>

        <div class="card shadow mb-4 p-4">
            <h2>3. Compras en linea</h2>

            <h5 class="mt-3">3.1 Precios y Disponibilidad</h5>
            <p>Los precios de los productos están expresados en la moneda local y pueden cambiar sin previo
                aviso. Nos esforzamos por mantener la información actualizada, pero no garantizamos la
                disponibilidad constante de todos los productos.
            </p>

            <h5>3.2 Procesos de Compra</h5>
            <p>Al realizar una compra, usted acepta proporcionar información precisa y completa. Nos reservamos
                el derecho de rechazar o cancelar pedidos por cualquier motivo, incluyendo disponibilidad
                limitada, errores de precio o sospechas de fraude.</p>

            <h5>3.3 Mètodos de Pago</h5>
            <p>Aceptamos diversos métodos de pago, incluyendo Mercado Pago, tarjetas de crédito/débito y
                transferencias bancarias. Todos los pagos se procesan de forma segura. Para más detalles,
                consulte nuestra página de
                <a href="/comercializacion" class="text-success">
                    comercializacion
                </a>
            </p>
        </div>
        <div class="card shadow mb-4 p-4">
            <h2>4. Envios y Entrega</h2>

            <h5 class="mt-3">4.1 Tiempo de Entrega</h5>
            <p>Los tiempos de entrega estimados son de 2-5 días hábiles para envíos estándar. Estos plazos son
                aproximados y pueden variar según la ubicación y disponibilidad del producto.</p>

            <h5>4.2 Costos de Envio</h5>
            <p>Ofrecemos envío gratuito en compras superiores a $100. Para compras menores, se aplicará un cargo
                de $10. El envío express tiene un costo adicional de $25.</p>

            <h5>4.3 Responsabilidad</h5>
            <p>Una vez que el producto es entregado al transportista, no somos responsables por pérdidas, daños
                o retrasos causados por el servicio de mensajería.</p>
        </div>

        <div class="card shadow mb-4 p-4">
            <h2>5. Devoluciones y Rembolsos</h2>

            <h5 class="mt-3">5.1 Politica de Devolucion</h5>
            <p>Aceptamos devoluciones dentro de los 30 días posteriores a la compra, siempre que el producto
                esté sin usar y en su empaque original.
            </p>

            <h5>5.2 Producto no Retomables</h5>
            <p>Por razones sanitarias, no aceptamos devoluciones de alimentos para mascotas una vez abiertos,
                productos de higiene usados o medicamentos.
            </p>

            <h5>5.3 Reembolsos</h5>
            <p>Los reembolsos se procesarán dentro de 7-10 días hábiles después de recibir y verificar el
                producto devuelto. El reembolso se realizará por el mismo método de pago utilizado en la compra
                original.
            </p>
        </div>
        <div class="card shadow mb-4 p-4">
            <div class="d-flex align-items-center gap-3 mb-3">
                <i class="bi bi-shield-check text-success fs-4"></i>
                <h2 class="mb-0">6. Privacidad de Datos</h2>
            </div>
            <h5 class="mt-3">6.1 Protección de Datos</h5>
            <p>Nos comprometemos a proteger su información personal de acuerdo con las leyes de privacidad
                vigentes. Recopilamos solo la información necesaria para brindar nuestros servicios.
            </p>

            <h5>6.2 Uso de la Información</h5>
            <p>La información que recopilamos se utiliza únicamente para:</p>
            <ul>
                <li>Procesar pedidos y brindar servicios veterinarios</li>
                <li>Procesar pedidos y brindar servicios veterinarios</li>
                <li>Mejorar nuestros servicios y experiencia del usuario</li>
                <li>Enviar información promocional (solo con su consentimiento)</li>
            </ul>

            <h5>6.3 No Compartimos sus Datos</h5>
            <p>No vendemos, alquilamos ni compartimos su información personal con terceros, excepto cuando sea
                necesario para procesar pagos o envíos, o cuando la ley lo requiera.</p>
        </div>
        <div class="card shadow mb-4 p-4">
            <h2>7. Propiedad Intelectual</h2>
            <p>Todo el contenido del sitio web, incluyendo textos, imágenes, logotipos, gráficos y código, es
                propiedad de Huellas Felices o sus proveedores de contenido y está protegido por las leyes de
                propiedad intelectual.</p>
            <p>No está permitido reproducir, distribuir o modificar el contenido sin autorización previa por
                escrito.</p>
        </div>
        <div class="card shadow mb-4 p-4">
            <h2>8. Limitación de Responsabilidad</h2>
            <p>Huellas Felices no será responsable por daños indirectos, incidentales, especiales o consecuentes
                que surjan del uso o la imposibilidad de usar nuestros servicios o sitio web</p>

            <p>Nuestros servicios veterinarios se brindan con el máximo cuidado profesional, pero no podemos
                garantizar resultados específicos en tratamientos médicos.</p>
        </div>

        <div class="card shadow mb-4 p-4">
            <h2>9. Modificaciones de los Términos</h2>
            <p>Nos reservamos el derecho de modificar estos términos y condiciones en cualquier momento. Las
                modificaciones entrarán en vigencia inmediatamente después de su publicación en el sitio web.
            </p>
            <p>Es responsabilidad del usuario revisar periódicamente estos términos. El uso continuado del sitio
                después de las modificaciones constituye aceptación de los nuevos términos.</p>
        </div>

        <div class="card shadow mb-4 p-4">
            <h2>10. Contacto</h2>
            <p>Si tiene preguntas o inquietudes sobre estos términos y condiciones, por favor contáctenos:</p>
            <div class="bg-contacto p-4 rounded">
                <ul class="mb-0">
                    <li><strong>Email:</strong> info@huellasfelices.com</li>
                    <li><strong>Telefono:</strong> +54 3791323421</li>
                    <li><strong>Direccion:</strong> Juan Bautista Cabral 2139, W3402BKG Corrientes.</li>
                    <li><strong>Horario:</strong> Lunes a Sábado de 09:00 a 18:00</li>
                </ul>
            </div>
        </div>
    </div>


@endsection