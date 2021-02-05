@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}">

@stop

@section('content')

<!-- ============================ Page Title Start================================== -->
<section class="page-title articles">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <div class="wrap">
                    <h1 class="title">Exercício: “{{ $exercise->title }}”</h1>
                    
                </div>
                <div class="exercise_time wrap float-right">
                    <p class="time_label exercise_author align-self-center">
                        <strong style="font-size: 22px;">Tempo:</strong>
                    </p>
                    <div id="counterDisplay" class="time_countdown ml-2 mr-2" style="padding: 10px 15px !important;">
                    </div>
                    <input type="number" id="minutesInput" value="20" hidden/>
                    <a href="#" id="pauseButton" class="pause_time" style="padding: 10px 15px !important;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Pause_circle.svg')}}" alt="">
                    </a>
                    <a href="#" id="startButton" class="pause_time" style="padding: 10px 15px !important;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Play_circle.svg')}}" alt="">
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
                <ul class="nav nav-tabs p-2 b-0" id="perform_exercise_tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="intro-tab" data-toggle="tab" href="#intro" role="tab" aria-controls="intro" aria-selected="true">
                            <img src="{{asset('/assets/backoffice_assets/icons/File.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/File_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Introdução</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="pre-listening-tab" data-toggle="tab" href="#pre-listening" role="tab" aria-controls="pre-listening-tab" aria-selected="false">
                            <img src="{{asset('/assets/backoffice_assets/icons/Pre_Listen.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Pre_Listen_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Pré-Escuta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="listening-tab" data-toggle="tab" href="#listening" role="tab" aria-controls="listening-tab" aria-selected="false">
                            <img src="{{asset('/assets/backoffice_assets/icons/Listen.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Listen_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            À Escuta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="listening-shop-tab" data-toggle="tab" href="#listening-shop" role="tab" aria-controls="listening-shop-tab" aria-selected="false">
                            <img src="{{asset('/assets/backoffice_assets/icons/Home2.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Home2_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Oficina da Escuta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="after-listening-tab" data-toggle="tab" href="#after-listening" role="tab" aria-controls="after-listening-tab" aria-selected="false">
                            <img src="{{asset('/assets/backoffice_assets/icons/After_listen.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/After_listen_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Pós-Escuta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="evaluation-tab" data-toggle="tab" href="#evaluation" role="tab" aria-controls="evaluation" aria-selected="false">
                            <img src="{{asset('/assets/backoffice_assets/icons/Graph_Bar.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Graph_Bar_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Classificação</a>
                    </li>
                </ul>

                <div class="tab-content" id="perform_exercise_tabs_content">
                    {{-- INTRO TAB --}}
                    <div class="tab-pane fade active show" id="intro" role="tabpanel" aria-labelledby="intro-tab">

                        @include('exercises.fill_exercises.tab-contents.perform_intro')

                    </div>
                    {{-- PRE-LISTENING TAB --}}
                    <div class="tab-pane fade" id="pre-listening" role="tabpanel" aria-labelledby="pre-listening-tab">

                        @include('exercises.fill_exercises.tab-contents.perform_pre_listening', ['pre_listening_questions' => $pre_listening_questions])

                    </div>
                    {{-- LISTENING TAB --}}
                    <div class="tab-pane fade" id="listening" role="tabpanel" aria-labelledby="listening-tab">

                        @include('exercises.fill_exercises.tab-contents.perform_listening', ['listening_questions' => $listening_questions])

                    </div>
                    {{-- LISTENING SHOP TAB --}}
                    <div class="tab-pane fade" id="listening-shop" role="tabpanel" aria-labelledby="listening-shop-tab">

                        @include('exercises.fill_exercises.tab-contents.perform_listening_shop', ['listening_shop_questions' => $listening_shop_questions])

                    </div>
                    {{-- AFTER LISTENING TAB --}}
                    <div class="tab-pane fade" id="after-listening" role="tabpanel" aria-labelledby="after-listening-tab">

                        @include('exercises.fill_exercises.tab-contents.perform_after_listening', ['after_listening_questions' => $after_listening_questions])

                    </div>
                    {{-- EVALUATION TAB --}}
                    <div class="tab-pane fade" id="evaluation" role="tabpanel" aria-labelledby="evaluation-tab">

                        @include('exercises.fill_exercises.tab-contents.perform_evaluation')

                    </div>
                </div>
            </div>
        
    </div>

    {{-- EXERCISE INFO TOGGLE --}}
    <div class="card-body accordion custom_accordion info_accordion" id="accordion">
        <a class="pause_time collapsed" data-toggle="collapse" href="#collapseOne">
            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" class="show_info_button">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross_white.svg')}}" alt="" class="hide_info_button">
        </a>
        <div id="collapseOne" class="collapse" data-parent="#accordion" style="margin-left: -5px; margin-right: -5px;">
            <div class="info_help mt-3">
                <img src="{{asset('/assets/backoffice_assets/icons/help-circle.svg')}}" alt="" class="mb-1" style="width: 90%">
                Ajuda
            </div>
            <div class="info_statement mt-2">
                <img src="{{asset('/assets/backoffice_assets/icons/file-text.svg')}}" alt="" class="mb-1" style="width: 44%">
                Enunciado
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
    <script src="{{asset('/assets/js/drag-and-drop-plugin/src/draganddrop.js', config()->get('app.https'))}}"></script>
    {{-- <script src="{{asset('/assets/js/ckeditor/ckeditor.js', config()->get('app.https'))}}"></script>
    <script src="{{asset('/assets/js/ckeditor/config.js', config()->get('app.https'))}}"></script>

    <script src="{{asset('/assets/js/dropzone/dist/dropzone.js', config()->get('app.https'))}}"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/TableDnD/0.9.1/jquery.tablednd.js" integrity="sha256-d3rtug+Hg1GZPB7Y/yTcRixO/wlI78+2m08tosoRn7A=" crossorigin="anonymous"></script>

    <script>

        $(function() {

            // $('.drag_and_drop_item').draggable();

            $('.drag_and_drop_item').draggable({
                revert: true,
                scroll: true,
                placeholder: false,
                droptarget: '.drop',
                drop: function(evt, droptarget) {
                    if(!droptarget.children.length){
                        $(this).appendTo(droptarget);
                    }
                    else{
                        // droptarget.children.appendTo($(this).parent());
                        // $(this).appendTo(droptarget);
                        // console.log(droptarget);
                        // console.log($.parseHTML(droptarget), $(this));
                    }
                }
            });

            $('[id^="assortment_sentences_table_question_item_"], [id^="assortment_images_table_question_"]').sortable({
                autocreate: false,
                group: false,
                scroll: true,
                update: function(evt) {
                    $(this).sortable('serialize').forEach(element => {
                        // console.log(element.id);
                    });
                    // console.log(JSON.stringify($(this).sortable('serialize')));
                }
            });

            $('[id^="assortment_words_table_question_item_"]').sortable({
                autocreate: false,
                group: false,
                scroll: true,
                update: function(evt) {
                    var word_preview = '';
                    $(this).find('li span').each(function(index, element){
                        word_preview += $(element).text() + ' ';
                    });
                    $(this).prev('.word_preview').text(word_preview);
                }
            });

            // $('[id^="assortment_images_table_question_"]').sortable({
            //     autocreate: false,
            //     group: false,
            //     scroll: true,
            //     update: function(evt) {
            //         $(this).sortable('serialize').forEach(element => {
            //             // console.log(element.id);
            //         });
            //         // console.log(JSON.stringify($(this).sortable('serialize')));
            //     }
            // });

            // Start Exercise
            $(document).on('click', '.start_exercise, .perform_exercise_nav_button', function(e){
                // console.log($(this).attr('href'), this.hash);
                if($(this).hasClass('start_exercise')){
                    $(this).hide();
                    $('.nav-link.disabled').removeClass('disabled');
                    $('#startButton').click();
                }

                $($(this).attr('href') + "-tab").click();

                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                    e.preventDefault();

                    var hash = this.hash + '-tab';
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
                }
            });

            // Change icon image on tab change
            changeIconImage();
            function changeIconImage(){
                $('#perform_exercise_tabs a.nav-link').each(function(index, element){
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

            $(document).on('click', '#perform_exercise_tabs a.nav-link', function(){
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

            $('[id^="word_select_question_item_"]').select2();

            $('[id^="true_or_false_select_question_item_"]').select2();

            $('[id^="m_c_questions_select_question_item_"]').select2();

            $('[id^="m_c_intruder_select_question_item_"]').select2();
            
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

                $('#perform_exercise_tabs_content>.tab-pane').each(function(index, element){
                    $(element).removeClass('show');
                    $(element).removeClass('active');
                });

                var this_id = $(this).attr('id');

                $('#perform_exercise_tabs_content>.tab-pane').each(function(index, element){

                    if($(element).attr('aria-labelledby') == this_id){
                        $(element).addClass('fade');
                        $(element).addClass('show');
                        $(element).addClass('active');

                        if($(element).attr('id') == 'pre-listening'){
                            $('#perform_pre_listening_tabs .nav-link:first').trigger('click');
                        }

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