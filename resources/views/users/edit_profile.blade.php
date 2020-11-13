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
                    <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px;">
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
                    @if(auth()->user()->role == 1 || auth()->user()->role == 2)
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
                    @if(auth()->user()->role == 1 || auth()->user()->role == 2)
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

        // CKEDITOR.replace( 'intro_text' , {
        //     language: 'pt'
        // });

        // CKEDITOR.replace( 'statement' , {
        //     language: 'pt'
        // });

        // CKEDITOR.replace( 'audio_visual_description' , {
        //     language: 'pt'
        // });

        // CKEDITOR.replace( 'audio_transcription' , {
        //     language: 'pt'
        // });

        $(function() {

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


            // changeDotsIcons('.classes_student_dropdown a');
            function changeDotsIcons(selector){
                if($(selector).parent().hasClass('show')){
                    $(selector).find('img.filled_dots').hide();
                    $(selector).find('img.empty_dots').show();
                    // hideAllDotIcons();
                }
                else if(!$(selector).parent().hasClass('show')){
                    $(selector).find('img.filled_dots').show();
                    $(selector).find('img.empty_dots').hide();
                }
            }

            $('.classes_student_dropdown a').on('click', function(){
                // hideAllDotIcons();
                changeDotsIcons(this);
            });

            $('html, body').on('click', function(){
                $('.classes_student_dropdown a').find('img.filled_dots').hide();
                $('.classes_student_dropdown a').find('img.empty_dots').show();
            });

        });

    </script>

@stop