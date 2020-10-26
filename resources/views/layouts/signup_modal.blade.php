<!-- Sign Up Modal -->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="sign-up">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
                <h4 class="modal-header-title">Sign Up</h4>
                <div class="login-form">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="post" action="/signup">
                    
                        <div class="form-group">
                            <input name="fullname" type="text" class="form-control" placeholder="Full Name">
                        </div>
                        
                        <div class="form-group">
                            <input name="email" type="email" class="form-control" placeholder="Email">
                        </div>
                        
                        <div class="form-group">
                            <input name="password" type="password" class="form-control" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width pop-login">Sign Up</button>
                        </div>
                        @csrf
                    </form>
                </div>
                <div class="text-center">
                    <p class="mt-3"><i class="ti-user mr-1"></i>Already Have An Account? <a href="#" class="link">Go For LogIn</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->