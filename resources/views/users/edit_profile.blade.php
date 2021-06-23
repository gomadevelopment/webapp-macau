@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}?v=1.9">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}?v=1.9">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/classroom.css', config()->get('app.https')) }}?v=1.9">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/users.css', config()->get('app.https')) }}?v=1.9">

<link rel="stylesheet" href="{{asset('/assets/js/bootstrap-datepicker/dist/css/bootstrap-datepicker.css', config()->get('app.https')) }}" id="bscss">

@stop

@section('content')

<!-- ============================ Page Title Start================================== -->
<section class="page-title articles">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <div class="wrap">
                    <h1 class="title">O meu Perfil</h1>
                </div>

                <div class="exercise_time wrap float-right create_class_button" style="display: none;">
                    <a href="#" data-toggle="modal" data-target="#new_create_class_modal"  class="btn search-btn comment_submit" style="float: none; padding: 12px 20px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Criar Turma
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- ============================ Page Title End ================================== -->	

<!-- ============================ Find Courses with Sidebar ================================== -->
<section class="pt-0">
    <div class="container">

            <div class="custom-tab customize-tab tabs_creative">
                <ul class="nav nav-tabs p-2 b-0" id="edit_profile_tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ isset($inputs['land_on_settings_tab']) && $inputs['land_on_settings_tab'] ? '' : 'active' }}" 
                            id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" 
                            aria-selected="{{ isset($inputs['land_on_settings_tab']) && $inputs['land_on_settings_tab'] ? 'false' : 'true' }}">
                            <img src="{{asset('/assets/backoffice_assets/icons/info.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/info_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Informação</a>
                    </li>
                    @if($user->id == auth()->user()->id)
                        <li class="nav-item">
                            <a class="nav-link" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab" aria-controls="notifications-tab" aria-selected="false">
                                <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_white.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                Notificações</a>
                        </li>
                        @if(auth()->user()->isProfessor() && auth()->user()->isActive())
                            <li class="nav-item">
                                <a class="nav-link" id="classes-tab" data-toggle="tab" href="#classes" role="tab" aria-controls="classes-tab" aria-selected="false">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Classes_white.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Classes.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                    Turmas</a>
                            </li>
                            @if(auth()->user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link {{ isset($inputs['land_on_settings_tab']) && $inputs['land_on_settings_tab'] ? 'active' : '' }}"
                                        id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings-tab" 
                                        aria-selected="{{ isset($inputs['land_on_settings_tab']) && $inputs['land_on_settings_tab'] ? 'true' : 'false' }}">
                                        <img src="{{asset('/assets/backoffice_assets/icons/cog_white.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/cog.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                                        Definições</a>
                                </li>
                            @endif
                        @endif
                    @endif
                </ul>

                <div class="tab-content" id="edit_profile_tabs_content">
                    {{-- INFO TAB --}}
                    <div class="tab-pane fade {{ isset($inputs['land_on_settings_tab']) && $inputs['land_on_settings_tab'] ? '' : 'active show' }}" id="info" role="tabpanel" aria-labelledby="info-tab">

                        @include('users.edit-tab-contents.edit_info')

                    </div>
                    @if($user->id == auth()->user()->id)
                        {{-- NOTIFICATIONS TAB --}}
                        <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">

                            @include('users.edit-tab-contents.edit_notifications')

                        </div>
                        {{-- professor - CLASSES TAB --}}
                        @if(auth()->user()->isProfessor() && auth()->user()->isActive())
                            <div class="tab-pane fade" id="classes" role="tabpanel" aria-labelledby="classes-tab">
                                
                                @include('users.edit-tab-contents.edit_classes')

                            </div>
                            @if(auth()->user()->isAdmin())
                                {{-- SETTINGS TAB --}}
                                <div class="tab-pane fade {{ isset($inputs['land_on_settings_tab']) && $inputs['land_on_settings_tab'] ? 'active show' : '' }}" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                                    @include('users.edit-tab-contents.edit_settings')

                                </div>
                            @endif
                        @endif
                    @endif
                    
                </div>
            </div>
        
    </div>
</section>

{{-- MODALS --}}

{{-- New Class Modal include --}}
@include('users.edit-tab-contents.classes.new-class-modal')
{{-- Insert Student in class Modal include --}}

{{-- TO DO REFRESH NOT WORKING --}}
<div class="modal fade" id="new_insert_student_modal" tabindex="-1" role="dialog" aria-labelledby="insert_student_modal" aria-hidden="true">
    @include('users.edit-tab-contents.classes.insert-student-modal', ['students_without_class' => $students_without_class])
</div>


<input type="text" name="" id="hidden_user_id" value="{{ $user->id }}" hidden>
<input type="text" name="" id="hidden_auth_user_id" value="{{ auth()->user()->id }}" hidden>

<!-- ============================ Find Courses with Sidebar End ================================== -->

@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https')) }}?v=1.9"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https')) }}?v=1.9"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/exercises.js', config()->get('app.https')) }}?v=1.9"></script>
    <script src="{{asset('/assets/js/ckeditor/ckeditor.js', config()->get('app.https')) }}?v=1.9"></script>
    <script src="{{asset('/assets/js/ckeditor/config.js', config()->get('app.https')) }}?v=1.9"></script>

    <script src="{{asset('/assets/js/bootstrap-datepicker/dist/js/bootstrap-datepicker.js', config()->get('app.https'))}}"></script>
    <script src="{{asset('/assets/js/bootstrap-datepicker/dist/js/bootstrap-datepicker.pt.min.js', config()->get('app.https'))}}"></script>

    <script>

        $(function() {

            $('body').addClass('chat_body');

            $('#select_university').select2();

            function updateSelectStudentsModal(){
                $('#select_students_to_class').select2({
                    placeholder: 'Pesquisar...',
                    templateResult: formatState,
                    templateSelection: formatState
                });
            }

            $('#select_students_to_class').select2({
                placeholder: 'Pesquisar...',
                templateResult: formatState,
                templateSelection: formatState
            });

            function formatState (opt) {
                if (!opt.id) {
                    return opt.text;
                } 
                var optimage = $(opt.element).attr('data-image'); 
                if(!optimage){
                    return opt.text;
                }
                else {                    
                    var $opt = $(
                    '<span><img class="rounded-circle user_img mr-2" src="' + optimage + '" /> ' + opt.text + '</span>'
                    );
                    return $opt;
                }
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                }
            });

            

            // Replace user_avatar_image
            $(document).on('click', '#replace_user_avatar', function(e){
                e.preventDefault();
                $('#avatar_url').click();
            });

            $(document).on('change', '#avatar_url', function(e){
                e.preventDefault();

                var this_anchor = this;

                $(this).closest(".replace_user_avatar_row").hide();
                $(this).closest(".replace_user_avatar_row").prev('.preloader.ajax')
                    .css('height', $(this).closest(".replace_user_avatar_row").height())
                    .show();


                var user_id = $('#hidden_user_id').val();
                var auth_user_id = $('#hidden_auth_user_id').val();
                var new_user_avatar = $(this)[0].files[0];

                if(typeof new_user_avatar === typeof undefined){
                    $(this).closest(".replace_user_avatar_row").show();
                    $(this).closest(".replace_user_avatar_row").prev('.preloader.ajax').hide();
                    return false;
                }
                
                var formData = new FormData();
                formData.append('user_id', user_id);
                formData.append('new_user_avatar', new_user_avatar);

                $.ajax({
                    type: "POST",
                    url: "/replace_user_avatar",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response && response.status == "success") {
                            $(this_anchor).closest(".replace_user_avatar_row").show();
                            $(this_anchor).closest(".replace_user_avatar_row").prev('.preloader.ajax').hide();

                            var new_avatar_url = '/webapp-macau-storage/avatars/' + user_id + '/' + response.avatar_url;
                            $('.user_round_avatar').css('background-image', "url('"+new_avatar_url+"')");
                            if(auth_user_id == user_id){
                                $('.top_nav_bar_avatar').css('background-image', "url('"+new_avatar_url+"')");
                            }
                        }
                        else {
                            $(".errorMsg").text(response.message);
                            $(".errorMsg").fadeIn();
                            setTimeout(() => {
                                $(".errorMsg").fadeOut();
                            }, 2000);
                        }
                    }
                });
            })

            // Change icon image on tab change
            changeIconImage();
            function changeIconImage(){
                $('#edit_profile_tabs a.nav-link').each(function(index, element){
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

            function changePageTitleOnTab(selector){
                if($(selector).hasClass('active')){
                    if($(selector).attr('id') == 'classes-tab'){
                        $('.page-title .wrap .title').text('Turmas');
                        $('.page-title .create_class_button').show();
                    }
                    else if($(selector).attr('id') == 'settings-tab'){  
                        $('.page-title .wrap .title').text('Definições');
                        $('.page-title .create_class_button').hide();
                    }
                    else if($(selector).attr('id') == 'notifications-tab'){  
                        $('.page-title .wrap .title').text('Notificações');
                        $('.page-title .create_class_button').hide();
                    }
                    else{
                        $('.page-title .wrap .title').text('O meu Perfil');
                        $('.page-title .create_class_button').hide();
                    }
                }
            }

            $(document).on('click', '#edit_profile_tabs a.nav-link', function(){
                changeIconImage();
                changePageTitleOnTab(this);
            });

            function expandCollapseAccordion(selector){
                if(!$(selector).hasClass('expanded')){
                    $(selector).addClass('expanded');
                    $(selector).css('border', 'none');
                    $(selector).find('img.expand_chevron').hide();
                    $(selector).find('img.collapse_chevron').show();
                }
                else{
                    $(selector).removeClass('expanded');
                    $(selector).css('border', 'none');
                    $(selector).find('img.expand_chevron').show();
                    $(selector).find('img.collapse_chevron').hide();
                }
            }

            $(document).on('click', '.expand_accordion', function(){
                expandCollapseAccordion($(this));
            });

            function changeDotsIcons(selector){
                if(!$(selector).parent().hasClass('show')){
                    $(selector).find('img.filled_dots').addClass('d-block');
                    $(selector).find('img.empty_dots').removeClass('d-block').hide();
                }
            }

            $('.classes_student_dropdown a').on('click', function(){
                $('.classes_student_dropdown a').find('img.filled_dots').removeClass('d-block').hide();
                $('.classes_student_dropdown a').find('img.empty_dots').addClass('d-block');
                changeDotsIcons(this);
            });

            $('html, body').on('click', function(e){
                if (!$(e.target).hasClass('empty_dots') || $(e.target).hasClass('colleagues_options')) {
                    $('.classes_student_dropdown a').find('img.filled_dots').removeClass('d-block').hide();
                    $('.classes_student_dropdown a').find('img.empty_dots').addClass('d-block');
                }
            });

            // Create new class
            $(document).on('click', '.create_new_class_button', function(e){
                e.preventDefault();
                var class_name = $('#class_name').val();
                var user_id = $('#hidden_user_id').val();

                // No class name filled
                if(class_name.length == 0){
                    $('.class_name_error').text('Preencha o nome da turma antes de submeter.');
                    $('.class_name_error').removeAttr('hidden');
                }
                else{
                    $.ajax({
                        type: 'POST',
                        url: '/create_class',
                        data: {class_name: class_name},
                        success: function(response){
                            if(response && response.status == 'success'){
                                $('#classes').html(response.html);
                                $('#new_create_class_modal .mod-close').click();
                                $(".successMsg").text(response.message);
                                $(".successMsg").fadeIn();
                                setTimeout(() => {
                                    $(".successMsg").fadeOut();
                                }, 10000);
                            }
                            else{
                                $('.class_name_error').text(response.message);
                                $('.class_name_error').removeAttr('hidden');
                                $(".errorMsg").text(response.message);
                                $(".errorMsg").fadeIn();
                                setTimeout(() => {
                                    $(".errorMsg").fadeOut();
                                }, 5000);
                            }
                        }
                    });
                }
            });

            var class_to_add_student_id = null;
            $(document).on('click', '.insert_student_button_on_class_body', function(e){
                e.preventDefault();
                class_to_add_student_id = $(this).attr('data-class-id');
            });

            // Insert Students in class
            $(document).on('click', '.insert_student_button', function(e){
                e.preventDefault();
                var class_id = class_to_add_student_id;
                var student_ids_for_class = $('#select_students_to_class').val();

                // Invalid class
                if(!class_id){
                    $('.select_students_to_class_error').text('Turma inválida. Por favor, atualize a página e tente de novo.');
                    $('.select_students_to_class_error').removeAttr('hidden');
                }

                // No students selected
                if(!student_ids_for_class){
                    $('.select_students_to_class_error').text('Insira pelo menos um (1) aluno.');
                    $('.select_students_to_class_error').removeAttr('hidden');
                }
                else{
                    $.ajax({
                        type: 'GET',
                        url: '/insert_students_in_class',
                        data: {class_id: class_id, student_ids_for_class: student_ids_for_class},
                        success: function(response){
                            if(response && response.status == 'success'){
                                $('.unique_class_body.class_' + class_id).html(response.html);
                                $('#new_insert_student_modal .mod-close').click();
                                $('#new_insert_student_modal').html(response.html2);
                                updateSelectStudentsModal();
                                $('a[href="#collapse_class_' + class_id + '"]').click();
                                $(".successMsg").text(response.message);
                                $(".successMsg").fadeIn();
                                setTimeout(() => {
                                    $(".successMsg").fadeOut();
                                }, 10000);
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
                }
            })

            // Remove Student from class
            $(document).on('click', '.remove_student_button', function(e){
                e.preventDefault();
                var student_id = $(this).attr('data-student-id');
                var class_id = $(this).attr('data-class-id');

                // Invalid class
                if(!class_id){
                    $(".errorMsg").text('Turma inválida. Por favor, atualize a página e tente de novo.');
                    $(".errorMsg").fadeIn();
                    setTimeout(() => {
                        $(".errorMsg").fadeOut();
                    }, 5000);
                }
                else{
                    $.ajax({
                        type: 'GET',
                        url: '/remove_student_from_class/' + student_id,
                        success: function(response){
                            if(response && response.status == 'success'){
                                $('.unique_class_body.class_' + class_id).html(response.html);
                                $('#new_insert_student_modal').html(response.html2);
                                updateSelectStudentsModal();
                                $('a[href="#collapse_class_' + class_id + '"]').click();
                                $(".successMsg").text(response.message);
                                $(".successMsg").fadeIn();
                                setTimeout(() => {
                                    $(".successMsg").fadeOut();
                                }, 10000);
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
                    

            });

            $('#class_name').keypress(function (e) {
                var key = e.which;
                if(key == 13)  // the enter key code
                {
                    $('.create_new_class_button').click();
                    return false;  
                }
            });
            $('#select_students_to_class').keypress(function (e) {
                var key = e.which;
                if(key == 13)  // the enter key code
                {
                    $('.insert_student_button').click();
                    return false;  
                }
            });

            // SETTINGS

            // PROFESSORS + STUDENTS
            $('#settings_professors_filter_status, #settings_professors_filter_approval, #settings_students_filter_status').select2();

            $("#settings_professors_start_date, #settings_students_start_date").datepicker({
                format: "dd/mm/yyyy",
                orientation: 'bottom'
            });    

            $("#settings_professors_end_date, #settings_students_end_date").datepicker({
                format: "dd/mm/yyyy",
                orientation: 'bottom'
            });

            $('#settings_professors_start_date, #settings_students_start_date').datepicker().on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });

            $("#reset-settings_professors_start_date").click(function () {
                $('#settings_professors_start_date').val("").datepicker("update");
            }); 
            $("#reset-settings_students_start_date").click(function () {
                $('#settings_students_start_date').val("").datepicker("update");
            });

            $('#settings_professors_end_date, #settings_students_end_date').datepicker().on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });

            $("#reset-settings_professors_end_date").click(function () {
                $('#settings_professors_end_date').val("").datepicker("update");
            });
            $("#reset-settings_students_end_date").click(function () {
                $('#settings_students_end_date').val("").datepicker("update");
            });

            $(document).on('click', '.professor_validation_table:not(.article_validation_table):not(.notification_validation_table) .dash_action_link a', function(e){
                e.preventDefault();

                $(this).closest(".professor_validation_table table").hide();
                $(this).closest(".professor_validation_table table").prev('.preloader.ajax')
                    .css('height', $(this).closest(".professor_validation_table table").height())
                    .show();

                var this_anchor = this;

                var user_id = $(this).attr('data-id');

                var what_to_do = '';

                if($(this).hasClass('activate_or_deactivate')){
                    var activate_or_deactivate = $(this).attr('activate_or_deactivate');
                    what_to_do = 'activate_or_deactivate';
                }
                else{
                    var validate_or_invalidate = $(this).attr('validate_or_invalidate');
                    what_to_do = 'validate_or_invalidate';
                }

                $.ajax({
                    type: 'GET',
                    url: '/activate_deactivate_user/' + user_id + '/false',
                    data: {what_to_do : what_to_do},
                    success: function(response){
                        if(response && response.status == 'success'){
                            var prof_or_student = response.prof_or_student;
                            console.log(prof_or_student, response.activate_or_deactivate);
                            if(what_to_do == 'activate_or_deactivate'){
                                if(response.activate_or_deactivate == 'deactivate'){
                                    $('.professor_validation_table.'+prof_or_student+' #'+user_id+' .payment_status.activate_or_deactivate')
                                        .removeClass('complete')
                                        .addClass('cancel')
                                        .text('Não Ativo');

                                    $(this_anchor)
                                        .removeClass('cancel')
                                        .addClass('view')
                                        .text('Ativar');
                                }
                                else{
                                    $('.professor_validation_table.'+prof_or_student+' #'+user_id+' .payment_status.activate_or_deactivate')
                                        .removeClass('cancel')
                                        .addClass('complete')
                                        .text('Ativo');

                                    $(this_anchor)
                                        .removeClass('view')
                                        .addClass('cancel')
                                        .text('Desativar');
                                }
                            }
                            else{
                                if(response.validate_or_invalidate == 'invalidate'){
                                    $('.professor_validation_table.'+prof_or_student+' #'+user_id+' .payment_status.validate_or_invalidate')
                                        .removeClass('complete')
                                        .addClass('inprogress')
                                        .text('Não');

                                    $(this_anchor)
                                        .removeClass('cancel')
                                        .addClass('view')
                                        .text('Aprovar');
                                }
                                else{
                                    $('.professor_validation_table.'+prof_or_student+' #'+user_id+' .payment_status.validate_or_invalidate')
                                        .removeClass('inprogress')
                                        .addClass('complete')
                                        .text('Sim');

                                    $(this_anchor)
                                        .removeClass('view')
                                        .addClass('cancel')
                                        .text('Desaprovar');
                                }
                            }

                            $(this_anchor).closest(".professor_validation_table table").show();
                            $(this_anchor).closest(".professor_validation_table table").prev('.preloader.ajax').hide();
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

            $(document).on('click', '#apply_filters.professors, #apply_filters.students, .pagination.professors .page-item a, .pagination.students .page-item a', function(e){
                e.preventDefault();

                var professors_or_students = '';

                if($(this).parent().hasClass('page-item')){
                    professors_or_students = $(this).parent().parent().hasClass('professors') ? 'professors' : 'students';
                }
                else{
                    professors_or_students = $(this).hasClass('professors') ? 'professors' : 'students';
                }

                var filters_expanded = $('#collapse_'+professors_or_students+'_validation_filters').hasClass('show') ? true : false;

                $('.preloader.ajax.'+professors_or_students).next("table").hide();
                $('.preloader.ajax.'+professors_or_students)
                    .css('height', $('.preloader.ajax.'+professors_or_students).next("table").height())
                    .show();

                // Pagination
                if($(this).parent().hasClass('page-item')){
                    if($(this).attr('data-page') == 1){
                        $('#previous_settings_'+professors_or_students+'_page_number').attr('value', 1);
                    }
                    else{
                        $('#previous_settings_'+professors_or_students+'_page_number').attr('value', $('#settings_'+professors_or_students+'_page_number').attr('value'));
                    }
                    
                    $('#settings_'+professors_or_students+'_page_number').attr('value', $(this).attr('data-page'));
                    
                    $('.pagination.'+professors_or_students+' li').each(function(index, element){
                        $(element).removeClass('current_page_active');
                    });
                    $(this).parent().addClass('current_page_active');
                    $("html, body").animate({ scrollTop: 0 }, 500);
                }

                var page = $('#settings_'+professors_or_students+'_page_number').attr('value');

                var data = {
                    page : page,
                    settings_professors_filter_username : $('#settings_professors_filter_username').val(),
                    settings_professors_filter_status : $('#settings_professors_filter_status').val(),
                    settings_professors_filter_approval : $('#settings_professors_filter_approval').val(),
                    settings_professors_start_date : $('#settings_professors_start_date').val(),
                    settings_professors_end_date : $('#settings_professors_end_date').val(),
                    settings_students_filter_username : $('#settings_students_filter_username').val(),
                    settings_students_filter_status : $('#settings_students_filter_status').val(),
                    settings_students_start_date : $('#settings_students_start_date').val(),
                    settings_students_end_date : $('#settings_students_end_date').val(),
                };

                var this_anchor = this;

                $.ajax({
                    type: 'GET',
                    url: '/'+professors_or_students+'_validation_filters',
                    data: data,
                    success: function(response){
                        if(response && response.status == 'success'){
                            $('#'+professors_or_students+'').html(response.html);

                            $('.preloader.ajax.'+professors_or_students).next("table").show();
                            $('.preloader.ajax.'+professors_or_students)
                                .hide();

                            if(professors_or_students == 'professors'){
                                $('.none_professors_found').text('Não foram encontrados Professores com os filtros aplicados.')
                            }
                            else{
                                $('.none_professors_found').text('Não foram encontrados Alunos com os filtros aplicados.')
                            }

                            $('#settings_'+professors_or_students+'_filter_approval').select2();
                            $('#settings_'+professors_or_students+'_filter_status').select2();

                            $('#settings_'+professors_or_students+'_start_date').datepicker({
                                format: "dd/mm/yyyy",
                                orientation: 'bottom'
                            });    

                            $('#settings_'+professors_or_students+'_end_date').datepicker({
                                format: "dd/mm/yyyy",
                                orientation: 'bottom'
                            });

                            $('#settings_'+professors_or_students+'_start_date').datepicker().on('changeDate', function (ev) {
                                $(this).datepicker('hide');
                            });

                            $('#reset-settings_'+professors_or_students+'_start_date').click(function () {
                                $('#settings_professors_start_date').val("").datepicker("update");
                            });       

                            $('#settings_'+professors_or_students+'_end_date').datepicker().on('changeDate', function (ev) {
                                $(this).datepicker('hide');
                            });

                            $('#reset-settings_'+professors_or_students+'_end_date').click(function () {
                                $('#settings_'+professors_or_students+'_end_date').val("").datepicker("update");
                            });      

                            if(filters_expanded){
                                $('.'+professors_or_students+'_validation_filters_accordion').click();
                            }
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

            // CONTENT
            /* Edit Button */
            $(document).on('click', '.edit_on_table', function(e){
                e.preventDefault();

                var to_edit = '';
                var table_row_data_id = $(this).attr('data-id');

                // Univesities
                if($(this).hasClass('edit_university')){
                    to_edit = 'university';
                }
                // Tags
                else if($(this).hasClass('edit_tag')){
                    to_edit = 'tag';
                }
                // Exercises Levels
                else if($(this).hasClass('edit_exercise_level')){
                    to_edit = 'exercise_level';
                }
                // Exercises Categories
                else if($(this).hasClass('edit_exercise_category')){
                    to_edit = 'exercise_category';
                }
                // Articles Categories
                else if($(this).hasClass('edit_article_category')){
                    to_edit = 'article_category';
                }

                // Hide span
                $('#' + to_edit + '_' + table_row_data_id + ' span.' + to_edit + '_span')
                    .hide();
                // Show input
                $('#' + to_edit + '_' + table_row_data_id + ' #' + to_edit + '_input_' + table_row_data_id)
                    .show()
                    .attr('disabled', false);

                // Hide Edit Button (Editar)
                $('#' + to_edit + '_' + table_row_data_id + ' a.edit_' + to_edit)
                    .hide();
                // Show Save Button (Guardar)
                $('#' + to_edit + '_' + table_row_data_id + ' a.save_' + to_edit)
                    .show();
            });

            /* Save Edit Content */
            $(document).on('click', '.save_on_table', function(e){
                e.preventDefault();

                $(this).closest("table").hide();
                $(this).closest("table").prev('.preloader.ajax')
                    .css('height', $(this).closest("table").height())
                    .show();

                var this_anchor = this;

                var to_save = '';
                var new_content_name = '';
                var table_row_data_id = $(this).attr('data-id');

                // Univesities
                if($(this).hasClass('save_university')){
                    to_save = 'university';
                }
                // Tags
                else if($(this).hasClass('save_tag')){
                    to_save = 'tag';
                }
                // Exercises Levels
                else if($(this).hasClass('save_exercise_level')){
                    to_save = 'exercise_level';
                }
                // Exercises Categories
                else if($(this).hasClass('save_exercise_category')){
                    to_save = 'exercise_category';
                }
                // Articles Categories
                else if($(this).hasClass('save_article_category')){
                    to_save = 'article_category';
                }

                new_content_name = $('#' + to_save + '_' + table_row_data_id + ' #' + to_save + '_input_' + table_row_data_id).val();

                var data = {
                    to_save : to_save,
                    table_row_data_id : table_row_data_id,
                    new_content_name : new_content_name
                }

                $.ajax({
                    type: 'GET',
                    url: '/save_settings_content',
                    data: data,
                    success: function(response){
                        if(response && response.status == 'success'){
                            
                            $('#collapse_'+response.content_to_refresh).html(response.html);

                            $(this_anchor).closest("table").show();
                            $(this_anchor).closest("table").prev('.preloader.ajax').hide();
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
            /* Click Save (Guardar) Button on Enter keypressed */
            $('.inputs_inside_table').keypress(function (e) {
                var key = e.which;
                if(key == 13)  // the enter key code
                {
                    $(this).parent().next('td').find('.save_on_table').click();
                    return false;  
                }
            });

            /* Save Add New Content */
            $(document).on('click', '.add_new_content_button', function(e){
                e.preventDefault();

                $(this).toggleClass('disabled');
                $(this).parent().parent().parent().next().find("table").hide();
                $(this).parent().parent().parent().next().find("table").prev('.preloader.ajax')
                    .css('height', $(this).parent().parent().parent().next().find("table").height())
                    .show();

                var this_anchor = this;

                var new_content = '';
                var new_content_name = '';

                // Univesities
                if($(this).hasClass('new_university')){
                    new_content = 'university';
                }
                // Tags
                else if($(this).hasClass('new_tag')){
                    new_content = 'tag';
                }
                // Exercises Levels
                else if($(this).hasClass('new_exercise_level')){
                    new_content = 'exercise_level';
                }
                // Exercises Categories
                else if($(this).hasClass('new_exercise_category')){
                    new_content = 'exercise_category';
                }
                // Articles Categories
                else if($(this).hasClass('new_article_category')){
                    new_content = 'article_category';
                }

                new_content_name = $('#new_content_' + new_content).val();

                if(new_content_name == ''){
                    $(this).toggleClass('disabled');
                    $(this).parent().parent().parent().next().find("table").show();
                    $(this).parent().parent().parent().next().find("table").prev('.preloader.ajax').hide();
                    $('#new_content_' + new_content).attr('value', '');
                    return false;
                }

                // reset input
                $('#new_content_' + new_content).attr('value', '');

                var data = {
                    new_content : new_content,
                    new_content_name : new_content_name
                }

                $.ajax({
                    type: 'GET',
                    url: '/save_new_settings_content',
                    data: data,
                    success: function(response){
                        if(response && response.status == 'success'){
                            
                            $('#collapse_'+response.content_to_refresh).html(response.html);

                            $(this_anchor).toggleClass('disabled');
                            $(this_anchor).parent().parent().parent().next().find("table").show();
                            $(this_anchor).parent().parent().parent().next().find("table").prev('.preloader.ajax').hide();

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
            /* Enable/Disable New Content Button on keyup */
            $('.add_new_content_input').keyup(function(e){
                if($(this).val().length > 0){
                    $(this).next('.add_new_content_button').removeClass('disabled');
                }
                else{
                    $(this).next('.add_new_content_button').addClass('disabled');
                }
            });
            /* Click New Content Button on Enter keypressed */
            $('.add_new_content_input').keypress(function (e) {
                var key = e.which;
                if(key == 13)  // the enter key code
                {
                    if($(this).val().length > 0){
                        $(this).next('.add_new_content_button').click();
                    }
                    return false;  
                }
            });

            /* Delete Content */
            $(document).on('click', '.delete_on_table', function(e){
                e.preventDefault();

                $(this).closest("table").hide();
                $(this).closest("table").prev('.preloader.ajax')
                    .css('height', $(this).closest("table").height())
                    .show();

                var this_anchor = this;

                var to_delete = '';
                var table_row_data_id = $(this).attr('data-id');

                // Univesities
                if($(this).hasClass('delete_university')){
                    to_delete = 'university';
                }
                // Tags
                else if($(this).hasClass('delete_tag')){
                    to_delete = 'tag';
                }
                // Exercises Levels
                else if($(this).hasClass('delete_exercise_level')){
                    to_delete = 'exercise_level';
                }
                // Exercises Categories
                else if($(this).hasClass('delete_exercise_category')){
                    to_delete = 'exercise_category';
                }
                // Articles Categories
                else if($(this).hasClass('delete_article_category')){
                    to_delete = 'article_category';
                }

                var data = {
                    to_delete : to_delete,
                    table_row_data_id : table_row_data_id,
                }

                $.ajax({
                    type: 'GET',
                    url: '/delete_settings_content',
                    data: data,
                    success: function(response){
                        if(response && response.status == 'success'){
                            
                            $('#collapse_'+response.content_to_refresh).html(response.html);

                            $(this_anchor).closest("table").show();
                            $(this_anchor).closest("table").prev('.preloader.ajax').hide();
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

            // LIBRARY

            $('#settings_articles_filter_article_published').select2();
            $('#settings_articles_filter_user_can_publish').select2();

            $(document).on('click', '.article_validation_table .dash_action_link a', function(e){
                e.preventDefault();

                var filters_expanded = $('#collapse_articles_validation_filters').hasClass('show') ? true : false;

                $('.preloader.ajax.articles').next("table").hide();
                $('.preloader.ajax.articles')
                    .css('height', $('.preloader.ajax.articles').next("table").height())
                    .show();

                var this_anchor_table = $(this).closest(".article_validation_table table.article");
                var this_anchor_preloader = $(this).closest(".article_validation_table table.article").prev('.preloader.ajax');

                var article_id = $(this).attr('data-id');

                var what_to_do = '';

                if($(this).hasClass('approve_article')){
                    what_to_do = 'approve_article';
                }
                else{
                    what_to_do = 'approve_user';
                }

                var page = $('#settings_articles_page_number').attr('value');

                var data = {
                    what_to_do : what_to_do,
                    inputs : {
                        page : page,
                        settings_articles_filter_article_title : $('#settings_articles_filter_article_title').val(),
                        settings_articles_filter_article_published : $('#settings_articles_filter_article_published').val(),
                        settings_articles_filter_user_username : $('#settings_articles_filter_user_username').val(),
                        settings_articles_filter_user_can_publish : $('#settings_articles_filter_user_can_publish').val()
                    }
                };

                $.ajax({
                    type: 'GET',
                    url: '/approve_articles/' + article_id,
                    data: data,
                    success: function(response){
                        if(response && response.status == 'success'){

                            $.each(response.htmls, function(key, value){
                                $('#article_id_' + response.articles_ids[key]).html(value);
                            });

                            // $('#article_id_' + article_id).html(response.html);

                            if(filters_expanded){
                                $('.articles_validation_filters_accordion').click();
                            }

                            $('.preloader.ajax.articles').next("table").show();
                            $('.preloader.ajax.articles')
                                .hide();
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

            $(document).on('click', '#apply_filters.articles, .pagination.articles .page-item a', function(e){
                e.preventDefault();

                var filters_expanded = $('#collapse_articles_validation_filters').hasClass('show') ? true : false;

                $(this).closest(".article_validation_table table").hide();
                $(this).closest(".article_validation_table table").prev('.preloader.ajax')
                    .css('height', $(this).closest(".article_validation_table table").height())
                    .show();

                // Pagination
                if($(this).parent().hasClass('page-item')){
                    if($(this).attr('data-page') == 1){
                        $('#previous_settings_articles_page_number').attr('value', 1);
                    }
                    else{
                        $('#previous_settings_articles_page_number').attr('value', $('#settings_articles_page_number').attr('value'));
                    }
                    
                    $('#settings_articles_page_number').attr('value', $(this).attr('data-page'));
                    
                    $('.pagination.articles li').each(function(index, element){
                        $(element).removeClass('current_page_active');
                    });
                    $(this).parent().addClass('current_page_active');
                    $("html, body").animate({ scrollTop: 0 }, 500);
                }

                var page = $('#settings_articles_page_number').attr('value');

                var data = {
                    page : page,
                    settings_articles_filter_article_title : $('#settings_articles_filter_article_title').val(),
                    settings_articles_filter_article_published : $('#settings_articles_filter_article_published').val(),
                    settings_articles_filter_user_username : $('#settings_articles_filter_user_username').val(),
                    settings_articles_filter_user_can_publish : $('#settings_articles_filter_user_can_publish').val()
                };

                var this_anchor = this;

                $.ajax({
                    type: 'GET',
                    url: '/articles_validation_filters',
                    data: data,
                    success: function(response){
                        if(response && response.status == 'success'){
                            $('#library').html(response.html);

                            $(this_anchor).closest(".article_validation_table table").show();
                            $(this_anchor).closest(".article_validation_table table").prev('.preloader.ajax').hide();

                            $('.none_professors_found').text('Não foram encontrados Artigos.')

                            $('#settings_articles_filter_article_published').select2();
                            $('#settings_articles_filter_user_can_publish').select2();

                            if(filters_expanded){
                                $('.articles_validation_filters_accordion').click();
                            }
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


            // NOTIFICATIONS

            $(document).on('click', '.notification_validation_table .dash_action_link a', function(e){
                e.preventDefault();

                $('.preloader.ajax.notifications').next("table").hide();
                $('.preloader.ajax.notifications')
                    .css('height', $('.preloader.ajax.notifications').next("table").height())
                    .show();

                var notification_type_id = $(this).attr('data-id');

                $.ajax({
                    type: 'GET',
                    url: '/turn_notification_types_on_off/' + notification_type_id,
                    success: function(response){
                        if(response && response.status == 'success'){

                            $('#notifications').html(response.html);

                            $('.preloader.ajax.notifications').next("table").show();
                            $('.preloader.ajax.notifications')
                                .hide();
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

        });

    </script>

@stop