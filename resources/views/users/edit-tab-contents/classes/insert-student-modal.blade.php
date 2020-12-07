<!-- Insert Student in Class Modal -->

    <div class="container modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content container pr-4 pl-4" id="insert_student_modal">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true">
                <img src="{{asset('/assets/landing_page/icons/Close.svg')}}" alt="" class="w-100">
            </span>
            <div class="modal-body page-title">
                <h4 class="modal-header-title title mb-3">Adicionar à turma</h4>
                <h1 class="modal-header-title title m-0" style="font-size: 28px;">Alunos:</h1>
                <div class="login-form">
                    @if (session('login_error'))
                        <div class="alert alert-danger">
                            {{ session('login_error') }}
                        </div>
                    @endif
                    <form id="form_new_messages_to" action="">
                        @csrf
                        <div class="form-group">
                            <div class="select2_with_search" style="border-radius: 5px; border: 2px solid #e6ebf1;">
                                <select name="select_students_to_class_ids[]" id="select_students_to_class" class="form-control" multiple style="border: none;">
                                    @foreach ($students_without_class as $user)                                             
                                        <option value="{{ $user->id }}" data-image="{{ $user->avatar_url ? '/webapp-macau-storage/avatars/'.$user->id.'/'.$user->avatar_url : 'https://via.placeholder.com/500x500'}}">
                                            {{ $user->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="error-block-span pink select_students_to_class_error" hidden>
                            </span>
                        </div>
                        
                        <div class="form-group d-flex justify-content-center mb-4 mt-5">
                            <a href="#" class="btn search-btn comment_submit insert_student_button" data-target="#new_insert_student_modal">
                                Adicionar
                            </a>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
<!-- End Modal -->