@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/classroom.css', config()->get('app.https')) }}">

@stop

@section('content')

<!-- ============================ Find Courses with Sidebar ================================== -->
<section class="page-title classroom">
    <div class="container">
        <div class="alert alert-success successMsg" style="display:none;" role="alert">

        </div>

        <div class="alert alert-danger errorMsg" style="display:none;" role="alert">

        </div>
        <div class="row">
            
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="row">
                    {{-- My Profile --}}
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                        <div class="wrap mb-3">
                            <h1 class="title">O meu Perfil</h1>
                        </div>
                        <div class="shop_grid_caption user_info card-body m-0 p-4">
                            <div class="form-group d-flex flex-wrap justify-content-center m-0">
                                <img src="https://via.placeholder.com/500x500" alt="" class="user_round_avatar mr-3">
                                <h4 class="sg_rate_title align-self-center m-0">
                                    {{ auth()->user()->username }}
                                    <div class="d-flex flex-row user_options">
                                        <p class="exercise_author align-self-center">
                                            <a href="/perfil/editar/{{ auth()->user()->id }}" class="edit_profile">Editar</a>
                                            @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)
                                                <a href="#" class="edit_profile">Definições do Sistema</a>
                                            @endif
                                        </p>
                                    </div>
                                </h4>
                            </div>
                        </div>
                    </div>

                    {{-- Notifications --}}
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                        <div class="wrap mb-3">
                            <h1 class="title">Notificações</h1>
                        </div>
                        <div class="card-body">
                            <div class="form-group m-0">
                                @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)
                                    <div class="">
                                        <p class="exercise_level float-none m-0" style="font-size: 16px;line-height: 19px;">
                                            O Aluno <strong>Luis Silva</strong> aguarda a avaliação do Exercício “De Áustria para Portugal”. 
                                        </p>
                                        <p class="notification_time_ago text-right d-block mt-0">Há 24 minutos</p>
                                    </div>
                                    <hr>
                                    <div class="">
                                        <p class="exercise_level float-none m-0" style="font-size: 16px;line-height: 19px;">
                                            O Aluno <strong>Luis Silva</strong> aguarda a avaliação do Exercício “De Áustria para Portugal”. 
                                        </p>
                                        <p class="notification_time_ago text-right d-block mt-0">Há 2 horas e 8 minutos</p>
                                    </div>
                                @else
                                    <div class="">
                                        <p class="exercise_level float-none m-0" style="font-size: 16px;line-height: 19px;">
                                            Tem um novo <strong>Exercício</strong> avaliado.
                                        </p>
                                        <p class="notification_time_ago text-right d-block mt-0">Há 24 minutos</p>
                                    </div>
                                    <hr>
                                    <div class="">
                                        <p class="exercise_level float-none m-0" style="font-size: 16px;line-height: 19px;">
                                            Tem um novo <strong>Exercício</strong> sugerido.
                                        </p>
                                        <p class="notification_time_ago text-right d-block mt-0">Há 37 minutos</p>
                                    </div>
                                @endif
                                
                                <hr>
                                <div class="text-center">
                                    <a href="#" class="notifications_see_all">
                                        Ver Tudo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- My professor --}}
                    @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)

                    @else
                        <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                            <div class="wrap mb-3">
                                <h1 class="title">Professor</h1>
                            </div>
                            <div class="shop_grid_caption user_info card-body m-0 p-4">
                                <div class="form-group d-flex flex-wrap justify-content-center m-0">
                                    <img src="https://via.placeholder.com/500x500" alt="" class="user_round_avatar mr-3">
                                    <h4 class="sg_rate_title align-self-center m-0">
                                        João Paulo
                                        <div class="d-flex flex-row user_options">
                                            <p class="exercise_author align-self-center">
                                                <a href="#" class="edit_profile" style="font-size: 16px;">
                                                    Chat
                                                </a>
                                                <a href="#" class="edit_profile" style="font-size: 16px;">
                                                    Enviar E-mail
                                                </a>
                                            </p>
                                        </div>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Colleagues / Students --}}
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                        <div class="row mb-3">
                            <div class="col-sm-5 col-md-5 col-lg-5 align-self-center align-items-center">
                                @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)
                                    <h1 class="title">Alunos</h1>
                                @else
                                    <h1 class="title">Colegas</h1>
                                @endif
                                
                            </div>
                            <div class="col-sm-7 col-md-7 col-lg-7 align-self-center align-items-center
                            @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2) d-inline-flex @endif">
                                @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)
                                    <div class="form-group mb-0 mr-2 w-100">
                                        <div class="select2_with_search" style="border-radius: 5px;">
                                            <select name="students_class_select" id="students_class_select" class="form-control" style="border: none;">
                                                <option value="0">Todos</option>
                                                @foreach (auth()->user()->classes as $class)
                                                    <option value="{{ $class->id }}">Turma {{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                
                                @if (
                                (auth()->user()->user_role_id == 3 
                                && auth()->user()->student_class_user 
                                && auth()->user()->getStudentColleagues(auth()->user()->student_class_user->student_class->id)->count()) 
                                || 
                                (auth()->user()->user_role_id != 3 
                                && auth()->user()->getProfessorStudents())
                                )
                                    <div class="dropdown student_options_dropdown">
                                        <a href="#" class="colleagues_options float-right messages" data-toggle="dropdown">
                                            <span class="ping"></span>
                                            Opções
                                            <span class="dropdown-menu-arrow"></span>
                                        </a>
                                        @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)
                                            <div class="dropdown-menu message-box">
                                                <a class="msg-title" href="#">
                                                    <img src="{{asset('/assets/backoffice_assets/icons/Lens_black.svg')}}" class="logo logout_icon mr-2 ml-1" alt="" />
                                                    Encontrar Alunos
                                                </a>
                                                <hr class="mt-0 mb-2 ml-2 mr-2">
                                                <a class="msg-title" href="#">
                                                    <img src="{{asset('/assets/backoffice_assets/icons/Graph_Pie_black.svg')}}" class="logo logout_icon mr-2" alt="" />
                                                    Desempenho da Turma
                                                </a>
                                                <hr class="mt-0 mb-2 ml-2 mr-2">
                                                <a class="msg-title professor_class_group_chat" href="#">
                                                    <img src="{{asset('/assets/backoffice_assets/icons/Chat_black.svg')}}" class="logo logout_icon mr-2" alt="" />
                                                    Iniciar Conversa
                                                </a>
                                            </div>
                                        @else
                                        @if (auth()->user()->student_class_user)
                                            <div class="dropdown-menu message-box">
                                                <a class="msg-title student_class_group_chat" href="#" data-student-class-id="{{ auth()->user()->student_class_user->student_class_id }}">
                                                    <img src="{{asset('/assets/backoffice_assets/icons/Chat_black.svg')}}" class="logo logout_icon mr-2" alt="" />
                                                    Iniciar Conversa de Turma
                                                </a>
                                            </div>
                                        @endif
                                            
                                        @endif
                                        
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="shop_grid_caption card-body m-0 pt-4 pr-4 pl-4 pb-0 students_colleagues">
                            @include('classroom.classroom-partials.students-colleagues-partial')
                        </div>
                    </div>

                    {{-- Professor Shortcuts --}}
                    @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)
                        <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                            <div class="wrap mb-3">
                                <h1 class="title">Atalhos</h1>
                            </div>
                            <div class="card-body">
                                <div class="form-group m-0">
                                    <a href="/exercicios/criar" class="shortcut_links">
                                        Criar Novo Exercício
                                        <img src="{{asset('/assets/backoffice_assets/icons/Arrow_pink.svg')}}" alt="">
                                    </a>
                                </div>
                                <hr>
                                <div class="form-group m-0">
                                    <a href="/exercicios" class="shortcut_links">
                                        Todos os Exercícios
                                        <img src="{{asset('/assets/backoffice_assets/icons/Arrow_pink.svg')}}" alt="">
                                    </a>
                                </div>
                                <hr>
                                <div class="form-group m-0">
                                    <a href="#" class="shortcut_links">
                                        Templates de Questões
                                        <img src="{{asset('/assets/backoffice_assets/icons/Arrow_pink.svg')}}" alt="">
                                    </a>
                                </div>
                                <hr>
                                <div class="form-group m-0">
                                    <a href="#" class="shortcut_links">
                                        Contactar o Suporte
                                        <img src="{{asset('/assets/backoffice_assets/icons/Arrow_pink.svg')}}" alt="">
                                    </a>
                                </div>
                                <hr>
                                <div class="form-group m-0">
                                    <a href="/artigos" class="shortcut_links">
                                        Lista de Artigos
                                        <img src="{{asset('/assets/backoffice_assets/icons/Arrow_pink.svg')}}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-sm-12 col-md-8 col-lg-8">
                <div class="row">
                    {{-- Exercises --}}
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                        <div class="wrap mb-3">
                            <h1 class="title">Exercícios</h1>
                        </div>
                        @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)
                            {{-- Class filter for professor --}}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <div class="select2_with_search" style="border-radius: 5px;">
                                            <select name="exercises_class_select" id="exercises_class_select" class="form-control" style="border: none;">
                                                <option value="0">Todas as Turmas</option>
                                                @foreach (auth()->user()->classes as $class)
                                                    <option value="{{ $class->id }}">Turma {{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-tab customize-tab tabs_creative">

                                <ul class="nav nav-tabs p-2 b-0" id="classroom_exercises_tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="awaiting-evaluation-tab" data-toggle="tab" href="#awaiting-evaluation" role="tab" aria-controls="awaiting-evaluation" aria-selected="true">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Watch.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Watch_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                            A aguardar Avaliação</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="in-course-tab" data-toggle="tab" href="#in-course" role="tab" aria-controls="in-course" aria-selected="false">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Graph.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Graph_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                            Em curso</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="evaluated-tab" data-toggle="tab" href="#evaluated" role="tab" aria-controls="evaluated" aria-selected="false">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Check.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Check_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                            Avaliados</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="classroom_exercises_tabs_content">

                                    {{-- awaiting-evaluation TAB --}}
                                    <div class="tab-pane fade show active" id="awaiting-evaluation" role="tabpanel" aria-labelledby="awaiting-evaluation-tab">
                                        
                                            @include('classroom.professor-exercises-evaluation.awaiting-evaluation')

                                    </div>

                                    {{-- in-course TAB --}}
                                    <div class="tab-pane fade" id="in-course" role="tabpanel" aria-labelledby="in-course-tab">

                                            @include('classroom.professor-exercises-evaluation.in-course')

                                    </div>

                                    {{-- evaluated TAB --}}
                                    <div class="tab-pane fade" id="evaluated" role="tabpanel" aria-labelledby="evaluated-tab">

                                            @include('classroom.professor-exercises-evaluation.evaluated')

                                    </div>
                                </div>

                            </div>
                        @else
                            <div class="custom-tab customize-tab tabs_creative">

                                <ul class="nav nav-tabs p-2 b-0" id="classroom_exercises_tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="in-evaluation-tab" data-toggle="tab" href="#in-evaluation" role="tab" aria-controls="in-evaluation" aria-selected="true">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Watch.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Watch_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                            Em Avaliação</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="in-course-tab" data-toggle="tab" href="#in-course" role="tab" aria-controls="in-course" aria-selected="false">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Graph.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Graph_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                            Em curso</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Check.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Check_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                            Concluídos</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="classroom_exercises_tabs_content">

                                    {{-- in-evaluation TAB --}}
                                    <div class="tab-pane fade show active" id="in-evaluation" role="tabpanel" aria-labelledby="in-evaluation-tab">
                                        
                                        @include('classroom.student-exercises-evaluation.in-evaluation')

                                    </div>

                                    {{-- in-course TAB --}}
                                    <div class="tab-pane fade" id="in-course" role="tabpanel" aria-labelledby="in-course-tab">

                                        @include('classroom.student-exercises-evaluation.in-course')

                                    </div>

                                    {{-- done TAB --}}
                                    <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">

                                        @include('classroom.student-exercises-evaluation.done')

                                    </div>
                                </div>

                                <div class="text-center">
                                    <a href="/exercicios" class="btn search-btn comment_submit" style="font-size: 21px; float: none; white-space: nowrap;">
                                        Ir para Exercícios
                                        <img src="{{asset('/assets/backoffice_assets/icons/Arrow.svg')}}" alt="" style="margin-left: 10px; width: 10%;">
                                    </a>
                                </div>
                                    

                            </div>
                        @endif
                            

                    </div>

                    {{-- student -  My performance --}}
                    @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)

                    @else
                        <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                            <div class="wrap mb-3">
                                <h1 class="title">O meu Desempenho</h1>
                            </div>
                            <div class="card-body" style="position: relative; overflow: hidden; height: 480px; display: grid;">
                                <img src="{{asset('/assets/backoffice_assets/icons/performance_icon.svg')}}" alt="" style="position: absolute; place-self: center;">
                            </div>
                        </div>
                    @endif
                        
                </div>
            </div>
        </div>
        
    </div>

</section>
<!-- ============================ Find Courses with Sidebar End ================================== -->

@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https'))}}"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https'))}}"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/exercises.js', config()->get('app.https'))}}"></script>
    <script src="{{asset('/assets/js/ckeditor/ckeditor.js', config()->get('app.https'))}}"></script>
    <script src="{{asset('/assets/js/ckeditor/config.js', config()->get('app.https'))}}"></script>

    <script src="{{asset('/assets/js/dropzone/dist/dropzone.js', config()->get('app.https'))}}"></script>

    <script>

        $(function() {

            // GROUP CHAT
            $(document).on('click', '.student_class_group_chat, .professor_class_group_chat', function(e){
                e.preventDefault();
                var class_id = null;
                if($(this).hasClass('professor_class_group_chat')){
                    class_id = $('#students_class_select').val();
                }
                else if($(this).hasClass('student_class_group_chat')){
                    class_id = $(this).attr('data-student-class-id');
                }
                // var group_chat_user_ids = $(this).attr('data-users-array-ids').split(',');
                $.ajax({
                    type: 'GET',
                    url: '/chat_de_grupo',
                    data: {class_id: class_id},
                    success: function(response){
                        if(response && response.status == 'success'){
                            window.location = '/chat_de_grupo/' + response.chat_id;
                        }
                        else{
                            $(".errorMsg").text(response.message);
                            $(".errorMsg").fadeIn();
                            setTimeout(() => {
                                $(".errorMsg").fadeOut();
                            }, 5000);
                        }
                    }
                });
            });

            // Change icon image on tab change
            changeIconImage();
            function changeIconImage(){
                $('#classroom_exercises_tabs a.nav-link').each(function(index, element){
                    if($(element).hasClass('active')){
                        $(element).find('.white_icon').show();
                        $(element).find('.black_icon').hide();
                    }
                    else{
                        $(element).find('.white_icon').hide();
                        $(element).find('.black_icon').show();
                    }
                });
            }

            $(document).on('click', '#classroom_exercises_tabs a.nav-link', function(){
                changeIconImage();
            });

            // Change right side info_accordion icon
            changeAccordionInfoIcon($('.info_accordion a'));
            function changeAccordionInfoIcon(selector){
                if($(selector).hasClass('collapsed')){
                    $(selector).find('.show_info_button').show();
                    $(selector).find('.hide_info_button').hide();
                }
                else{
                    $(selector).find('.show_info_button').hide();
                    $(selector).find('.hide_info_button').show();
                }
            }

            $(document).on('click', '.info_accordion a', function(){
                changeAccordionInfoIcon($(this));
            });

            $('#exercise_template').select2({
                placeholder: "Escolher exercício"
            });

            $('#categories').select2({
                placeholder: "Escolher categoria"
            });

            $('#levels').select2({
                placeholder: "Escolher Nível"
            });

            $('#exercises_class_select').select2();
            $('#students_class_select').select2();

            function changeDotsIcons(selector){
                if(!$(selector).parent().hasClass('show')){
                    $(selector).find('img.filled_dots').addClass('d-block');
                    $(selector).find('img.empty_dots').removeClass('d-block').hide();
                }
            }

            $('.student_dropdown a').on('click', function(){
                $('.student_dropdown a').find('img.filled_dots').removeClass('d-block').hide();
                $('.student_dropdown a').find('img.empty_dots').addClass('d-block');
                changeDotsIcons(this);
            });

            $('html, body').on('click', function(e){
                if (!$(e.target).hasClass('empty_dots') || $(e.target).hasClass('colleagues_options')) {
                    $('.student_dropdown a').find('img.filled_dots').removeClass('d-block').hide();
                    $('.student_dropdown a').find('img.empty_dots').addClass('d-block');
                }
            });

            // Select All Classes or Just one
            changeClass('#exercises_class_select');
            function changeClass(selector){
                // All Classes
                if($(selector).val() == 1){
                    $('p.all_classes').show();
                    $('p.one_class').hide();
                }
                // Single Class
                else{
                    $('p.all_classes').hide();
                    $('p.one_class').show();
                }
            }

            $(document).on('change', '#exercises_class_select', function(){
                changeClass($(this));
            });

            // Choose class to display students (left side "Alunos")
            $(document).on('change', '#students_class_select', function(e){
                // e.preventDefault();
                console.log($(this).val());
                var class_id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '/students_class_select/' + class_id,
                    success: function(response){
                        if(response && response.status == 'success'){
                            $('.students_colleagues').html(response.html);
                            // $(".successMsg").text(response.message);
                            // $(".successMsg").fadeIn();
                            // setTimeout(() => {
                            //     $(".successMsg").fadeOut();
                            // }, 5000);
                        }
                        else{
                            // $('.class_name_error').text(response.message);
                            // $('.class_name_error').removeAttr('hidden');
                            $(".errorMsg").text(response.message);
                            $(".errorMsg").fadeIn();
                            setTimeout(() => {
                                $(".errorMsg").fadeOut();
                            }, 5000);
                        }
                    }
                });
            });

        });

    </script>

@stop