@extends('layouts.app')

@section('title', 'Envío - Mr Penguin')

@vite(['resources/css/info.scss'])

@section('content')
<div class="info-container container">
    <div class="row pt-5">
        <div class="col-lg-6">
            <h1 class="fw-bold text-black text-uppercase mb-5">Envío</h1>
            <p>
                En Mr Penguin, nos tomamos muy en serio la satisfacción de nuestros clientes, y parte de esa satisfacción viene de asegurarnos de que los productos lleguen a sus manos de manera oportuna y segura. Por eso, ofrecemos envío gratuito en todas las compras superiores a cierta cantidad, dependiendo del destino del paquete. Además, nuestros tiempos de envío son rápidos y confiables, y nos aseguramos de que los productos lleguen a su destino en perfectas condiciones.
            </p>
            <p>
                Para garantizar la entrega rápida y confiable de nuestros productos, trabajamos con las mejores empresas de envío en la industria. Los paquetes se envían generalmente en un plazo de 24 a 48 horas después de que se haya procesado el pedido, y en la mayoría de los casos, los clientes pueden esperar recibir sus productos dentro de los 3 a 5 días siguientes a la fecha de envío. Si necesita una entrega más rápida, también ofrecemos opciones de envío expreso por un cargo adicional.
            </p>
            <p>
                Además, ofrecemos un seguimiento en línea para que nuestros clientes puedan verificar el estado de sus paquetes en todo momento. Una vez que se envía el paquete, se proporcionará un número de seguimiento para que los clientes puedan rastrear el progreso del paquete y saber cuándo esperar la entrega. También nos aseguramos de que todos los productos estén debidamente embalados y protegidos para minimizar cualquier daño durante el envío.
            </p>
            <p>
                En Mr Penguin, queremos que nuestros clientes tengan una experiencia de compra en línea excepcional, y eso incluye asegurarnos de que sus productos lleguen a tiempo y en perfectas condiciones. Nos esforzamos por hacer que el proceso de envío sea lo más sencillo y sin problemas posible para nuestros clientes, y trabajamos arduamente para mantener altos estándares de calidad y servicio. Si tiene alguna pregunta o inquietud sobre el envío de su pedido, no dude en ponerse en contacto con nuestro equipo de atención al cliente.
            </p>
        </div>
        <div class="col-lg-6 px-5 h-auto">
            <img class="w-100" src="{{ asset('img/envio.jpg') }}" alt="Logo MrPenguin" style="object-fit: contain; height: 400px;">
        </div>
    </div>
</div>
@endsection