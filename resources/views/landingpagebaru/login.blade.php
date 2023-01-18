@extends('landingpagebaru.layouts.app')

@section('content')
    <section id="contact" class="s-contact">

        <div class="overlay"></div>
        <div class="contact__line"></div>

        <div class="row section-header" data-aos="fade-up">
            <div class="col-full">
                <h3 class="subhead">Login</h3>
                {{-- <h1 class="display-2 display-2--light">Loginn</h1> --}}
            </div>
        </div>

        <div class="row contact-content" data-aos="fade-up">

            <div class="contact-primary">

                <h3 class="h6">Login to your account</h3>

                <form method="POST" action="{{ route('login') }}" novalidate="novalidate">
                    <fieldset>
                        @csrf

                        <div class="form-field">
                            <input type="email" id="email" name="email" placeholder="Your Email Address" value=""
                                aria-required="true" class="full-width">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-field">
                            <input name="password" type="password" id="password" placeholder="Your Password" value=""
                                aria-required="true" class="full-width">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-field">
                            <button class="full-width btn--primary" type="submit"> {{ __('Login') }}</button>
                            <div class="submit-loader">
                                <div class="text-loader">Loging...</div>
                            </div>
                        </div>

                    </fieldset>
                </form>

            </div> <!-- end contact-primary -->

            <div class="contact-secondary">
                <div class="contact-info">

                    <h3 class="h6 hide-on-fullwidth">Login</h3>

                    <div class="cinfo">
                        <h5>Admin Account</h5>
                        <p>
                            Can Create items, categories and users.
                        </p>
                        
                        <h5>Operator Account</h5>
                        <p>
                            Can add loan data and can see all items.
                         </p>
                    </div>

                </div> <!-- end contact-info -->
            </div> <!-- end contact-secondary -->

        </div> <!-- end contact-content -->

    </section> <!-- end s-contact -->
@endsection
