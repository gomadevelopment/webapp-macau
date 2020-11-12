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

            $(document).on('click', '#edit_profile_tabs a.nav-link', function(){
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

            $('#tags').select2({
                placeholder: "Pesquisar"
            });

            $('#fill_time').select2({
                placeholder: "Sel. Tempo"
            });

            $('#interruption_time').select2({
                placeholder: "Sel. Tempo"
            });

            $('#verbs_select_1').select2();

            $('#verbs_select_2').select2();

            $('#select_school_name').select2();

            // DRAG AND DROP
            var $draggedItem;

            $('.drag_and_drop_item').on('dragstart', dragging);
            $('.drag_and_drop_item').on('dragend', draggingEnded);

            $('.drag_and_drop_hole').on('dragenter', preventDefault);
            $('.drag_and_drop_hole').on('dragover', preventDefault);
            $('.drag_and_drop_hole').on('drop', dropItem);

            function dragging(e) {
                $(e.target).addClass('dragging');
                $draggedItem = $(e.target);
            }

            function draggingEnded(e) {
                $(e.target).removeClass('dragging');
            }

            function preventDefault(e) {
                e.preventDefault();
            }

            function dropItem(e) {
                var hole = $(e.target);
                if (hole.hasClass('drag_and_drop_hole') && hole.children().length === 0) {
                    $draggedItem.detach();
                    $draggedItem.appendTo(hole);
                    if(hole.hasClass('origin_hole')){
                        $draggedItem.removeClass('item_dragged');
                    }
                    else{
                        $draggedItem.addClass('item_dragged');
                    }
                }
            }

            //Global:
            var survey = []; //Bidimensional array: [ [1,3], [2,4] ]

            //Switcher function:
            $(".rb-tab").click(function(){
                //Spot switcher:
                $(this).parent().find(".rb-tab").removeClass("rb-tab-active");
                $(this).addClass("rb-tab-active");
            });

            //Save data:
            $(".trigger").click(function(){
                //Empty array:
                survey = [];
                //Push data:
                for (i=1; i<=$(".rb").length; i++) {
                    var rb = "rb" + i;
                    var rbValue = parseInt($("#rb-"+i).find(".rb-tab-active").attr("data-value"));
                    //Bidimensional array push:
                    survey.push([i, rbValue]); //Bidimensional array: [ [1,3], [2,4] ]
                };
                //Debug:
                debug();
            });

            //Debug:
            function debug(){
                var debug = "";
                for (i=0; i<survey.length; i++) {
                    debug += "Nº " + survey[i][0] + " = " + survey[i][1] + "\n";
                };
                alert(debug);
            };

            $(document).on('click', '#perform_exercise_tabs .nav-link', function(){

                $('#perform_exercise_tabs_content .tab-pane').each(function(index, element){
                    $(element).removeClass('show');
                    $(element).removeClass('active');
                });

                var this_id = $(this).attr('id');

                $('#perform_exercise_tabs_content .tab-pane').each(function(index, element){

                    if($(element).attr('aria-labelledby') == this_id){
                        $(element).addClass('fade');
                        $(element).addClass('show');
                        $(element).addClass('active');

                        if($(element).attr('id') == 'listening'){
                            $('#perform_listening_tabs .nav-link:first').trigger('click');
                        }

                        if($(element).attr('id') == 'listening-shop'){
                            $('#perform_listening_shop_tabs .nav-link:first').trigger('click');
                        }
                    }
                });
            });

        });

    </script>

@stop