<div class="shop_grid_caption card-body m-0 mb-4 pt-2 pb-2">
                
    <div class="form-group d-flex flex-wrap justify-content-center m-0">
        <h4 class="sg_rate_title align-self-center m-0" style="font-size: 21px;">
            <img src="{{asset('/assets/backoffice_assets/icons/Classes.svg')}}" class="mr-2" alt="">
            Turma {{ $class->name }} @if(auth()->user()->university) > {{ auth()->user()->university->name }} @endif
        </h4>
        <br>
        <a  href="#collapse_class_{{ $class->id }}" class="ml-auto b-0 align-self-center expand_accordion collapsed"  data-toggle="collapse" data-parent="#accordion">
            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_black.svg')}}" class="expand_chevron" alt="">
            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_up_pink.svg')}}" class="collapse_chevron" alt="" style="display: none;">
        </a>
    </div>

</div>

<div class="shop_grid_caption card-body classroom m-0 mb-4 pt-0 pb-0">

    <div id="collapse_class_{{ $class->id }}" class="collapse" data-parent="#accordion">

        <div class="exercise_time wrap mt-4 mb-5 text-left">
            <a href="#" data-toggle="modal" data-target="#new_insert_student_modal" class="btn search-btn comment_submit insert_student_button_on_class_body" style="float: none; padding: 12px 20px;" data-class-id="{{ $class->id }}">
                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                Inserir Aluno
            </a>

            <a href="#" class="btn btn-theme remove_button ml-3" style="float: none; padding: 13px 20px;">
                <img src="{{asset('/assets/backoffice_assets/icons/performance_icon_pink.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
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
                            <img src="{{asset('/assets/backoffice_assets/icons/Dots.svg')}}" class="empty_dots d-block" alt="">
                            <img src="{{asset('/assets/backoffice_assets/icons/dots_filled.svg')}}" class="filled_dots" alt="" style="display: none;">
                            <span class="dropdown-menu-arrow"></span>
                        </a>
                        <div class="dropdown-menu message-box">
                            <a class="msg-title" href="/perfil/{{ $student->id }}">
                                <img src="{{asset('/assets/backoffice_assets/icons/USer.svg')}}" class="logo logout_icon ml-1 mr-1 mb-1" alt="" />
                                Ver Perfil do Aluno
                            </a>
                            <hr class="mt-0 mb-2 ml-2 mr-2">
                            <a class="msg-title" href="/chat/{{ $student->id }}">
                                <img src="{{asset('/assets/backoffice_assets/icons/Chat_black.svg')}}" class="logo logout_icon mr-1" alt="" />
                                Iniciar Conversa
                            </a>
                            <hr class="mt-0 mb-2 ml-2 mr-2">
                            <a class="msg-title remove_student_button" href="#" data-student-id="{{ $student->id }}" data-class-id="{{ $class->id }}">
                                <img src="{{asset('/assets/backoffice_assets/icons/Cross_black.svg')}}" class="logo logout_icon ml-1 mr-2" alt="" />
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
        {{-- <div class="form-group d-flex flex-wrap mb-4">
            <img src="https://via.placeholder.com/500x500" alt="" class="colleagues_round_avatar mr-3">
            <h4 class="colleagues_name m-0">Luisa Nunes</h4>
            <div class="dropdown ml-auto align-self-center classes_student_dropdown student_dropdown">
                <a href="#" class="messages" data-toggle="dropdown" aria-expanded="false">
                    <span class="ping"></span>
                    <img src="{{asset('/assets/backoffice_assets/icons/Dots.svg')}}" class="empty_dots d-block" alt="">
                    <img src="{{asset('/assets/backoffice_assets/icons/dots_filled.svg')}}" class="filled_dots" alt="" style="display: none;">
                    <span class="dropdown-menu-arrow"></span>
                </a>
                <div class="dropdown-menu message-box">
                    <a class="msg-title" href="/perfil">
                        <img src="{{asset('/assets/backoffice_assets/icons/USer.svg')}}" class="logo logout_icon mr-2" alt="" />
                        Ver Perfil do Aluno
                    </a>
                    <hr class="mt-0 mb-2 ml-2 mr-2">
                    <a class="msg-title" href="#">
                        <img src="{{asset('/assets/backoffice_assets/icons/Chat_black.svg')}}" class="logo logout_icon mr-2" alt="" />
                        Iniciar Conversa
                    </a>
                    <hr class="mt-0 mb-2 ml-2 mr-2">
                    <a class="msg-title" href="#">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross_black.svg')}}" class="logo logout_icon mr-2" alt="" />
                        Remover Aluno da Turma
                    </a>
                </div>
            </div>
        </div>

        <hr> --}}
            
    </div>

</div>