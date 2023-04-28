@extends('layouts.app')

@section('title', 'Sobre nosotros - Mr Penguin')

@vite(['resources/css/info.scss'])

@section('content')
<div class="info-container container">
    <div class="row pt-5">
        <div class="col-md-6">
            <h1 class="fw-bold text-black text-uppercase mb-5">Sobre nosotros</h1>
            <p>
                Bienvenidos a Mr Penguin, el lugar donde encontrarás la ropa elegante y sofisticada que estás buscando. Somos una tienda en línea de moda masculina que ofrece una amplia variedad de productos de alta calidad, desde trajes y camisas hasta relojes y zapatos. Nos apasiona ayudar a nuestros clientes a sentirse seguros y elegantes en cualquier ocasión.
            </p>
            <p>
                En Mr Penguin, sabemos que la moda es una forma de expresión y un reflejo de la personalidad de cada persona. Por eso, trabajamos arduamente para ofrecer una amplia variedad de estilos y diseños que se adapten a las necesidades y gustos de nuestros clientes. Además, trabajamos con las marcas más reconocidas y de mayor calidad en la industria para garantizar que nuestros productos sean duraderos y estén a la moda.
            </p>
            <p>
                Nuestra misión es ofrecer una experiencia de compra en línea fácil y satisfactoria para nuestros clientes. Nos esforzamos por proporcionar un servicio al cliente excepcional y ayudar a nuestros clientes a encontrar lo que buscan. Desde asesoramiento sobre tallas y estilos hasta ayuda con los pedidos, nuestro equipo de atención al cliente está siempre a disposición de nuestros clientes.
            </p>
            <p>
                En Mr Penguin, creemos que la moda no es solo para las ocasiones especiales, sino que también debe ser parte de la vida cotidiana. Ya sea para el trabajo, una cita o una cena elegante, tenemos lo que necesitas para lucir sofisticado y elegante en todo momento. Nos apasiona lo que hacemos y estamos comprometidos en ofrecer la mejor selección de productos de moda masculina en línea. ¡Gracias por visitar nuestra tienda en línea y esperamos poder ayudarte a encontrar el estilo perfecto!
            </p>
        </div>
        <div class="col-md-6 px-5 h-auto">
            <img class="w-100" src="{{ asset('img/logo.png') }}" alt="Logo MrPenguin" style="object-fit: contain; height: 400px;">
        </div>
    </div>
</div>
@endsection