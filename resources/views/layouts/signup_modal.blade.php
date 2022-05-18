<!-- Sign Up Modal -->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
    <div class="container modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="sign-up">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true">
                <img src="{{asset('/assets/landing_page/icons/Close.svg', config()->get('app.https'))}}?v=2.4" alt="" class="w-100">
            </span>
            <div class="modal-body">
                <h4 class="modal-header-title">PortuguêsàVista</h4>
                <h1 class="modal-header-title">{{ isset($pt_lang) && $pt_lang ? 'Vamos Inscrever-te!' : 'Lets Sign You Up!' }}</h1>
                <div class="login-form">
                    @if (session('signup_error'))
                        <div class="alert alert-danger">
                            {{ session('signup_error') }}
                        </div>
                    @endif
                    <form method="post" action="/signup">
                        
                        <div class="form-group radio">
                            <input id="professor" class="checkbox-custom" name="professor_or_student" value="professor" type="radio">
							<label for="professor" class="checkbox-custom-label">
                                {{ isset($pt_lang) && $pt_lang ? 'Sou um Professor' : "I am a Teacher" }}
                            </label>
                        </div>
                        <div class="form-group radio">
                            <input id="student" class="checkbox-custom" name="professor_or_student" value="student" type="radio" checked>
							<label for="student" class="checkbox-custom-label">
                                {{ isset($pt_lang) && $pt_lang ? 'Sou um Aluno' : "I am a Student" }}
                            </label>
                        </div>
                    
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="{{ isset($pt_lang) && $pt_lang ? 'Nome de Utilizador' : 'Username' }}" required autocomplete="off" value="{{ old('username') }}"
                            style="background: url({{asset('/assets/landing_page/icons/User.svg')}}) no-repeat scroll 7px 18px;">
                            @if ($errors->has('username'))
                                <span class="error-block-span">
                                    {{ $errors->first('username') }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <input name="email" type="email" class="form-control" placeholder="E-mail" required autocomplete="off" value="{{ old('email') }}"
                            style="background: url({{asset('/assets/landing_page/icons/Mail.svg')}}) no-repeat scroll 7px 22px;">
                            @if ($errors->has('email'))
                                <span class="error-block-span">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <input id="password" name="password" type="password" class="form-control" placeholder="{{ isset($pt_lang) && $pt_lang ? 'Palavra-Passe' : 'Password' }}" autocomplete="off"
                            style="background: url({{asset('/assets/landing_page/icons/Lock.svg')}}) no-repeat scroll 7px 14px;">
                            <img class="eye-hide" src="{{asset('/assets/landing_page/icons/eye-off.svg', config()->get('app.https'))}}?v=2.4" alt="">
                            <img class="eye-show" src="{{asset('/assets/landing_page/icons/eye.svg', config()->get('app.https'))}}?v=2.4" alt="">
                            @if ($errors->has('password'))
                                <span class="error-block-span">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input name="password_confirmation" type="password" class="form-control" placeholder="{{ isset($pt_lang) && $pt_lang ? 'Confirmar Palavra-Passe' : 'Confirm Password' }}" autocomplete="off"
                            style="background: url({{asset('/assets/landing_page/icons/Lock.svg')}}) no-repeat scroll 7px 14px;">
                            <img class="eye-hide" src="{{asset('/assets/landing_page/icons/eye-off.svg', config()->get('app.https'))}}?v=2.4" alt="">
                            <img class="eye-show" src="{{asset('/assets/landing_page/icons/eye.svg', config()->get('app.https'))}}?v=2.4" alt="">
                            @if ($errors->has('password'))
                                <span class="error-block-span">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group signup_button about_section">
                            <button id="submit_signup_form" type="button" class="btn btn-theme btn-lg" data-target="#signup">
                                {{ isset($pt_lang) && $pt_lang ? 'Tudo Pronto!' : 'All Set!' }}&nbsp; <img src="{{asset('/assets/landing_page/icons/Arrow-pink.svg', config()->get('app.https'))}}?v=2.4" alt="">
                            </button>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
            <img class="scene3_svg" src="{{asset('/assets/landing_page/illustrations/SignIn&SignUp.svg', config()->get('app.https'))}}?v=2.4" alt="">
        </div>
    </div>
</div>
<!-- End Modal -->
