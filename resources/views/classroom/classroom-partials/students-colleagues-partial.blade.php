@if(!$students_colleagues->count())
    <div class="form-group d-flex flex-wrap mb-4 ml-2">
        @if(auth()->user()->isStudent())
            <h4 class="colleagues_name m-0">Ainda não tem colegas de turma.</h4>
        @else
            <h4 class="colleagues_name m-0">Esta turma não tem nenhum aluno.</h4>
        @endif
    </div>
@else
    <div style="overflow-y:auto; overflow-x:hidden; max-height: 600px;">
        <div class="students_or_colleagues pr-3 pl-3">
            @foreach ($students_colleagues as $s_c)
                <div class="form-group d-flex flex-wrap mb-4">
                    <img src="{{ $s_c->avatar_url ? '/webapp-macau-storage/avatars/'.$s_c->id.'/'.$s_c->avatar_url : 'https://via.placeholder.com/500x500'}}" alt="" class="colleagues_round_avatar mr-3">
                    <h4 class="colleagues_name m-0">{{ $s_c->username }}</h4>
                    <div class="dropdown ml-auto align-self-center student_dropdown">
                        <a href="#" class="messages" data-toggle="dropdown" aria-expanded="false">
                            <span class="ping"></span>
                            <img src="{{asset('/assets/backoffice_assets/icons/Dots.svg', config()->get('app.https'))}}?v=2.4" class="empty_dots d-block" alt="">
                            <img src="{{asset('/assets/backoffice_assets/icons/dots_filled.svg', config()->get('app.https'))}}?v=2.4" class="filled_dots" alt="" style="display: none;">
                            <span class="dropdown-menu-arrow"></span>
                        </a>
                        <div class="dropdown-menu message-box">
                            <a class="msg-title" href="/perfil/{{ $s_c->id }}">
                                <img src="{{asset('/assets/backoffice_assets/icons/USer.svg', config()->get('app.https'))}}?v=2.4" class="logo logout_icon mr-2" alt="" />
                                Ver Perfil @if(auth()->user()->isProfessor() && auth()->user()->isActive()) do Aluno @endif
                            </a>
                            <hr class="mt-0 mb-2 ml-2 mr-2">
                            <a class="msg-title" href="/chat/{{ $s_c->id }}">
                                <img src="{{asset('/assets/backoffice_assets/icons/Chat_black.svg', config()->get('app.https'))}}?v=2.4" class="logo logout_icon mr-2" alt="" />
                                Iniciar Conversa
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <hr>

    <div class="form-group">
        <div class="text-center">
            <a href="#" class="students_colleagues_see_all">
                @if(auth()->user()->isProfessor() && auth()->user()->isActive())
                    Ver todos os Alunos
                @else
                    Mostrar todos os Colegas
                @endif
            </a>
            <a href="#" class="students_colleagues_see_less">
                Ver menos
            </a>
        </div>
    </div>
@endif
