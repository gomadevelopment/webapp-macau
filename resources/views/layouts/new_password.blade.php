@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/homepage.css', config()->get('app.https')) }}?v=1.2">

@stop

@section('content')

<!-- ============================ How it works Section ================================== -->
<section class="how_it_works_section pt-5 pb-5" id="como_funciona" style="top: 0;">
    <div class="container" id="new_password">
        <form method="post" action="/redefinir_password" class="login-form">
            @csrf
            <div class="row">

                <div class="col-xs-0 col-sm-0 col-md-2">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8" style="background-color: #ff2850; border-radius: 5px;">
                    <div class="hero-caption small_wd text-center">
                        <h1 class="big-header-capt cl_2 p-0 mt-4 mb-4" style="color: white !important; font-size: 36px !important;">
                            {{ isset($pt_lang) && $pt_lang ? 'Recuperar Palavra-Passe' : 'Recover Password' }}
                        </h1>
                    </div>
                    <input type="email" name="email" id="email" hidden value="{{ isset($email) && $email ? $email : '' }}">
                    <input type="text" name="token" id="token" hidden value="{{ isset($token) && $token ? $token : '' }}">
                    {{-- <div class="form-group">
                        <input name="email" type="email" class="form-control" placeholder="E-mail" required autocomplete="off" value="{{ old('email') }}"
                        style="background: url({{asset('/assets/landing_page/icons/Mail.svg')}}) no-repeat scroll 7px 22px;">
                        @if ($errors->has('email'))
                            <span class="error-block-span">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div> --}}
                    <div class="form-group">
                        <input id="password" name="password" type="password" class="form-control" placeholder="{{ isset($pt_lang) && $pt_lang ? 'Nova Palavra-Passe' : 'New Password' }}" autocomplete="off"
                        style="background: url({{asset('/assets/landing_page/icons/Lock.svg')}}) no-repeat scroll 7px 14px;">
                        <img class="eye-hide" src="{{asset('/assets/landing_page/icons/eye-off.svg')}}" alt="">
                        <img class="eye-show" src="{{asset('/assets/landing_page/icons/eye.svg')}}" alt="">
                        @if ($errors->has('password'))
                            <span class="error-block-span">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input name="password_confirmation" type="password" class="form-control" placeholder="{{ isset($pt_lang) && $pt_lang ? 'Confirmar Nova Palavra-Passe' : 'Confirm New Password' }}" autocomplete="off"
                        style="background: url({{asset('/assets/landing_page/icons/Lock.svg')}}) no-repeat scroll 7px 14px;">
                        <img class="eye-hide" src="{{asset('/assets/landing_page/icons/eye-off.svg')}}" alt="">
                        <img class="eye-show" src="{{asset('/assets/landing_page/icons/eye.svg')}}" alt="">
                        @if ($errors->has('password'))
                            <span class="error-block-span">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group signup_button about_section">
                        <button type="submit" class="btn btn-theme btn-lg">
                            {{ isset($pt_lang) && $pt_lang ? 'Confirmar' : 'Confirm' }}&nbsp; <img src="{{asset('/assets/landing_page/icons/Arrow-pink.svg')}}" alt="">
                        </button>
                    </div>
                </div>
                <div class="col-xs-0 col-sm-0 col-md-2">
                </div>
                
            </div>
        </form>
            
        
    </div>
</section>

@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https')) }}?v=1.2"></script>

    @if (session('login_error'))
        <script type="text/javascript">
            $(function() {
                $('#login').modal('show');
            });
        </script>
    @endif
    @if (session('signup_error'))
        <script type="text/javascript">
            $(function() {
                $('#signup').modal('show');
            });
        </script>
    @endif
    @if (session('recover_password_error'))
        <script type="text/javascript">
            $(function() {
                $('#recover_password').modal('show');
            });
        </script>
    @endif

@stop