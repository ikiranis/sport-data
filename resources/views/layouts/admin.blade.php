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
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>


<body>


    {{--Menu--}}
    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel sticky-top flex-md-nowrap p-0 px-3">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <ul>
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a rel="alternate" hreflang="{{ $localeCode }}"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="mdi mdi-account-outline"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>


{{--Main Page--}}
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar py-5">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin') }}">
                            <span class="mdi mdi-home"></span>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <span class="mdi mdi-account-multiple-outline"></span>
                            Χρήστες
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}">
                            <span class="mdi mdi-note-text"></span>
                            Δημοσιεύματα
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('comments.index') }}">
                            <span class="mdi mdi-comment-multiple-outline"></span>
                            Σχόλια
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('athletes.index') }}">
                            <span class="mdi mdi-account-multiple-outline"></span>
                            Αθλητές
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('stadium.index') }}">
                            <span class="mdi mdi-stadium"></span>
                            Γήπεδα
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('teams.index') }}">
                            <span class="mdi mdi-soccer"></span>
                            Ομάδες
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('matches.index') }}">
                            <span class="mdi mdi-basketball"></span>
                            Αγώνες
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('standings.index') }}">
                            <span class="mdi mdi-format-list-numbers"></span>
                            Βαθμολογίες
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sports.index') }}">
                            <span class="mdi mdi-tennis"></span>
                            Αθλήματα
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('seasons.index') }}">
                            <span class="mdi mdi-timer-sand"></span>
                            Seasons
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('championships.index') }}">
                            <span class="mdi mdi-trophy-award"></span>
                            Πρωταθλήματα
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rules.index') }}">
                            <span class="mdi mdi-ruler"></span>
                            Κανόνες
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('matchdays.index') }}">
                            <span class="mdi mdi-calendar-multiple"></span>
                            Αγωνιστικές
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sitemap') }}">
                            <span class="mdi mdi-calendar-multiple"></span>
                            Sitemap
                        </a>
                    </li>
                </ul>

                {{--<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">--}}
                {{--<span>Saved reports</span>--}}
                {{--<a class="d-flex align-items-center text-muted" href="#">--}}
                {{--<span data-feather="plus-circle"></span>--}}
                {{--</a>--}}
                {{--</h6>--}}
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            @yield('content')
        </main>
    </div>
</div>



<!-- Scripts -->
    @include('includes.run-scripts')

@yield('scripts')

</body>
</html>
