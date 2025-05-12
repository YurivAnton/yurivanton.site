<x-layout>
    <div class="report">
        <div class="container-fluid mt-5">
            <!-- Сайдбари для мобільних: під головним меню -->
            <div class="d-lg-none d-flex justify-content-between bg-light px-2 py-3 border-top">
                <div class="w-50 pe-1">
                    <button class="btn btn-outline-secondary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#leftSidebarMobile">
                        Меню ліворуч
                    </button>
                    <div id="leftSidebarMobile" class="collapse mt-2">
                        @include('components.left-sidebar')
                    </div>
                </div>
                <div class="w-50 ps-1">
                    <button class="btn btn-outline-secondary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#rightSidebarMobile">
                        Меню праворуч
                    </button>
                    <div id="rightSidebarMobile" class="collapse mt-2">
                        @include('components.right-sidebar')
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Лівий сайдбар -->
                <aside class="col-lg-2 d-none d-lg-block bg-light p-3">
                    @include('components.left-sidebar')
                </aside>

                <!-- Основний контент -->
                <main class="col-12 col-lg-8 p-3">
                    <h1>Servisný záznam</h1> 
                    <form method="POST" action="" id="form">
                        @csrf
                        @include('components.reportForm', ['customers' => $customers])
                    </form>
                </main>

                <!-- Правий сайдбар -->
                <aside class="col-lg-2 d-none d-lg-block bg-light p-3">
                    @include('components.right-sidebar')
                </aside>
            </div>    
        </div>
    </div>
    <script src="{{ asset('js/report.js?=5') }}"></script>
</x-layout>
