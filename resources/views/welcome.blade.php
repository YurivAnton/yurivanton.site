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
                <!-- Тут будуть твої портфоліо-проєкти -->
                <!-- Поки що закоментовані або можна буде вставити циклом -->
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
