<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
    </script>


    <script src="https://kit.fontawesome.com/343294b271.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src={{ asset('js/app.js') }} defer></script>

</head>

<body>
    <main>
        <area id="background_color_1"></area>

        @include('partials.layout.header');

        <section id="content">

            @yield('content')
        </section>
    </main>
</body>

</html>
