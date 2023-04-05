<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite(['resources/js/app.js', 'resources/css/app.scss'])
</head>

<body>
    <!-- HEADER -->
    @include('partials.header')

    <!-- CONTENIDO PRINCIPAL -->
    <main class="container-fluid">
        @yield('content')
    </main>

    <!-- FOOTER -->
    @include('partials.footer')
</body>

</html>