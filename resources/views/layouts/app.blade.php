<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" itemscope itemtype="http://schema.org/Article">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('includes.favicon')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('siteTitle')</title>

    <!-- Styles -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    @include('feed::links')

    @include('includes.google-analytics')

    @yield('shareMetaTags')

</head>
<body>

<div id="app">
    @include('includes.header')
    <main class="py-4">
        @yield('content')
    </main>
</div>

{{--Footer--}}
@include('includes.footer')

<!-- Scripts -->
@include('includes.run-scripts')

@yield('scripts')
</body>
</html>
