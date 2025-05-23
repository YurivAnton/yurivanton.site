<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-head.meta />
    <x-head.links />
    <title>Yuriv Anton</title>
</head>
<body id="page-top">

    <!-- Навігація -->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="/">{{ __('headNav.nameHead') }}</a>

            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded"
                type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                {{ __('headNav.menu') }}
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item mx-0 mx-lg-1">
                                <a href="{{ url('/dashboard') }}" class="nav-link py-3 px-0 px-lg-3 rounded">
                                {{ __('headNav.dashboard') }}
                                </a>
                            </li>
                            <li class="nav-item mx-0 mx-lg-1">
                                <a href="{{ url('/report') }}" class="nav-link py-3 px-0 px-lg-3 rounded">
                                {{ __('headNav.report') }}
                                </a>
                            </li>
                            <li class="nav-item mx-0 mx-lg-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="nav-link py-3 px-0 px-lg-3 rounded"
                                       onclick="event.preventDefault(); this.closest('form').submit();">
                                       {{ __('headNav.logOut') }}
                                    </a>
                                </form>
                            </li>
                        @else
                            <li class="nav-item mx-0 mx-lg-1">
                                <a id="fromPortfolio" class="nav-link py-3 px-0 px-lg-3 rounded">{{ __('headNav.portfolio') }}</a>
                            </li>
                            <li class="nav-item mx-0 mx-lg-1">
                                <a id="fromAbout" class="nav-link py-3 px-0 px-lg-3 rounded">{{ __('headNav.about') }}</a>
                            </li>
                            <li class="nav-item mx-0 mx-lg-1">
                                <a id="fromContact" class="nav-link py-3 px-0 px-lg-3 rounded">{{ __('headNav.contact') }}</a>
                            </li>
                            <li class="nav-item mx-0 mx-lg-1">
                                <a href="{{ route('login') }}" class="nav-link py-3 px-0 px-lg-3 rounded">{{ __('headNav.logIn') }}</a>
                            </li>
                        @endauth
                    @endif

                    <!-- Перемикач мов -->
                    @php
                        $languages = [
                            'ua' => ['label' => 'Українська', 'flag' => 'ua.svg'],
                            'en' => ['label' => 'English', 'flag' => 'gb.svg'],
                            'sk' => ['label' => 'Slovenský', 'flag' => 'sk.svg'],
                        ];
                        $current = Session::get('locale', 'en');
                    @endphp

                    <li class="nav-item mx-0 mx-lg-1 dropdown" id="containerLang">
                        <button class="dropbtn">
                            <img src="{{ asset('img/flags/' . $languages[$current]['flag']) }}" alt="{{ $languages[$current]['label'] }}" class="flag-icon">
                            {{ $languages[$current]['label'] }}
                        </button>
                        <div class="dropdown-content">
                            @foreach ($languages as $code => $info)
                                @if ($code !== $current)
                                    <a href="{{ url('change/' . $code) }}">
                                        <img src="{{ asset('img/flags/' . $info['flag']) }}" alt="{{ $info['label'] }}" class="flag-icon">
                                        {{ $info['label'] }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Контент сторінки -->
    <main>
        {{ $slot }}
    </main>

    <!-- Підвал -->
    <footer class="copyright py-4 text-center text-white">
        <div class="container">
            <small>Copyright &copy; yurivanton.site 2025</small>
        </div>
    </footer>

    <!-- Скрипти -->
    <script src="{{ asset('js/myJs.js') }}"></script>

</body>
</html>
