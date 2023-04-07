<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <script defer src="https://kit.fontawesome.com/d0c6ffa552.js" crossorigin="anonymous"></script>

    @vite(['resources/js/app.js', 'resources/css/app.scss'])
</head>

<body>
    <!-- HEADER -->
    @include('partials.header')

    <!-- CONTENIDO PRINCIPAL -->
    <main class="principal-container container">
        @yield('content')
    </main>

    <!-- FOOTER -->
    @include('partials.footer')
</body>

</html>