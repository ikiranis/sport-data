<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="{{ route('home') }}"><span class="mdi mdi-home-outline"></span>WMSports</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav my-auto ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('about') }}">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contact') }}">Επικοινωνία</a>
            </li>
            <li class="nav-item my-auto text-center">
                <a href="{{ secure_url('/feed') }}">
                    <img src="/images/site/RSS.png" width="25" title="RSS News Feed">
                </a>
            </li>

        </ul>
    </div>

</nav>