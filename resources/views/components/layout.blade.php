<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<x-head.meta />
		<x-head.links />
		<title>Yuriv Anton</title>
	</head>
	<body id="page-top">
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="/">{{__('headNav.nameHead')}}</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    {{__('headNav.menu')}}
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        @if (Route::has('login'))
                            @auth
                            <li class="nav-item mx-0 mx-lg-1">
                                <a href="{{ url('/dashboard') }}" class="nav-link py-3 px-0 px-lg-3 rounded">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item mx-0 mx-lg-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a id="fromContact" class="nav-link py-3 px-0 px-lg-3 rounded" href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </li>
                        @else
                            <li class="nav-item mx-0 mx-lg-1"><a id="fromPortfolio" class="nav-link py-3 px-0 px-lg-3 rounded">{{__('headNav.portfolio')}}</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a id="fromAbout" class="nav-link py-3 px-0 px-lg-3 rounded">{{__('headNav.about')}}</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a id="fromContact" class="nav-link py-3 px-0 px-lg-3 rounded">{{__('headNav.contact')}}</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a href="{{ route('login') }}" class="nav-link py-3 px-0 px-lg-3 rounded">{{__('headNav.logIn')}}</a></li>
                            <!-- @if (Route::has('register'))
                                <li class="nav-item mx-0 mx-lg-1">
                                <a
                                    href="{{ route('register') }}"
                                    class="nav-link py-3 px-0 px-lg-3 rounded">
                                    {{__('headNav.register')}}
                                </a></li>
                            @endif -->
                            @endauth
                        @endif
                        <div id="containerLang">
                            <li class="nav-item mx-0 mx-lg-1">
                                
                                @php
                                    $languages = [
                                        'ua' => ['label' => 'Українська', 'flag' => 'ua.svg'],
                                        'en' => ['label' => 'English', 'flag' => 'gb.svg'],
                                        'sk' => ['label' => 'Slovenský', 'flag' => 'sk.svg'],
                                    ];
                                    $current = Session::get('locale', 'en');
                                @endphp
                                
                                <a id="dropdownLang" class="nav-link-lang py-3 px-0 px-lg-3 rounded"><img src="{{ asset('img/flags/' . $languages[$current]['flag']) }}" alt="{{ $languages[$current]['label'] }}" class="flag-icon">
                                    {{ $languages[$current]['label'] }}
                                </a>
                                <div class="dropdown-content">
                                @foreach ($languages as $code => $info)
                                    @if ($code !== $current)
                                        <a href="{{ url('change/' . $code) }}" class="py-3 px-0 px-lg-3 rounded">
                                            <img src="{{ asset('img/flags/' . $info['flag']) }}" alt="{{ $info['label'] }}" class="flag-icon">
                                            {{ $info['label'] }}
                                        </a>
                                    @endif
                                @endforeach
                                    <!-- <a href="change/ua" class="py-3 px-0 px-lg-3 rounded">UA</a>
                                    <a href="change/en" class="py-3 px-0 px-lg-3 rounded">EN</a>
                                    <a href="change/sk" class="py-3 px-0 px-lg-3 rounded">SK</a> -->
                                </div>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
        
        {{ $slot }}

        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; yurivanton.site 2025</small></div>
        </div>
	</body>
    <script src="{{ asset('js/myJs.js'); }}"></script>
</html>
