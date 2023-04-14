<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', ' | Admin - Mr Penguin')</title>

    <script defer src="https://kit.fontawesome.com/d0c6ffa552.js" crossorigin="anonymous"></script>

    <script defer src="{{ asset('js/scrollToTop.js') }}"></script>

    @vite(['resources/js/app.js', 'resources/css/app.scss', 'resources/css/admin.scss'])
</head>

<body>
    <div class="container-fluid row p-0 m-0">
        <div class="col-2 p-0">
            <!-- SIDEBAR -->
            @include('admin.partials.sidebar')
        </div>
        <div class="col-10 p-0">
            <!-- HEADER -->
            @include('admin.partials.header')

            <!-- CONTENIDO PRINCIPAL -->
            <main class="principal-container">
                @yield('content')
            </main>

            <!-- FOOTER -->
            @include('admin.partials.footer')

            <!-- BOTÓN SCROLL TO TOP -->
            <button onclick="scrollToTop()" id="goUpButton" class="btn position-fixed" title="Ir arriba">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" alt="Flecha hacia arriba">
                    <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                </svg>
            </button>
        </div>
    </div>
</body>

</html>