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

    <nav class="navbar bg-secondary text-uppercase fixed-top">
        <div class="container">
            <a href="{{ url('/') }}" class="btn btn-light">⬅ {{ __('projekts.reports.back') }}</a>
        </div>
    </nav>

    <main class="container mt-5 pt-5">
        <h1>{{ __('projekts.reports.mainTitle') }}</h1>

        <form method="POST" action="" id="formReport">
            @csrf
            @include('components.reportForm', ['customers' => $customers])
            <input type="hidden" name="reportNumber" id="reportNumber" value="{{ $reportNumber }}">
        </form>
    </main>

    <footer class="copyright py-4 text-center text-white">
        <div class="container">
            <small>Copyright &copy; yurivanton.site 2025</small>
        </div>
    </footer>

    <!-- Скрипти -->
    <script src="{{ asset('js/myJs.js') }}"></script>
    <script src="{{ asset('js/report.js?=4') }}"></script>
</body>
</html>