@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}?v=1.2">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}?v=1.2">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/classroom.css', config()->get('app.https')) }}?v=1.2">

@stop

@section('content')

<!-- ============================ Find Courses with Sidebar ================================== -->
<section class="page-title classroom">
    <div class="container">
        <div class="alert alert-success successMsg global-alert" style="display:none;" role="alert">

        </div>

        <div class="alert alert-danger errorMsg global-alert" style="display:none;" role="alert">

        </div>
        <div class="row">
            
            <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="row">
                    {{-- My Profile --}}
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                        <div class="wrap mb-3">
                            <h1 class="title">O meu Perfil</h1>
                        </div>
                        <div class="shop_grid_caption user_info card-body m-0 p-4">
                            <div class="form-group d-flex flex-wrap justify-content-center m-0">
                                {{-- <img src="https://via.placeholder.com/500x500" alt="" class="user_round_avatar m-2"> --}}
                                <div style="background-size: 100%; background-image: url('{{auth()->user()->avatar_url ? '/webapp-macau-storage/avatars/'.auth()->user()->id.'/'.auth()->user()->avatar_url : 'https://via.placeholder.com/500x500'}}')" class="user_round_avatar">
                                </div>
                                <h4 class="sg_rate_title align-self-center m-2">
                                    {{ auth()->user()->username }}
                                    <div class="d-flex flex-row user_options">
                                        <p class="exercise_author align-self-center">
                                            <a href="/perfil/editar/{{ auth()->user()->id }}" class="edit_profile">Editar</a>
                                            @if(auth()->user()->isProfessor() && auth()->user()->isActive())
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
                        <div class="card-body p-1">
                            <div style="padding: 5px;" class="to_scroll classroom_notifications_body" id="classroom_notifications_body">
                                @include('classroom.classroom-partials.notifications-partial')
                            </div>
                            @if($unread_notifications->count() || $read_notifications->count())
                                <hr class="sep">
                                <div class="form-group">
                                    <div class="text-center">
                                        <a href="#" class="notifications_see_more">
                                            Ver Mais
                                        </a>
                                        <a href="#" class="notifications_see_less">
                                            Ver Menos
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- My professor --}}
                    @if (auth()->user()->student_class_user)
                        <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                            <div class="wrap mb-3">
                                <h1 class="title">Professor</h1>
                            </div>
                            <div class="shop_grid_caption user_info card-body m-0 p-4">
                                <div class="form-group d-flex flex-wrap justify-content-center m-0">
                                    <img src="https://via.placeholder.com/500x500" alt="" class="user_round_avatar m-2">
                                    <h4 class="sg_rate_title align-self-center m-2">
                                        {{ auth()->user()->student_class_user->student_class->teacher->username }}
                                        <div class="d-flex flex-row user_options">
                                            <p class="exercise_author align-self-center">
                                                <a href="/chat/{{ auth()->user()->student_class_user->student_class->teacher->id }}" class="edit_profile" style="font-size: 16px;">
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
                    @if ((auth()->user()->isStudent() && auth()->user()->student_class_user) || 
                    (auth()->user()->isProfessor() && auth()->user()->classes->count()))
                        <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                            <div class="row mb-3">
                                <div class="col-sm-5 col-md-5 col-lg-5 align-self-center align-items-center">
                                    @if(auth()->user()->isProfessor() && auth()->user()->isActive())
                                        <h1 class="title">Alunos</h1>
                                    @else
                                        <h1 class="title">Colegas</h1>
                                    @endif
                                    
                                </div>
                                <div class="col-sm-7 col-md-7 col-lg-7 align-self-center align-items-center
                                @if(auth()->user()->isProfessor() && auth()->user()->isActive()) d-inline-flex @endif">
                                    @if(auth()->user()->isProfessor() && auth()->user()->isActive())
                                        <div class="form-group mb-0 mr-2 w-100">
                                            <div class="select2_with_search">
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
                                    (auth()->user()->isStudent() 
                                    && auth()->user()->student_class_user 
                                    && auth()->user()->getStudentColleagues(auth()->user()->student_class_user->student_class->id)->count()) 
                                    || 
                                    (auth()->user()->isProfessor() 
                                    && auth()->user()->getProfessorStudents())
                                    )
                                        <div class="dropdown student_options_dropdown">
                                            <a href="#" class="colleagues_options float-right messages" data-toggle="dropdown">
                                                <span class="ping"></span>
                                                Opções
                                                <span class="dropdown-menu-arrow"></span>
                                            </a>
                                            @if(auth()->user()->isProfessor() && auth()->user()->isActive())
                                                <div class="dropdown-menu message-box">
                                                    {{-- <a class="msg-title" href="#">
                                                        <img src="{{asset('/assets/backoffice_assets/icons/Lens_black.svg')}}" class="logo logout_icon mr-2 ml-1" alt="" />
                                                        Encontrar Alunos
                                                    </a>
                                                    <hr class="mt-0 mb-2 ml-2 mr-2"> --}}
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
                            <div class="shop_grid_caption card-body m-0 pt-4 pr-2 pl-2 pb-0 students_colleagues">
                                @include('classroom.classroom-partials.students-colleagues-partial')
                            </div>
                        </div>
                    @endif

                    {{-- Professor Shortcuts --}}
                    @if(auth()->user()->isProfessor() && auth()->user()->isActive())
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
                                        Biblioteca
                                        <img src="{{asset('/assets/backoffice_assets/icons/Arrow_pink.svg')}}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="row">
                    {{-- Exercises --}}
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                        <div class="wrap mb-3">
                            <h1 class="title">Exercícios</h1>
                        </div>
                        @if(auth()->user()->isProfessor() && auth()->user()->isActive())
                            {{-- Class filter for professor --}}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <div class="select2_with_search">
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

                                <div class="preloader ajax col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="height: 500px !important; margin: auto !important;"><span></span><span></span></div>

                                {{-- PROFESSOR STUDENT_CLASSES EXERCISES --}}
                                <div class="tab-content professor_classroom_exercises" id="classroom_exercises_tabs_content">

                                    @include('classroom.classroom-partials.classroom_exercises_tabs_content')

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

                                <div class="preloader ajax col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="height: 500px !important; margin: auto !important;"><span></span><span></span></div>

                                {{-- STUDENT EXERCISES --}}
                                <div class="tab-content student_classroom_exercises" id="classroom_exercises_tabs_content">

                                    @include('classroom.classroom-partials.classroom_exercises_tabs_content')
                                    
                                </div>

                                {{-- <div class="text-center">
                                    <a href="/exercicios" class="btn search-btn comment_submit" style="font-size: 21px; float: none; white-space: nowrap;">
                                        Ir para Exercícios
                                        <img src="{{asset('/assets/backoffice_assets/icons/Arrow.svg')}}" alt="" style="margin-left: 10px; width: 10%;">
                                    </a>
                                </div> --}}
                                    

                            </div>
                        @endif

                        {{-- PROFESSOR --}}
                        <input type="number" name="page_awaiting_evaluation" id="page_awaiting_evaluation" value="1" hidden>
                        <input type="number" name="previous_page_awaiting_evaluation" id="previous_page_awaiting_evaluation" value="1" hidden>

                        <input type="number" name="page_in_course" id="page_in_course" value="1" hidden>
                        <input type="number" name="previous_page_in_course" id="previous_page_in_course" value="1" hidden>

                        <input type="number" name="page_evaluated" id="page_evaluated" value="1" hidden>
                        <input type="number" name="previous_page_evaluated" id="previous_page_evaluated" value="1" hidden>

                        {{-- STUDENT --}}
                        <input type="number" name="p_in_evaluation" id="p_in_evaluation" value="1" hidden>
                        <input type="number" name="previous_p_in_evaluation" id="previous_p_in_evaluation" value="1" hidden>

                        <input type="number" name="p_in_course" id="p_in_course" value="1" hidden>
                        <input type="number" name="previous_p_in_course" id="previous_p_in_course" value="1" hidden>

                        <input type="number" name="p_done" id="p_done" value="1" hidden>
                        <input type="number" name="previous_p_done" id="previous_p_done" value="1" hidden>

                    </div>

                    {{-- student -  My performance --}}
                    @if(auth()->user()->isProfessor() && auth()->user()->isActive())

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

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https')) }}?v=1.2"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https')) }}?v=1.2"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/exercises.js', config()->get('app.https')) }}?v=1.2"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/classroom.js', config()->get('app.https')) }}?v=1.2"></script>
    <script src="{{asset('/assets/js/ckeditor/ckeditor.js', config()->get('app.https')) }}?v=1.2"></script>
    <script src="{{asset('/assets/js/ckeditor/config.js', config()->get('app.https')) }}?v=1.2"></script>

    <script src="{{asset('/assets/js/dropzone/dist/dropzone.js', config()->get('app.https')) }}?v=1.2"></script>

    <script>

        $(function() {

            // Change Student Classes EXERCISES
            // Select All Classes or Just one
            changeClass('#exercises_class_select');
            function changeClass(selector){
                // All Classes
                if($(selector).val() == 0){
                    $('p.class_label').show();
                    // $('p.one_class').hide();
                }
                // Single Class
                else{
                    $('p.class_label').hide();
                    // $('p.one_class').show();
                }
            }

            $(document).on('change', '#exercises_class_select', function(){
                
                $("#classroom_exercises_tabs_content").hide();
                $('.preloader.ajax').show();

                var current_opened_tab_id = '';
                $('#classroom_exercises_tabs_content .tab-pane').each(function(index, element){
                    if($(element).hasClass('active') && $(element).hasClass('show')){
                        current_opened_tab_id = $(element).attr('id');
                    }
                });

                var student_class_id = $(this).val();

                setTimeout(function () {
                    $.ajax({
                        type: 'GET',
                        url: '/get_student_exercises_by_class/' + student_class_id,
                        success: function(response){
                            $("#classroom_exercises_tabs_content").show();
                            $('.preloader.ajax').hide();
                            if(response && response.status == 'success'){
                                $('.professor_classroom_exercises').html(response.html);

                                $('#classroom_exercises_tabs_content .tab-pane').each(function(index, element){
                                    if(current_opened_tab_id == $(element).attr('id')){
                                        $(element).addClass('active').addClass('show');
                                        $(element).attr('aria-expanded', true);
                                    }
                                    else{
                                        $(element).removeClass('active').removeClass('show');
                                        $(element).attr('aria-expanded', false);
                                    }
                                });
                            }
                            else{
                                // $('.class_name_error').text(response.message);
                                // $('.class_name_error').removeAttr('hidden');
                                // $('.students_colleagues_see_less').click();
                                $(".errorMsg").text(response.message);
                                $(".errorMsg").fadeIn();
                                setTimeout(() => {
                                    $(".errorMsg").fadeOut();
                                }, 5000);
                            }
                            changeClass($('#exercises_class_select'));
                        }
                    });
                }, 50);
            });

            // Change sub_page - PROFESSOR
            $(document).on('click', '.pagination.page_awaiting_evaluation li a, .pagination.page_in_course li a, .pagination.page_evaluated li a', function(e){
                e.preventDefault();

                $("#classroom_exercises_tabs_content").hide();
                $('.preloader.ajax').show();

                var student_class_id = $('#exercises_class_select').val();

                var this_pagination_li = $(this);

                var page_to_change = '';
                var hash = '';
                // Change page Awaiting Evaluation
                if($(this).parent().parent().hasClass('page_awaiting_evaluation')){
                    page_to_change = 'page_awaiting_evaluation';
                    if($(this).attr('data-page') == 1){
                        $('#previous_page_awaiting_evaluation').attr('value', 1);
                    }
                    else{
                        $('#previous_page_awaiting_evaluation').attr('value', $('#page_awaiting_evaluation').attr('value'));
                    }
                    $('#page_awaiting_evaluation').attr('value', $(this).attr('data-page'));

                    $('.pagination.page_awaiting_evaluation li').each(function(index, element){
                        $(element).removeClass('current_page_active');
                    });
                    $(this).parent().addClass('current_page_active');
                    hash = '#awaiting-evaluation-tab';
                }
                // Change page In Course
                else if($(this).parent().parent().hasClass('page_in_course')){
                    page_to_change = 'page_in_course';
                    if($(this).attr('data-page') == 1){
                        $('#previous_page_in_course').attr('value', 1);
                    }
                    else{
                        $('#previous_page_in_course').attr('value', $('#page_in_course').attr('value'));
                    }
                    $('#page_in_course').attr('value', $(this).attr('data-page'));

                    $('.pagination.page_in_course li').each(function(index, element){
                        $(element).removeClass('current_page_active');
                    });
                    $(this).parent().addClass('current_page_active');
                    hash = '#in-course-tab';
                }
                // Change page Evaluated
                else if($(this).parent().parent().hasClass('page_evaluated')){
                    page_to_change = 'page_evaluated';
                    if($(this).attr('data-page') == 1){
                        $('#previous_page_evaluated').attr('value', 1);
                    }
                    else{
                        $('#previous_page_evaluated').attr('value', $('#page_evaluated').attr('value'));
                    }
                    $('#page_evaluated').attr('value', $(this).attr('data-page'));

                    $('.pagination.page_evaluated li').each(function(index, element){
                        $(element).removeClass('current_page_active');
                    });
                    $(this).parent().addClass('current_page_active');
                    hash = '#evaluated-tab';
                }

                var offset_disc = $(".header").height() + 10;

                if ($(window).width() < 992) {
                    offset_disc = 0;
                }

                $("html, body").animate(
                    {
                        scrollTop: $(hash).offset().top - offset_disc
                    },
                    800
                );

                var page_awaiting_evaluation = $('#page_awaiting_evaluation').val();
                var page_in_course = $('#page_in_course').val();
                var page_evaluated = $('#page_evaluated').val();
                
                setTimeout(function () {
                    $.ajax({
                        type: 'GET',
                        url: '/get_student_exercises_by_class/' + student_class_id,
                        data: {page_to_change:page_to_change, 
                            page_awaiting_evaluation:page_awaiting_evaluation,
                            page_in_course:page_in_course,
                            page_evaluated:page_evaluated},
                        success: function(response){
                            $("#classroom_exercises_tabs_content").show();
                            $('.preloader.ajax').hide();
                            if(response && response.status == 'success'){
                                if(page_to_change == 'page_awaiting_evaluation'){
                                    $('#awaiting-evaluation').html(response.html);
                                }
                                else if(page_to_change == 'page_in_course'){
                                    $('#in-course').html(response.html);
                                }
                                else if(page_to_change == 'page_evaluated'){
                                    $('#evaluated').html(response.html);
                                }
                                // $('.professor_classroom_exercises').html(response.html);
                            }
                            else{
                                // $('.class_name_error').text(response.message);
                                // $('.class_name_error').removeAttr('hidden');
                                // $('.students_colleagues_see_less').click();
                                $(".errorMsg").text(response.message);
                                $(".errorMsg").fadeIn();
                                setTimeout(() => {
                                    $(".errorMsg").fadeOut();
                                }, 5000);
                            }

                            changeClass($('#exercises_class_select'));
                        }
                    });
                }, 50);
            });

            // Change sub_page - STUDENT
            $(document).on('click', '.pagination.in_evaluation li a, .pagination.in_course li a, .pagination.done li a', function(e){
                e.preventDefault();

                $("#classroom_exercises_tabs_content").hide();
                $('.preloader.ajax').show();

                var this_pagination_li = $(this);

                var page_to_change = '';
                var hash = '';
                // Change page Awaiting Evaluation
                if($(this).parent().parent().hasClass('in_evaluation')){
                    page_to_change = 'in_evaluation';
                    if($(this).attr('data-page') == 1){
                        $('#previous_p_in_evaluation').attr('value', 1);
                    }
                    else{
                        $('#previous_p_in_evaluation').attr('value', $('#p_in_evaluation').attr('value'));
                    }
                    $('#p_in_evaluation').attr('value', $(this).attr('data-page'));

                    $('.pagination.in_evaluation li').each(function(index, element){
                        $(element).removeClass('current_page_active');
                    });
                    $(this).parent().addClass('current_page_active');
                    hash = '#in-evaluation-tab';
                }
                // Change page In Course
                else if($(this).parent().parent().hasClass('in_course')){
                    page_to_change = 'in_course';
                    if($(this).attr('data-page') == 1){
                        $('#previous_p_in_course').attr('value', 1);
                    }
                    else{
                        $('#previous_p_in_course').attr('value', $('#p_in_course').attr('value'));
                    }
                    $('#p_in_course').attr('value', $(this).attr('data-page'));

                    $('.pagination.in_course li').each(function(index, element){
                        $(element).removeClass('current_page_active');
                    });
                    $(this).parent().addClass('current_page_active');
                    hash = '#in-course-tab';
                }
                // Change page Evaluated
                else if($(this).parent().parent().hasClass('done')){
                    page_to_change = 'done';
                    if($(this).attr('data-page') == 1){
                        $('#previous_p_done').attr('value', 1);
                    }
                    else{
                        $('#previous_p_done').attr('value', $('#p_done').attr('value'));
                    }
                    $('#p_done').attr('value', $(this).attr('data-page'));

                    $('.pagination.done li').each(function(index, element){
                        $(element).removeClass('current_page_active');
                    });
                    $(this).parent().addClass('current_page_active');
                    hash = '#done-tab';
                }

                var offset_disc = $(".header").height() + 10;

                if ($(window).width() < 992) {
                    offset_disc = 0;
                }

                $("html, body").animate(
                    {
                        scrollTop: $(hash).offset().top - offset_disc
                    },
                    800
                );

                var page_in_evaluation = $('#p_in_evaluation').val();
                var page_in_course = $('#p_in_course').val();
                var page_done = $('#p_done').val();
                
                setTimeout(function () {
                    $.ajax({
                        type: 'GET',
                        url: '/get_student_exercises',
                        data: {page_to_change:page_to_change, 
                            page_in_evaluation:page_in_evaluation,
                            page_in_course:page_in_course,
                            page_done:page_done},
                        success: function(response){
                            $("#classroom_exercises_tabs_content").show();
                            $('.preloader.ajax').hide();
                            if(response && response.status == 'success'){
                                if(page_to_change == 'in_evaluation'){
                                    $('#in-evaluation').html(response.html);
                                }
                                else if(page_to_change == 'in_course'){
                                    $('#in-course').html(response.html);
                                }
                                else if(page_to_change == 'done'){
                                    $('#done').html(response.html);
                                }
                                // $('.professor_classroom_exercises').html(response.html);
                            }
                            else{
                                // $('.class_name_error').text(response.message);
                                // $('.class_name_error').removeAttr('hidden');
                                // $('.students_colleagues_see_less').click();
                                $(".errorMsg").text(response.message);
                                $(".errorMsg").fadeIn();
                                setTimeout(() => {
                                    $(".errorMsg").fadeOut();
                                }, 5000);
                            }

                            // changeClass($('#exercises_class_select'));
                        }
                    });
                }, 50);
            });

            //////////////////

            // Expand/Collapse Exercises Accordions
            $(document).on('click', 'a.expand_accordion', function(){
                if($(this).hasClass('expanded')){
                    $(this).removeClass('expanded');
                    $(this).find('span').text('Expandir');
                    // $(this).find('expand_chevron').show();
                    // $(this).find('collapse_chevron').hide();
                }
                else{
                    $(this).addClass('expanded');
                    $(this).find('span').text('Ocultar');
                    // $(this).find('expand_chevron').hide();
                    // $(this).find('collapse_chevron').show();
                }
            });

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
                placeholder: "Escolher tema"
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

            // Choose class to display students (left side "Alunos")
            $(document).on('change', '#students_class_select', function(e){
                // e.preventDefault();
                
                // console.log($(this).val());
                var class_id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '/students_class_select/' + class_id,
                    success: function(response){
                        if(response && response.status == 'success'){
                            $('.students_colleagues').html(response.html);
                            $('.students_colleagues_see_less').click();
                            // $(".successMsg").text(response.message);
                            // $(".successMsg").fadeIn();
                            // setTimeout(() => {
                            //     $(".successMsg").fadeOut();
                            // }, 5000);
                        }
                        else{
                            // $('.class_name_error').text(response.message);
                            // $('.class_name_error').removeAttr('hidden');
                            $('.students_colleagues_see_less').click();
                            $(".errorMsg").text(response.message);
                            $(".errorMsg").fadeIn();
                            setTimeout(() => {
                                $(".errorMsg").fadeOut();
                            }, 5000);
                        }
                    }
                });
            });

            // NOTIFICATIONS

            // Mark shown notifications as read (active = 0)
            markNotsAsRead();
            function markNotsAsRead() {
                var notifications_ids = JSON.parse($('#unread_notifications_ids').val());
                $.ajax({
                    type: 'GET',
                    url: '/notifications_mark_as_read',
                    data: {notifications_ids:notifications_ids},
                    success: function(response){
                    }
                });
            }

            // Update Unread + Read Notifications on scroll down bottom on notification div
            function updateNotificationsOnScroll(e, show_less = null) {
                // e.preventDefault();
                // console.log('updateNotificationsOnScroll');
                if(show_less){
                    if(show_less == 'yes'){
                        show_less = true;
                    }
                    else if(show_less == 'no'){
                        show_less = false;
                    }
                    var current_unread_limit = $('#unread_notifications_count').val();
                    var current_read_limit = $('#read_notifications_count').val();
                    $.ajax({
                        type: 'GET',
                        url: '/update_classroom_notifications',
                        data: {current_unread_limit:current_unread_limit, current_read_limit:current_read_limit, show_less: show_less},
                        success: function(response){
                            if(response && response.status == 'success'){
                                $('#classroom_notifications_body').html(response.html);
                                $('#classroom_notifications_body').find('time.timeago').timeago();
                                $('#classroom_notifications_body').on('scroll', updateNotificationsOnScroll);
                                if(show_less){
                                    $("#classroom_notifications_body.to_scroll").removeClass("scrollable_div");
                                    $('.notifications_see_less').hide();
                                    $('.notifications_see_more').show();
                                }
                                else{
                                    $("#classroom_notifications_body.to_scroll").addClass("scrollable_div");
                                    $('.notifications_see_less').show();
                                    $('.notifications_see_more').hide();
                                }
                                
                                if(response.no_more_notifications){
                                    $('#no_more_notifications').attr('checked', true);
                                }
                                else{
                                    $('#no_more_notifications').attr('checked', false);
                                }
                                markNotsAsRead();
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
                }
                else{
                    var elem = $(e.currentTarget);
                    if (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight() && !$('#no_more_notifications').is(':checked')) {
                        
                        var current_unread_limit = $('#unread_notifications_count').val();
                        var current_read_limit = $('#read_notifications_count').val();
                        $.ajax({
                            type: 'GET',
                            url: '/update_classroom_notifications',
                            data: {current_unread_limit:current_unread_limit, current_read_limit:current_read_limit, show_less: false},
                            success: function(response){
                                if(response && response.status == 'success'){
                                    $('#classroom_notifications_body').html(response.html);
                                    $('#classroom_notifications_body').find('time.timeago').timeago();
                                    $('#classroom_notifications_body').on('scroll', updateNotificationsOnScroll);
                                    $("#classroom_notifications_body.to_scroll").addClass("scrollable_div");
                                    // console.log($("#classroom_notifications_body .to_scroll")[0].scrollHeight - 100);
                                    // $("#classroom_notifications_body .to_scroll").animate({ scrollTop: $("#classroom_notifications_body .to_scroll")[0].scrollHeight - 100}, 1000);
                                    // $("#classroom_notifications_body .to_scroll").scrollTop($("#classroom_notifications_body .to_scroll")[0].scrollHeight + 20);
                                    $('.notifications_see_more').hide();
                                    if(response.no_more_notifications){
                                        $('#no_more_notifications').attr('checked', true);
                                    }
                                    else{
                                        $('#no_more_notifications').attr('checked', false);
                                    }
                                    markNotsAsRead();
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
                    }
                }
                
                // return false;
            }

            $('#classroom_notifications_body').off('scroll', updateNotificationsOnScroll);
            $('#classroom_notifications_body').on('scroll', updateNotificationsOnScroll);

            hideExtraNotifications();

            // Notifications
            function hideExtraNotifications() {
                $(".notifications_see_more").show();
                $(".notifications_see_less").hide();
                $("#classroom_notifications_body.to_scroll").removeClass(
                    "scrollable_div"
                );
                $("#classroom_notifications_body.to_scroll .students_or_colleagues .form-group")
                    .find('div')
                    .not(':nth-child(1)')
                    .not(':nth-child(2)')
                    .not(':nth-child(3)')
                    .not(':nth-child(4)')
                    .not(':nth-child(5)')
                    .not(':nth-child(6)')
                    .not(':nth-child(7)')
                    .not(':nth-child(8)')
                    .not(':nth-child(9)')
                    .not(':nth-child(10)')
                    .not(':nth-child(11)')
                    .not(':nth-child(12)')
                    .addClass('d-none');
                $("#classroom_notifications_body.to_scroll .students_or_colleagues .form-group")
                    .find('hr:not(.sep)')
                    .not(':nth-child(1)')
                    .not(':nth-child(2)')
                    .not(':nth-child(3)')
                    .not(':nth-child(4)')
                    .not(':nth-child(5)')
                    .not(':nth-child(6)')
                    .not(':nth-child(7)')
                    .not(':nth-child(8)')
                    .not(':nth-child(9)')
                    .not(':nth-child(10)')
                    .not(':nth-child(11)')
                    .not(':nth-child(12)')
                    .addClass('d-none');
            }

            function showExtraNotifications() {
                $(".notifications_see_more").hide();
                $(".notifications_see_less").show();
                $("#classroom_notifications_body.to_scroll").addClass(
                    "scrollable_div"
                );
                $("#classroom_notifications_body.to_scroll .students_or_colleagues .form-group")
                    .find('div')
                    .removeClass('d-none');
                $("#classroom_notifications_body.to_scroll .students_or_colleagues .form-group")
                    .find('hr:not(.sep)')
                    .removeClass('d-none');
                // $(".classroom_notifications_body");
            }

            $(document).on("click", ".notifications_see_more", function(e){
                updateNotificationsOnScroll(e, 'no');
                e.preventDefault();
                showExtraNotifications();
            });
            $(document).on("click", ".notifications_see_less", function(e) {
                updateNotificationsOnScroll(e, 'yes');
                e.preventDefault();
                hideExtraNotifications();
            });

        });

    </script>

@stop