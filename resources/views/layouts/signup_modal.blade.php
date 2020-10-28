<!-- Sign Up Modal -->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
    <div class="container modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="sign-up">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
                <h4 class="modal-header-title">PortuguêsàVista</h4>
                <h1 class="modal-header-title">Vamos inscrever-te!</h1>
                <div class="login-form">
                    @if (session('signup_error'))
                        <div class="alert alert-danger">
                            {{ session('signup_error') }}
                        </div>
                    @endif
                    <form method="post" action="/signup">
                        
                        <div class="form-group radio">
                            <input id="professor" class="checkbox-custom" name="professor_or_student" value="professor" type="radio">
							<label for="professor" class="checkbox-custom-label">Sou um Professor</label>
                        </div>
                        <div class="form-group radio">
                            <input id="student" class="checkbox-custom" name="professor_or_student" value="student" type="radio" checked>
							<label for="student" class="checkbox-custom-label">Sou um Aluno</label>
                        </div>
                    
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="Nome de Utilizador" required autocomplete="off" value="{{ old('username') }}"
                            style="background: url({{asset('/assets/landing_page/icons/User.svg')}}) no-repeat scroll 7px 16px;">
                            @if ($errors->has('username'))
                                <span class="error-block-span">
                                    {{ $errors->first('username') }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <input name="email" type="email" class="form-control" placeholder="E-mail" required autocomplete="off" value="{{ old('email') }}"
                            style="background: url({{asset('/assets/landing_page/icons/Mail.svg')}}) no-repeat scroll 7px 18px;">
                            @if ($errors->has('email'))
                                <span class="error-block-span">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <input id="password" name="password" type="password" class="form-control" placeholder="Palavra-Passe" autocomplete="off"
                            style="background: url({{asset('/assets/landing_page/icons/Lock.svg')}}) no-repeat scroll 7px 12px;">
                            <img class="eye-hide" src="{{asset('/assets/landing_page/icons/eye-off.svg')}}" alt="">
                            <img class="eye-show" src="{{asset('/assets/landing_page/icons/eye.svg')}}" alt="">
                            @if ($errors->has('password'))
                                <span class="error-block-span">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input name="password_confirmation" type="password" class="form-control" placeholder="Confirmar Palavra-Passe" autocomplete="off"
                            style="background: url({{asset('/assets/landing_page/icons/Lock.svg')}}) no-repeat scroll 7px 12px;">
                            <img class="eye-hide" src="{{asset('/assets/landing_page/icons/eye-off.svg')}}" alt="">
                            <img class="eye-show" src="{{asset('/assets/landing_page/icons/eye.svg')}}" alt="">
                            @if ($errors->has('password'))
                                <span class="error-block-span">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group signup_button about_section">
                            <button type="submit" class="btn btn-theme btn-lg" data-target="#signup">
                                Tudo Pronto!&nbsp; <object class="" data="{{asset('/assets/landing_page/icons/Arrow-pink.svg')}}" type="image/svg+xml"></object>
                            </button>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
            {{-- <div class="modal-svg"> --}}
                <img class="scene3_svg" src="{{asset('/assets/landing_page/illustrations/Scene3.svg')}}" alt="">
            {{-- </div> --}}
        </div>
    </div>
</div>
<!-- End Modal -->