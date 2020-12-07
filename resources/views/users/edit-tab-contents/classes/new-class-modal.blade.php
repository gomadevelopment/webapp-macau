<!-- New Class Modal -->
<div class="modal fade" id="new_create_class_modal" tabindex="-1" role="dialog" aria-labelledby="create_class_modal" aria-hidden="true">
    <div class="container modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content container pr-4 pl-4" id="create_class_modal">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true">
                <img src="{{asset('/assets/landing_page/icons/Close.svg')}}" alt="" class="w-100">
            </span>
            <div class="modal-body page-title">
                <h4 class="modal-header-title title mb-3">Nova Turma</h4>
                <div class="login-form">
                    <form id="form_create_class" action="">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="class_name" id="class_name" placeholder="Nome da turma (Ex: 'A')">
                            <span class="error-block-span pink class_name_error" hidden>
                            </span>
                        </div>
                        
                        <div class="form-group d-flex justify-content-center mb-4 mt-5">
                            <a href="#" class="btn search-btn comment_submit create_new_class_button" data-target="#new_create_class_modal">
                                Criar
                            </a>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->