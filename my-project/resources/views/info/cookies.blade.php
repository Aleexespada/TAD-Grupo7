@extends('layouts.app')

@section('title', 'Cookies - Mr Penguin')

@vite(['resources/css/info.scss'])

@section('content')
<div class="info-container container">
    <div class="row pt-5">
        <div class="col-lg-6">
            <h1 class="fw-bold text-black text-uppercase mb-5">Cookies</h1>
            <h5>
                ¿Qué son las cookies?
            </h5>
            <p>
                Como es práctica común en casi todos los sitios web profesionales,
                este sitio utiliza cookies, que son pequeños archivos que se
                descargan en su computadora, para mejorar su experiencia. Esta
                página describe qué información recopilan, cómo la usamos y por
                qué a veces necesitamos almacenar estas cookies. También compartiremos
                cómo puede evitar que se almacenen estas cookies; sin embargo, esto
                puede degradar o "romper" ciertos elementos de la funcionalidad de
                los sitios.
            </p>

            <h5>
                Cómo usamos las cookies
            </h5>
            <p>
                Usamos cookies por una variedad de razones que se detallan a
                continuación. Desafortunadamente, en la mayoría de los casos, no
                existen opciones estándar de la industria para deshabilitar las
                cookies sin deshabilitar por completo la funcionalidad y las
                características que agregan a este sitio. Se recomienda que deje
                activadas todas las cookies si no está seguro de si las necesita o
                no en caso de que se utilicen para proporcionar un servicio que utiliza.
            </p>

            <h5>
                Deshabilitar cookies
            </h5>
            <p>
                Puede evitar la configuración de cookies ajustando la configuración
                de su navegador (consulte la Ayuda de su navegador para saber cómo
                hacerlo). Tenga en cuenta que deshabilitar las cookies afectará la
                funcionalidad de este y muchos otros sitios web que visite. La
                desactivación de las cookies generalmente resultará en la
                desactivación también de ciertas funciones y características de
                este sitio. Por lo tanto, se recomienda que no deshabilite las
                cookies. Esta Política de Cookies fue creada con la ayuda del
                Generador de Políticas de Cookies de CookiePolicyGenerator.com.
            </p>

            <h4>
                Las cookies que configuramos
            </h4>

            <h5>
                Cookies relacionadas con la cuenta
            </h5>
            <p>
                Si crea una cuenta con nosotros, utilizaremos cookies para la
                gestión del proceso de registro y la administración general.
                Estas cookies generalmente se eliminarán cuando cierre la sesión;
                sin embargo, en algunos casos, pueden permanecer después para recordar
                las preferencias de su sitio cuando cierre la sesión.
            </p>

            <h5>
                Cookies relacionadas con el procesamiento de pedidos
            </h5>
            <p>
                Este sitio ofrece comercio electrónico o facilidades de pago y
                algunas cookies son esenciales para garantizar que su pedido sea
                recordado entre páginas para que podamos procesarlo correctamente.
            </p>

            <h5>
                Cookies relacionadas con encuestas
            </h5>
            <p>
                De vez en cuando, ofrecemos encuestas y cuestionarios a los usuarios
                para brindarle información interesante, herramientas útiles o para
                comprender nuestra base de usuarios con mayor precisión. Estas
                encuestas pueden usar cookies para recordar quién ya participó en
                una encuesta o para brindarle resultados precisos después de cambiar
                de página.
            </p>

            <h5>
                Cookies de preferencias del sitio
            </h5>
            <p>
                Con el fin de brindarle una gran experiencia en este sitio,
                proporcionamos la funcionalidad para configurar sus preferencias
                sobre cómo se ejecuta este sitio cuando lo usa. Para recordar sus
                preferencias, necesitamos configurar cookies para que esta
                información pueda ser llamada cada vez que interactúa con una
                página que se ve afectada por sus preferencias.
            </p>

            <h5>
                Cookies de terceros
            </h5>
            <p>
                En algunos casos especiales, también utilizamos cookies proporcionadas
                por terceros de confianza. La siguiente sección detalla qué cookies
                de terceros puede encontrar a través de este sitio.
            </p>
            <p>
                Este sitio utiliza Google Analytics, que es una de las soluciones de
                análisis más extendidas y confiables en la web para ayudarnos a
                comprender cómo usa el sitio y las formas en que podemos mejorar su
                experiencia. Estas cookies pueden rastrear cosas como cuánto tiempo
                pasa en el sitio y las páginas que visita para que podamos continuar
                produciendo contenido atractivo.
            </p>
            <p>
                Para obtener más información sobre las cookies de Google Analytics,
                consulte la página oficial de Google Analytics.
            </p>
            <p>
                De vez en cuando probamos nuevas funciones y hacemos cambios sutiles
                en la forma en que se entrega el sitio. Cuando todavía estamos
                probando nuevas funciones, estas cookies pueden usarse para garantizar
                que reciba una experiencia consistente mientras está en el sitio y,
                al mismo tiempo, asegurarnos de que entendemos qué optimizaciones
                aprecian más nuestros usuarios.
            </p>
            <p>
                El servicio de Google AdSense que utilizamos para publicar publicidad
                utiliza una cookie de DoubleClick para publicar anuncios más
                relevantes en la web y limitar la cantidad de veces que se le
                muestra un anuncio determinado.
            </p>
            <p>
                Para obtener más información sobre Google AdSense, consulte las
                preguntas frecuentes oficiales sobre privacidad de Google AdSense.
            </p>
            <p>
                También utilizamos botones y/o complementos de redes sociales en
                este sitio que le permiten conectarse con su red social de varias
                maneras. Para que estos funcionen, los siguientes sitios de redes
                sociales establecerán cookies a través de nuestro sitio que pueden
                usarse para mejorar su perfil en su sitio o contribuir a los datos
                que tienen para varios propósitos descritos en sus respectivas
                políticas de privacidad.
            </p>
        </div>
        <div class="col-lg-6 px-5 h-auto">
            <img class="w-100" src="{{ asset('img/cookies.jpg') }}" alt="Logo MrPenguin" style="object-fit: contain; height: 400px;">
        </div>
    </div>
</div>
@endsection