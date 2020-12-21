<!-- Recover Password Modal -->
<div class="modal fade" id="recover_password" tabindex="-1" role="dialog" aria-labelledby="password-recover" aria-hidden="true">
    <div class="container modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="password-recover">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true">
                <img src="{{asset('/assets/landing_page/icons/Close.svg')}}" alt="" class="w-100">
            </span>
            <div class="modal-body">
                <h4 class="modal-header-title">PortuguêsàVista</h4>
                <h1 class="modal-header-title">Recuperar Palavra-Passe!</h1>
                <div class="login-form">
                    @if (session('recover_password_error'))
                        <div class="alert alert-danger">
                            {{ session('recover_password_error') }}
                        </div>
                    @endif
                    <form method="GET" action="/recuperar_password">
                    
                        <div class="form-group">
                            <input name="email" type="email" class="form-control" placeholder="E-mail" required autocomplete="off" value="{{ old('email') }}"
                            style="background: url({{asset('/assets/landing_page/icons/Mail.svg')}}) no-repeat scroll 7px 22px;">
                            @if ($errors->has('email'))
                                <span class="error-block-span">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group signup_button about_section">
                            <button type="submit" class="btn btn-theme btn-lg">
                                Recuperar &nbsp; <img src="{{asset('/assets/landing_page/icons/Arrow-pink.svg')}}" alt="">
                            </button>
                        </div>
                        
                        @csrf
                    </form>
                </div>
                
            </div>
            <img class="scene3_svg" src="{{asset('/assets/landing_page/illustrations/SignIn&SignUp.svg')}}" alt="">
        </div>
    </div>
</div>
<!-- End Modal -->