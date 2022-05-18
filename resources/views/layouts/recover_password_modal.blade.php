<!-- Recover Password Modal -->
<div class="modal fade" id="recover_password" tabindex="-1" role="dialog" aria-labelledby="password-recover" aria-hidden="true">
    <div class="container modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="password-recover">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true">
                <img src="{{asset('/assets/landing_page/icons/Close.svg', config()->get('app.https'))}}?v=2.4" alt="" class="w-100">
            </span>
            <div class="modal-body">
                <h4 class="modal-header-title">PortuguêsàVista</h4>
                <h1 class="modal-header-title">{{ isset($pt_lang) && $pt_lang ? 'Recuperar Palavra-Passe!' : 'Recover Password!' }}</h1>
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
                            <button id="submit_recover_password_form" type="button" class="btn btn-theme btn-lg">
                                {{ isset($pt_lang) && $pt_lang ? 'Recuperar' : 'Recover' }} &nbsp; <img src="{{asset('/assets/landing_page/icons/Arrow-pink.svg', config()->get('app.https'))}}?v=2.4" alt="">
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
