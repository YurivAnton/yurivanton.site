<x-layout>
    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <img class="masthead-avatar mb-5" src="{{ asset('img/ava.png') }}" alt="Avatar" />
            <h1 class="masthead-heading text-uppercase mb-0">{{ __('headNav.nameHead') }}</h1>
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
            </div>
            <p class="masthead-subheading font-weight-light mb-0">Web Developer</p>
        </div>
    </header>

    <!-- Portfolio Section -->
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">{{ __('headNav.portfolio') }}</h2>
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6 mb-5">
                    <div class="portfolio-item mx-auto">
                        <img class="img-fluid rounded shadow" src="{{ asset('img/portfolio/reports-preview.png') }}" alt="Reports Project">
                        <h4 class="mt-3">Reports Project</h4>
                        <p class="text-muted">{{ __('projekts.reports.mainDesc') }}</p>

                        <!-- Кнопки -->
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <button class="btn btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#reportsDetails" aria-expanded="false" aria-controls="reportsDetails">
                                {{ __('projekts.reports.learnMore') }}
                            </button>
                            <a href="{{ route('report.try') }}" class="btn btn-primary">
                                {{ __('projekts.reports.try') }}
                            </a>
                        </div>

                        <!-- Секція, що розкривається -->
                        <div class="collapse mt-3" id="reportsDetails">
                            <div class="card card-body text-start bg-light">
                                <div class="row">
                                    <!-- Скріншот 1 -->
                                    <div class="col-6 mb-3 text-center">
                                        <img src="{{ asset('img/portfolio/reports-screenshot1.png') }}"
                                            class="img-fluid rounded shadow-sm portfolio-screenshot"
                                            alt="{{ __('projekts.reports.screenAlt_1') }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#screenshotModal1">
                                        <p class="mt-2">{{ __('projekts.reports.screenText_1') }}</p>
                                    </div>

                                    <!-- Скріншот 2 -->
                                    <div class="col-6 mb-3 text-center">
                                        <img src="{{ asset('img/portfolio/reports-screenshot2.png') }}"
                                            class="img-fluid rounded shadow-sm portfolio-screenshot"
                                            alt="{{ __('projekts.reports.screenAlt_2') }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#screenshotModal2">
                                        <p class="mt-2">{{ __('projekts.reports.screenText_2') }}</p>
                                    </div>

                                    <!-- Скріншот 2 -->
                                    <div class="col-6 mb-3 text-center">
                                        <img src="{{ asset('img/portfolio/reports-screenshot3.png') }}"
                                            class="img-fluid rounded shadow-sm portfolio-screenshot"
                                            alt="{{ __('projekts.reports.screenAlt_3') }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#screenshotModal3">
                                        <p class="mt-2">{{ __('projekts.reports.screenText_3') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Модальне вікно для скріншота 1 -->
                        <div class="modal fade" id="screenshotModal1" tabindex="-1" aria-labelledby="screenshotModal1Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('img/portfolio/reports-screenshot1.png') }}" class="img-fluid mb-3" alt="{{ __('projekts.reports.screenAlt_1') }}">
                                        <p>{{ __('projekts.reports.screenDesc_1') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Модальне вікно для скріншота 2 -->
                        <div class="modal fade" id="screenshotModal2" tabindex="-1" aria-labelledby="screenshotModal2Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('img/portfolio/reports-screenshot2.png') }}" class="img-fluid mb-3" alt="{{ __('projekts.reports.screenAlt_2') }}">
                                        <p>{{ __('projekts.reports.screenDesc_2') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Модальне вікно для скріншота 2 -->
                        <div class="modal fade" id="screenshotModal3" tabindex="-1" aria-labelledby="screenshotModal3Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('img/portfolio/reports-screenshot3.png') }}" class="img-fluid mb-3" alt="{{ __('projekts.reports.screenAlt_3') }}">
                                        <p>{{ __('projekts.reports.screenDesc_3') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="page-section bg-primary text-white mb-0" id="about">
        <div class="container">
            <h2 class="page-section-heading text-center text-uppercase text-white">{{ __('headNav.about') }}</h2>
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-4 ms-auto">
                    <p class="lead">{{ __('about.me') }}</p>
                </div>
                <div class="col-12 col-lg-4 me-auto">
                    <p class="lead">{{ __('about.my_goals') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="page-section" id="contact">
        <div class="container">
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">{{ __('headNav.contactMe') }}</h2>
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 col-xl-7">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="contactForm" method="POST" action="/contact">
                        @csrf
                        <!-- Name -->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="{{ __('contactForm.fullName') }}" />
                            <label for="name">{{ __('contactForm.fullName') }}</label>
                        </div>

                        <!-- Email -->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="name@example.com" />
                            <label for="email">{{ __('contactForm.emailAddress') }}</label>
                        </div>

                        <!-- Phone -->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="phone" name="phone" type="tel" value="{{ old('phone') }}" placeholder="(123)" />
                            <label for="phone">{{ __('contactForm.phoneNumber') }}</label>
                        </div>

                        <!-- Message -->
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="message" name="mes" placeholder="{{ __('contactForm.message') }}" style="height: 10rem">{{ old('mes') }}</textarea>
                            <label for="message">{{ __('contactForm.message') }}</label>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button class="btn btn-primary btn-xl" id="submitButton" type="submit">{{ __('contactForm.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
