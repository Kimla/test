<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="icon" type="image/png" href="/images/favicon.png" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Foodhills Portal</title>
        <meta name="description" content=""/>
        <meta property="og:title" content="Foodhills Portal" />
        <meta property="og:description" content="" />
        <meta property="og:image" content="/images/bild.jpg">
        <meta name="twitter:card" content="summary" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        @inertia
    </body>
</html>
