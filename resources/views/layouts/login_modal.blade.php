<!-- Log In Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
    <div class="container modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="registermodal">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true">
                <img src="{{asset('/assets/landing_page/icons/Close.svg', config()->get('app.https'))}}?v=2.3" alt="" class="w-100">
            </span>
            <div class="modal-body">
                <h4 class="modal-header-title">PortuguêsàVista</h4>
                <h1 class="modal-header-title">{{ isset($pt_lang) && $pt_lang ? 'Vamos entrar!' : 'Let’s Sign In!' }}</h1>
                <div class="login-form">
                    @if (session('login_error'))
                        <div class="alert alert-danger">
                            {{ session('login_error') }}
                        </div>
                    @endif
                    <form method="post" action="/login">
                    
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="{{ isset($pt_lang) && $pt_lang ? 'Nome de Utilizador' : 'Username' }}" autocomplete="off" value="{{ old('username') }}"
                            style="background: url({{asset('/assets/landing_page/icons/User.svg')}}) no-repeat scroll 7px 18px;">
                            @if ($errors->has('username'))
                                <span class="error-block-span">
                                    {{ $errors->first('username') }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <input name="password" type="password" class="form-control" placeholder="{{ isset($pt_lang) && $pt_lang ? 'Palavra-Passe' : 'Password' }}" autocomplete="off"
                            style="background: url({{asset('/assets/landing_page/icons/Lock.svg')}}) no-repeat scroll 7px 14px;">
                            <img class="eye-hide" src="{{asset('/assets/landing_page/icons/eye-off.svg', config()->get('app.https'))}}?v=2.3" alt="">
                            <img class="eye-show" src="{{asset('/assets/landing_page/icons/eye.svg', config()->get('app.https'))}}?v=2.3" alt="">
                            @if ($errors->has('password'))
                                <span class="error-block-span">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group m-0">
                            <a href="#" class="recover_password_link" data-toggle="modal" data-target="#recover_password">
                                {{ isset($pt_lang) && $pt_lang ? 'Esqueceu-se da palavra-passe? Recupere aqui!' : 'Forgot your password? Recover it here!' }}
                            </a>
                        </div>
                        
                        <div class="form-group signup_button about_section">
                            <button id="submit_login_form" type="button" class="btn btn-theme btn-lg" data-target="#login">
                                {{ isset($pt_lang) && $pt_lang ? 'Prosseguir' : 'Proceed' }} &nbsp; <img src="{{asset('/assets/landing_page/icons/Arrow-pink.svg', config()->get('app.https'))}}?v=2.3" alt="">
                            </button>
                        </div>
                        
                        @csrf
                    </form>
                </div>
                
            </div>
            <img class="scene3_svg" src="{{asset('/assets/landing_page/illustrations/SignIn&SignUp.svg', config()->get('app.https'))}}?v=2.3" alt="">
        </div>
    </div>
</div>
<!-- End Modal -->
