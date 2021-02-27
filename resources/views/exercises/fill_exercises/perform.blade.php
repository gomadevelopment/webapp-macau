@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}">

@stop

@section('content')

<input type="hidden" name="exercise_id_hidden" id="exercise_id_hidden" value="{{ $exercise->id }}">
<input type="hidden" name="exame_id" id="exame_id" value="{{ $exame->id }}">
<input type="hidden" name="exame_review" id="exame_review" value="{{ $exame_review }}">

<!-- ============================ Page Title Start================================== -->
<section class="page-title articles">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <div class="wrap">
                    <h1 class="title">Exame: “{{ $exercise->title }}”</h1>
                </div>

                <div class="exercise_time wrap float-right {{ $exame_review ? '' : 'd-none' }}">
                    <div id="" class="time_countdown ml-2" style="padding: 10px 15px !important;">
                        Revisão
                    </div>
                </div>

                <div class="exercise_time wrap float-right {{ !$exercise->has_time || $exame_review ? 'd-none' : '' }}">
                    <p class="time_label exercise_author align-self-center">
                        <strong style="font-size: 22px;">Tempo:</strong>
                    </p>
                    <div id="counterDisplay" class="time_countdown ml-2" style="padding: 10px 15px !important;">
                    </div>
                    <input type="text" id="minutesInput" value="{{ !$exercise->has_time ? '' : $time_left }}" hidden/>

                    <a href="#" data-toggle="modal" data-target="#pause_modal" data-backdrop='static' data-keyboard='false'
                        id="pauseButton" class="pause_time ml-2 {{ !$exercise->has_interruption ? 'no_interruption_time' : '' }}" style="padding: 10px 15px !important;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Pause_circle.svg')}}" alt="">
                    </a>
                    <a href="#" id="startButton" class="pause_time ml-2 {{ !$exercise->has_interruption ? 'no_interruption_time' : '' }}" style="padding: 10px 15px !important;">
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
                        <a class="nav-link" id="pre-listening-tab" data-toggle="tab" href="#pre-listening" role="tab" aria-controls="pre-listening-tab" aria-selected="false">
                            <img src="{{asset('/assets/backoffice_assets/icons/Pre_Listen.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Pre_Listen_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Pré-Escuta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="listening-tab" data-toggle="tab" href="#listening" role="tab" aria-controls="listening-tab" aria-selected="false">
                            <img src="{{asset('/assets/backoffice_assets/icons/Listen.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Listen_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            À Escuta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="listening-shop-tab" data-toggle="tab" href="#listening-shop" role="tab" aria-controls="listening-shop-tab" aria-selected="false">
                            <img src="{{asset('/assets/backoffice_assets/icons/Home2.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Home2_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Oficina da Escuta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="after-listening-tab" data-toggle="tab" href="#after-listening" role="tab" aria-controls="after-listening-tab" aria-selected="false">
                            <img src="{{asset('/assets/backoffice_assets/icons/After_listen.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/After_listen_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Pós-Escuta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="evaluation-tab" data-toggle="tab" href="#evaluation" role="tab" aria-controls="evaluation" aria-selected="false">
                            <img src="{{asset('/assets/backoffice_assets/icons/Graph_Bar.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Graph_Bar_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Classificação</a>
                    </li>
                </ul>

                <div class="preloader ajax col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="height: 500px !important; margin: auto !important;"><span></span><span></span></div>

                <form method="POST" id="perform_exercise_form" action="" enctype="multipart/form-data">
                    @csrf

                    <div class="tab-content" id="perform_exercise_tabs_content">

                        @if (session('success'))
                            <div class="global-alert alert alert-success" role="alert">
                                {{session('success')}}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="global-alert alert alert-danger" role="alert">
                                {{session('error')}}
                            </div>
                        @endif

                        <div class="row mb-3 under_tabs_video_card">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="card-body">

                                    <div class="row" style="place-content: center;">
                                        <div class="form-group m-2">
                                            @if($exame->medias && strpos($exame->medias->media_type, 'audio') !== false)
                                                <audio controls="true" name="media" controlsList="nodownload" width="100%" height="100%" style="background-color: transparent;">
                                                    <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/medias/'. $exame->medias->media_url }}" type="{{ $exame->medias->media_type }}">
                                                    </audio>                                
                                            @elseif ($exame->medias && strpos($exame->medias->media_type, 'video') !== false)
                                                <video controls="true" name="media" width="100%" height="100%" style="background-color: black;">
                                                    <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/medias/'. $exame->medias->media_url }}" type="{{ $exame->medias->media_type }}">
                                                </video>
                                            @elseif ($exame->medias && strpos($exame->medias->media_type, 'image') !== false)
                                                <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/medias/'. $exame->medias->media_url }}" alt=""
                                                style="height: -webkit-fill-available;">
                                            @endif
                                            {{-- <video controls="true" name="media" width="100%" height="100%" style="background-color: black;">
                                                <source src="{{asset('/assets/backoffice_assets/videos/dummy_video.mp4')}}" type="video/mp4">
                                            </video> --}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

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
                
                </form>

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

{{-- PAUSE MODAL --}}
<!-- Log In Modal -->
<div class="modal fade" id="pause_modal" tabindex="-1" role="dialog" aria-labelledby="pausemodal" aria-hidden="true">
    <div class="container modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="pausemodal">
            <div class="modal-body card-body">
                <label class="label_title d-block text-center mt-3" style="font-size: 37px;">
                    Exercício em Pausa
                </label>
                <label class="label_title d-block mt-5 text-center">
                    Colocou o exercício 
                    “{{ $exercise->title }}” 
                    em pausa.
                </label>
                <hr class="mb-5" style="margin-top: 2.5rem;">
                <label class="label_title d-block text-center mt-5 pause_counter_modal" style="font-size: 54px;">
                    {{-- 00:14:27 --}}
                    {{ $exercise->interruption_time < 10 ? '0' . $exercise->interruption_time . ':00' : $exercise->interruption_time . ':00' }}
                </label>
                <input type="hidden" name="pause_countdown" id="pause_countdown" value="{{ $exercise->interruption_time < 10 ? '0' . $exercise->interruption_time . ':00' : $exercise->interruption_time . ':00' }}"/>
                <div class="d-block text-center" style="margin: 2rem 0 !important;">
                    <a href="#" class="btn search-btn comment_submit m-2 unpause_exercise_modal_button" style="float: none; padding: 15px 25px;">
                        Retomar
                        <img src="{{asset('/assets/backoffice_assets/icons/Turn_back.svg')}}" alt="" style="margin-left: 5px; margin-bottom: 2px;">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<button class="btn search-btn comment_submit show_video" style="display: none; float: none;">
    <img src="{{asset('/assets/backoffice_assets/icons/Arrow_back.svg')}}" alt="">
</button>
<button class="btn search-btn comment_submit hide_video" style="float: none; -webkit-transform: scaleX(-1); transform: scaleX(-1);">
    <img src="{{asset('/assets/backoffice_assets/icons/Arrow_back.svg')}}" alt="">
</button>

@if($exercise->medias)
    <div class="videoWrapper stuck">
        <div>
            <video controls="true" autoplay="false" name="media" width="100%" height="240px" style="background-color: black;">
                <source src="{{ '/webapp-macau-storage/exercises/'.$exercise->id.'/medias/'.$exercise->medias->media_url }}" 
                    type="{{ $exercise->medias->media_type }}">
            </video>
        </div>
    </div>
@endif

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

            $(document).on('click', '#finish_exercise_button', function(e){
                // Deactivate finish_exercise_button
                $(this).attr('id', '');

                $("#perform_exercise_form").hide();
                $('.preloader.ajax').show();
                $('html, body').animate({scrollTop: '0px'}, 300);

                var exercise_id = $('#exercise_id_hidden').val();
                var exame_id = $('#exame_id').val();

                var formData = new FormData($('form#perform_exercise_form')[0]);
                formData.append('exame_id', exame_id);

                // Inquiries
                var inquiries = new Array();
                $('.rb').each(function(index, element){
                    var inquiry_id = $(element).attr('data-id');
                    var data_value = $(element).find('.rb-tab-active').attr('data-value');
                    inquiries[inquiry_id] = data_value;
                });

                for (var key in inquiries) {
                    formData.append('inquiries['+key+']', inquiries[key]);
                }

                $.ajax({
                    url: '/exercicios/realizar/' + exercise_id,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $("#perform_exercise_form").show();
                        $('.preloader.ajax').hide();
                        if(response && response.status == 'success'){

                            if(response.teacher_correction){
                                $('#score_label').text('Nota Provisória: ');
                                $('#score_percentage').addClass('exercise_awaiting').text(response.score + '%');
                            }
                            else{
                                $('#score_label').text('Nota: ');

                                if(response.score < 33.3){
                                    $('#score_percentage').addClass('low_score').text(response.score + '%');
                                }
                                else if(response.score >= 33.3 && response.score < 66.6){
                                    $('#score_percentage').addClass('med_score').text(response.score + '%');
                                }
                                else{
                                    $('#score_percentage').addClass('high_score').text(response.score + '%');
                                }
                            }
                            $('#conclusion_date_label').text(response.conclusion_time);

                        }
                        else if(response.status == 'error'){
                            $('#score_percentage').remove();
                            $('#score_label').text('Ocorreu um erro ao submeter o seu exame. Por favor, contacte um professor.');
                            $('#conclusion_date_label').text(response.conclusion_time);
                        }

                        $('#perform_exercise_tabs .nav-link').addClass('disabled');
                        $('.nav-link#evaluation-tab').removeClass('disabled').addClass('finished');
                        $('#evaluation-tab').show();
                        $('#pauseButton').attr('data-toggle', '');
                        $('#pauseButton').attr('data-target', '');
                        $('#pauseButton').click();
                        $('#pauseButton').hide();
                        $('#startButton').hide();
                        $('#accordion').hide();

                        $('#evaluation-tab').click();

                        // var offset_disc = $(".header").height() + 10;

                        // if ($(window).width() < 992) {
                        //     offset_disc = 0;
                        // }

                        // $("html, body").animate(
                        //     {
                        //         scrollTop: $('#evaluation').offset().top - offset_disc
                        //     },
                        //     800
                        // );
                    }
                });
            });

            // /exercicios/realizar/update_pause_timer/{exame_id}

            $(document).on('click', '#pauseButton, #startButton', function(){
                if($(this).attr('data-target') == ''){
                    return false;
                }
                var exame_id = $('#exame_id').val();
                var to_update = '';
                var dt = new Date();
                var date = dt.getUTCFullYear() + "-" + ((dt.getUTCMonth()+1) < 10 ? "0" + (dt.getUTCMonth()+1) : (dt.getUTCMonth()+1)) + "-" + (dt.getUTCDate() < 10 ? "0"+dt.getUTCDate() : dt.getUTCDate()) + " ";
                var time = dt.getHours() + ":" + dt.getMinutes() + ":" + (dt.getSeconds() < 10 ? '0' + dt.getSeconds() : dt.getSeconds());
                var to_update_timestamp = date + time;
                if($(this).attr('id') == 'pauseButton'){
                    to_update = 'pause_start';
                }
                else if($(this).attr('id') == 'startButton'){
                    to_update = 'pause_end';
                }
                $.ajax({
                    url: '/exercicios/realizar/update_pause_timer/' + exame_id,
                    type: "GET",
                    data: {to_update:to_update, to_update_timestamp:to_update_timestamp},
                    success: function (response) {
                        if(response && response.status == 'success'){
                        }
                        else if(response.status == 'error'){
                        }
                    }
                });
            });

            // $('.drag_and_drop_item').draggable();

            if($('#exame_review').val() == false){

                $('.drag_and_drop_item').draggable({
                    revert: true,
                    scroll: true,
                    placeholder: false,
                    droptarget: '.drop',
                    drop: function(evt, droptarget) {
                        // console.log('Vou fazer DROPPP!!');
                        if(!droptarget.children.length){
                            $(this).appendTo(droptarget);
                            var test = $(this);
                            // Correspondence
                            if($(this).hasClass('correspondence_items')){
                                $('input.correspondence_d_and_d').each(function(index, element){
                                    // console.log($(element));
                                    // Images and Audios
                                    if($(element).next('.drag_and_drop_hole').length){
                                        // console.log($(element).find('input').val(), $(element.attr('class')));
                                        if($.trim($(element).next('.drag_and_drop_hole').html())==''){
                                            $(element).val(null);
                                        }
                                        else{
                                            $(element).val($(element).next('.drag_and_drop_hole').find('input').val());
                                        }
                                    }
                                    // Categories
                                    else{
                                        $(element).next('div').each(function(index2, element2){
                                            if($.trim($(element2).find('.drag_and_drop_hole').html())==''){
                                                $(element).val(null);
                                            }
                                            else{
                                                $(element).val($(element2).find('.drag_and_drop_hole').find('input').val());
                                            }
                                        });
                                    }
                                });
                            }
                            // Fill Options - Shuffle
                            else if($(this).hasClass('fill_options_shuffle_items')){
                                $('input.fill_options_d_and_d').each(function(index, element){
                                    if($.trim($(element).next('.drag_and_drop_hole').html())==''){
                                        $(element).val(null);
                                    }
                                    else{
                                        $(element).val($(element).next('.drag_and_drop_hole').find('input').val());
                                    }
                                });
                            }
                            // True or False
                            else if($(this).hasClass('true_or_false_items')){
                                $('input.true_or_false_d_and_d').each(function(index, element){
                                    if($.trim($(element).next('.drag_and_drop_hole').html())==''){
                                        $(element).val(null);
                                    }
                                    else{
                                        $(element).val($(element).next('.drag_and_drop_hole').find('input').val());
                                    }
                                });
                            }
                            // Correspondence
                            else if($(this).hasClass('vowels_items')){
                                $('input.vowels_d_and_d').each(function(index, element){
                                    $(element).next('div').each(function(index2, element2){
                                        if($.trim($(element2).find('.drag_and_drop_hole').html())==''){
                                            $(element).val(null);
                                        }
                                        else{
                                            $(element).val($(element2).find('.drag_and_drop_hole').find('input').val());
                                        }
                                    });
                                });
                            }
                        }
                        else{
                            // droptarget.children.appendTo($(this).parent());
                            // $(this).appendTo(droptarget);
                            // console.log(droptarget);
                            // console.log($.parseHTML(droptarget), $(this));
                        }
                        // console.log('Vou fazer STOOPPP');
                        $("html, body").stop();
                        // $("html, body").trigger('mousemove');
                        // return false;
                    }
                });

                $('[id^="assortment_sentences_table_question_item_"], [id^="assortment_images_table_question_"]').sortable({
                    autocreate: false,
                    group: false,
                    scroll: true,
                    update: function(evt) {
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
                
            }
            else{
                $('.drag_and_drop_item').css('cursor', 'default');
                $('[id^="assortment_sentences_table_question_item_"], [id^="assortment_images_table_question_"], [id^="assortment_words_table_question_item_"]').find('li').css('cursor', 'default');
                $('[id^="exame_review_assortment_sentences_table_question_item_"], [id^="exame_review_assortment_images_table_question_"], [id^="exame_review_assortment_words_table_question_item_"]').find('li').css('cursor', 'default');
            }

            // $('html, body').click(function(){
            //     console.log('CLICK');
            //     if($('.draggable_clone').length){
            //         if(!$('button.hide_video').is(":hidden") && !$('button.hide_video').hasClass('drag_hidden')){
            //             $('button.hide_video').addClass('drag_hidden').click();
            //         }
            //     }
            // });

            $(document).on("mousemove", function(event) {
                // $("html, body").stop();
                // console.log($('.draggable_clone').length);
                if(!$('.draggable_clone').length){
                    // console.log('ACABOU O DRAGG!!');
                    $("html, body").stop();
                    // return false;
                }

                if($('.draggable_clone').length){
                    // Close video on dragging
                    if(!$('button.hide_video').is(":hidden") && !$('button.hide_video').hasClass('drag_hidden')){
                        // $('button.hide_video').click().addClass('drag_hidden');
                        $('button.hide_video').hide().addClass('drag_hidden');
                        $('button.show_video').show();
                        $('.videoWrapper video').trigger('pause');
                        $('.videoWrapper').hide().removeClass('stuck');
                        // return false;
                    }
                    // $("html, body").stop();
                    // SCROLL TOP
                    if((event.pageY - window.pageYOffset) < 100){
                        // console.log('SCROLL TOP');
                        // $("html, body").stop();
                        $('html, body').animate({scrollTop:0}, 3000);
                        // return false;
                    }

                    // SCROLL BOTTOM
                    else if((event.pageY - window.pageYOffset) > ($(window).height() - 30)){
                        // console.log('SCROLL BOTTOM');
                        // $("html, body").stop();
                        $("html, body").animate({ scrollTop: $(document).height()-$(window).height() }, 3000);
                        // return false;
                    }

                    else {
                        // console.log('VOU parar no meio!!!');
                        $("html, body").stop();
                        // return false;
                    }
                }
            });

            // Start Exercise
            $(document).on('click', '.start_exercise, .perform_exercise_nav_button', function(e){

                // if(this.hash == "#evaluation"){
                //     $('.nav-link').addClass('disabled');
                //     $('.nav-link#evaluation-tab').removeClass('disabled').addClass('finished');
                //     $('#evaluation-tab').show();
                //     $('#pauseButton').attr('data-toggle', '');
                //     $('#pauseButton').attr('data-target', '');
                //     $('#pauseButton').click();
                //     $('#pauseButton').hide();
                //     $('#startButton').hide();
                //     $('#accordion').hide();
                // }

                if($(this).hasClass('start_exercise')){
                    $(this).hide();
                    // $('.nav-link.disabled').removeClass('disabled');
                    $('#evaluation-tab').hide();
                    $('#startButton').click();
                }
                else{
                    $($(this).attr('href') + "-tab").click();
                }

                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "" && !$(this).hasClass('start_exercise')) {
                    e.preventDefault();

                    var hash = this.hash !== "#quiz-div" ? this.hash + '-tab' : this.hash;

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

            $('.start_exercise').click();
            $('.start_exercise').hide();

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
                placeholder: "Escolher tema"
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

            $('[id^="word_select_question_item_"]').select2({
                placeholder: 'Escolher...'
            });
            $('[id^="exame_review_word_select_question_item_"]').select2({
                placeholder: 'Escolher...'
            });

            $('[id^="true_or_false_select_question_item_"]').select2({
                placeholder: 'Escolher...'
            });
            $('[id^="exame_review_true_or_false_select_question_item_"]').select2({
                placeholder: 'Escolher...'
            });

            $('[id^="m_c_questions_select_question_item_"]').select2({
                placeholder: 'Escolher...'
            });
            $('[id^="exame_review_m_c_questions_select_question_item_"]').select2({
                placeholder: 'Escolher...'
            });

            $('[id^="m_c_intruder_select_question_item_"]').select2({
                placeholder: 'Escolher...'
            });
            $('[id^="exame_review_m_c_intruder_select_question_item_"]').select2({
                placeholder: 'Escolher...'
            });

            $(".rb-tab").click(function(){
                if($('#exame_review').val() == false){
                    $(this).parent().find(".rb-tab").removeClass("rb-tab-active");
                    $(this).addClass("rb-tab-active");
                }
            });

            $('.under_tabs_video_card').hide();

            $(document).on('click', '#perform_exercise_tabs .nav-link', function(){

                if($(this).attr('id') == "intro-tab" || $(this).attr('id') == "pre-listening-tab" || $(this).attr('id') == "evaluation-tab"){
                    $('.under_tabs_video_card').hide();
                }
                else{
                    $('.under_tabs_video_card').show();
                }

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

            // Button show/hide video
            $('.videoWrapper video').trigger('pause');
            
            $(document).on('click', 'button.show_video, button.hide_video', function(){
                if($(this).hasClass('show_video')){
                    $(this).hide();
                    $('button.hide_video').show();
                    // $('.videoWrapper video').trigger('play');
                    $('.videoWrapper').show().addClass('stuck');
                    $('.videoWrapper').show().addClass('stuck');
                    if(!$('.videoWrapper').hasClass('was_opened')){
                        $('.videoWrapper').addClass('was_opened');
                    }
                }
                else{
                    $(this).hide();
                    $('button.show_video').show();
                    $('.videoWrapper video').trigger('pause');
                    $('.videoWrapper').hide().removeClass('stuck');
                }

            });

            $('button.hide_video').click();

            $('.videoWrapper video').on('play', function(){
                $('.under_tabs_video_card video').trigger('pause');
            });

            $('.under_tabs_video_card video').on('play', function(){
                $('.videoWrapper video').trigger('pause');
            });

            /*Floating js Start*/
            var windows = jQuery(window);
            var iframeWrap = jQuery(this).parent();
            var iframe = jQuery(this);
            var iframeHeight = iframe.outerHeight();
            var iframeElement = iframe.get(0);

            iframeWrap.height(iframeHeight);
            iframe.addClass('stuck');

            windows.on('scroll', function() {
                // console.log($(this).scrollTop());
                if($(this).scrollTop() >= 900){
                    if(!$('.videoWrapper').hasClass('was_opened')){
                        $('button.show_video').click();
                    }
                }
                iframeWrap.height(iframeHeight);
                iframe.addClass('stuck');
            });
            /*Floating js End*/

        });

    </script>

@stop