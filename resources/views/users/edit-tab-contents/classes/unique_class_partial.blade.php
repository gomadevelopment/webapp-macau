<div class="shop_grid_caption card-body m-0 mb-4 pt-2 pb-2">
                
    <div class="form-group d-flex flex-wrap justify-content-center m-0">
        <img src="{{asset('/assets/backoffice_assets/icons/Classes.svg', config()->get('app.https'))}}?v=2.3" class="ml-2 mr-2" alt="" style="margin-bottom: 4px;">
        <h4 class="sg_rate_title align-self-center text-center m-0" style="font-size: 21px;">
            Turma {{ $class->name }} @if(auth()->user()->university) > {{ auth()->user()->university->name }} @endif
        </h4>
        <br>
        <a  href="#collapse_class_{{ $class->id }}" class="ml-auto b-0 align-self-center classes_accordion expand_accordion collapsed"  data-toggle="collapse" data-parent="#accordion">
            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_black.svg', config()->get('app.https'))}}?v=2.3" class="expand_chevron" alt="">
            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_up_pink.svg', config()->get('app.https'))}}?v=2.3" class="collapse_chevron" alt="" style="display: none;">
        </a>
    </div>

</div>

<div class="shop_grid_caption card-body classroom m-0 mb-4 pt-0 pb-0">

    <div id="collapse_class_{{ $class->id }}" class="collapse" data-parent="#accordion">

        <div class="exercise_time wrap mt-3 mb-4 text-left">
            <a href="#" data-toggle="modal" data-target="#new_insert_student_modal" class="btn search-btn float-none comment_submit insert_student_button_on_class_body m-2" style="padding: 12px 20px;" data-class-id="{{ $class->id }}">
                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg', config()->get('app.https'))}}?v=2.3" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                Inserir Aluno
            </a>

            <a href="#" class="btn btn-theme float-none remove_button m-2" style="padding: 13px 20px;">
                <img src="{{asset('/assets/backoffice_assets/icons/performance_icon_pink.svg', config()->get('app.https'))}}?v=2.3" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                Ver Desempenho
            </a>
        </div>

        @if (!$class->students->count())
            <div class="form-group d-flex flex-wrap mb-4">
                <h4 class="colleagues_name m-0">Esta turma ainda não tem nenhum aluno.</h4>
            </div>
        @else
            @foreach ($class->students as $student)
                <div class="form-group d-flex flex-wrap mb-4">
                    <img src="{{ $student->avatar_url ? '/webapp-macau-storage/avatars/'.$student->id.'/'.$student->avatar_url : 'https://via.placeholder.com/500x500'}}" 
                    alt="" class="colleagues_round_avatar mr-3">
                    <h4 class="colleagues_name m-0">{{ $student->username }}</h4>
                    <div class="dropdown ml-auto align-self-center classes_student_dropdown student_dropdown">
                        <a href="#" class="messages" data-toggle="dropdown" aria-expanded="false">
                            <span class="ping"></span>
                            <img src="{{asset('/assets/backoffice_assets/icons/Dots.svg', config()->get('app.https'))}}?v=2.3" class="empty_dots d-block" alt="">
                            <img src="{{asset('/assets/backoffice_assets/icons/dots_filled.svg', config()->get('app.https'))}}?v=2.3" class="filled_dots" alt="" style="display: none;">
                            <span class="dropdown-menu-arrow"></span>
                        </a>
                        <div class="dropdown-menu message-box">
                            <a class="msg-title" href="/perfil/{{ $student->id }}">
                                <img src="{{asset('/assets/backoffice_assets/icons/USer.svg', config()->get('app.https'))}}?v=2.3" class="logo logout_icon ml-1 mr-1 mb-1" alt="" />
                                Ver Perfil do Aluno
                            </a>
                            <hr class="mt-0 mb-2 ml-2 mr-2">
                            <a class="msg-title" href="/chat/{{ $student->id }}">
                                <img src="{{asset('/assets/backoffice_assets/icons/Chat_black.svg', config()->get('app.https'))}}?v=2.3" class="logo logout_icon mr-1" alt="" />
                                Iniciar Conversa
                            </a>
                            <hr class="mt-0 mb-2 ml-2 mr-2">
                            <a class="msg-title remove_student_button" href="#" data-student-id="{{ $student->id }}" data-class-id="{{ $class->id }}">
                                <img src="{{asset('/assets/backoffice_assets/icons/Cross_black.svg', config()->get('app.https'))}}?v=2.3" class="logo logout_icon ml-1 mr-2" alt="" />
                                Remover Aluno da Turma
                            </a>
                        </div>
                    </div>
                </div>

                @if(!$loop->last)
                    <hr>
                @endif
            @endforeach
        @endif
            
    </div>

</div>
