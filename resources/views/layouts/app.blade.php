<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('siteTitle')</title>

    <!-- Styles -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    @include('includes.google-analytics')

</head>
<body>

<div id="app">
    @include('includes.header')
    <main class="py-4">
        @yield('content')
    </main>
</div>

<!-- Scripts -->
@include('includes.footer')

@yield('scripts')
</body>
</html>
