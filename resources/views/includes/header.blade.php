<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="{{ route('home') }}"><span class="mdi mdi-home-outline"></span>WMSports</a>

    <ul class="navbar-nav my-auto ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('about') }}">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('contact') }}">Επικοινωνία</a>
        </li>
        <li class="nav-item my-auto">
            <a href="{{ secure_url('/feed') }}">
                <img src="/images/site/RSS.png" width="25" title="RSS News Feed">
            </a>
        </li>

    </ul>

</nav>