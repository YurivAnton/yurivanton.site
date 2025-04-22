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
                        <li class="nav-item mx-0 mx-lg-1"><a id="fromPortfolio" class="nav-link py-3 px-0 px-lg-3 rounded">{{__('headNav.portfolio')}}</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a id="fromAbout" class="nav-link py-3 px-0 px-lg-3 rounded">{{__('headNav.about')}}</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a id="fromContact" class="nav-link py-3 px-0 px-lg-3 rounded">{{__('headNav.contact')}}</a></li>
                        @if (Route::has('login'))
                            @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                            >
                                Dashboard
                            </a>
                        @else
                            <li class="nav-item mx-0 mx-lg-1"><a href="{{ route('login') }}" class="nav-link py-3 px-0 px-lg-3 rounded">{{__('headNav.logIn')}}</a></li>
                            @if (Route::has('register'))
                                <li class="nav-item mx-0 mx-lg-1">
                                <a
                                    href="{{ route('register') }}"
                                    class="nav-link py-3 px-0 px-lg-3 rounded">
                                    {{__('headNav.register')}}
                                </a></li>
                            @endif
                            @endauth
                        @endif

                        <div id="containerLang">
                            <li class="nav-item mx-0 mx-lg-1">
                                @php($languages = ["ua" => "Україна", "en" => "English", "sk" => "Slovensko"])
                                <a id="dropdownLang" class="nav-link-lang py-3 px-0 px-lg-3 rounded">{{ $languages[Session::get('locale', "en")] }}</a>
                                <div class="dropdown-content">
                                    <a href="change/ua" class="py-3 px-0 px-lg-3 rounded">UA</a>
                                    <a href="change/en" class="py-3 px-0 px-lg-3 rounded">EN</a>
                                    <a href="change/sk" class="py-3 px-0 px-lg-3 rounded">SK</a>
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
