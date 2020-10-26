<!-- Log In Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="registermodal">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
                <h4 class="modal-header-title">Log In</h4>
                <div class="login-form">
                    @if (session('login_error'))
                        <div class="alert alert-danger">
                            {{ session('login_error') }}
                        </div>
                    @endif
                    <form method="post" action="/login">
                    
                        <div class="form-group">
                            <label>E-mail</label>
                            <input name="email" type="text" class="form-control" placeholder="E-mail">
                        </div>
                        
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control" placeholder="*******">
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width pop-login">Login</button>
                        </div>
                        @csrf
                    </form>
                </div>
                
                <div class="social-login mb-3">
                    <ul>
                        <li>
                            <input id="reg" class="checkbox-custom" name="reg" type="checkbox">
                            <label for="reg" class="checkbox-custom-label">Save Password</label>
                        </li>
                        <li><a href="#" class="theme-cl">Forget Password?</a></li>
                    </ul>
                </div>
                
                <div class="text-center">
                    <p class="mt-2">Haven't Any Account? <a href="register.html" class="link">Click here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->