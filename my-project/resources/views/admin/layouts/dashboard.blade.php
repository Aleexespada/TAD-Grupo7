<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', ' | Admin - Mr Penguin')</title>

    <script defer src="https://kit.fontawesome.com/d0c6ffa552.js" crossorigin="anonymous"></script>

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
        </div>
    </div>
</body>

</html>