<!-- Log In Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
    <div class="container modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="registermodal">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
                <h4 class="modal-header-title">PortuguêsàVista</h4>
                <h1 class="modal-header-title">Vamos entrar!</h1>
                <div class="login-form">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="post" action="/login">
                    
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="Nome de Utilizador" autocomplete="off" value="{{ old('username') }}"
                            style="background: url({{asset('/assets/landing_page/icons/User.svg')}}) no-repeat scroll 7px 12px;">
                            @if ($errors->has('username'))
                                <span class="error-block-span">
                                    {{ $errors->first('username') }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <input name="password" type="password" class="form-control" placeholder="Palavra-Passe" autocomplete="off"
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
                            <button type="submit" class="btn btn-theme btn-lg" data-target="#login">
                                Prosseguir &nbsp; <object class="" data="{{asset('/assets/landing_page/icons/Arrow-pink.svg')}}" type="image/svg+xml"></object>
                            </button>
                        </div>
                        
                        @csrf
                    </form>
                </div>
                
            </div>
            <img class="scene3_svg" src="{{asset('/assets/landing_page/illustrations/Scene3.svg')}}" alt="">
        </div>
    </div>
</div>
<!-- End Modal -->