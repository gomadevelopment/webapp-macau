@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/classroom.css', config()->get('app.https')) }}">

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
                        <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">
                            <img src="{{asset('/assets/backoffice_assets/icons/info.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/info_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Informação</a>
                    </li>
                    @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)
                    <li class="nav-item">
                        <a class="nav-link" id="classes-tab" data-toggle="tab" href="#classes" role="tab" aria-controls="classes-tab" aria-selected="false">
                            <img src="{{asset('/assets/backoffice_assets/icons/Classes_white.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Classes.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Turmas</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings-tab" aria-selected="false">
                            <img src="{{asset('/assets/backoffice_assets/icons/cog_white.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/cog.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Definições</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab" aria-controls="notifications-tab" aria-selected="false">
                            <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_white.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Notificações</a>
                    </li>
                </ul>

                <div class="tab-content" id="edit_profile_tabs_content">
                    {{-- INFO TAB --}}
                    <div class="tab-pane fade active show" id="info" role="tabpanel" aria-labelledby="info-tab">

                        @include('users.edit-tab-contents.edit_info')

                    </div>
                    {{-- professor - CLASSES TAB --}}
                    @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)
                        <div class="tab-pane fade" id="classes" role="tabpanel" aria-labelledby="classes-tab">
                            
                            
                            @include('users.edit-tab-contents.edit_classes')

                        </div>
                    @endif
                    {{-- SETTINGS TAB --}}
                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                        @include('users.edit-tab-contents.edit_settings')

                    </div>
                    {{-- NOTIFICATIONS TAB --}}
                    <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">

                        @include('users.edit-tab-contents.edit_notifications')

                    </div>
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

                var user_id = $('#hidden_user_id').val();
                var new_user_avatar = $(this)[0].files[0];
                
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
                            var new_avatar_url = '/webapp-macau-storage/avatars/' + user_id + '/' + response.avatar_url;
                            // $('.user_round_avatar').attr('src', new_avatar_url);
                            $('.user_round_avatar').css('background-image', "url("+new_avatar_url+")");
                            $('.top_nav_bar_avatar').css('background-image', "url("+new_avatar_url+")");
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

        });

    </script>

@stop