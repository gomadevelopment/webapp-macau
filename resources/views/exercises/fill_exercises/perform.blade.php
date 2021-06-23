@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}?v=1.9">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}?v=1.9">

@stop

@section('content')

@if (session('restrict_page_error'))
    <div class="global-alert alert alert-danger" role="alert">
        {{session('restrict_page_error')}}
    </div>
@endif

<input type="hidden" name="exercise_id_hidden" id="exercise_id_hidden" value="{{ $exercise->id }}">
<input type="hidden" name="exame_id" id="exame_id" value="{{ $exame->id }}">
<input type="hidden" name="exame_student_id" id="exame_student_id" value="{{ $exame->student_id }}">
<input type="hidden" name="exame_review" id="exame_review" value="{{ $exame_review }}">
<input type="hidden" name="exame_correction" id="exame_correction" value="{{ $exame_correction }}">

{{-- START OF FUNCTIONS --}}

<?php
    // differences - find_words view
    function splitSentenceIntoWords($string){
        $regex = "/[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_]+|(?!\.\d)[[:punct:]]|\s/";
        preg_match_all($regex, $string, $matches);
        return $matches[0];
    }
    if($exame_review){
        function correctOrWrong($word, $item){
            if(in_array($word, explode(', ', $item->options_correct)) && in_array($word, explode('|', $item->options_answered))){
                return 'correct';
            }
            else if(!in_array($word, explode(', ', $item->options_correct)) && in_array($word, explode('|', $item->options_answered))){
                return 'wrong';
            }
            else{
                return '';
            }
        }
    }

    // fill_options - shiffle view
    function getInbetweenStrings($str){
        $matches = array();
        $regex = "/<%\s*([\s*A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-]*[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-])\s*%>/";
        preg_match_all($regex, $str, $matches);
        return $matches[1];
    }
    function getStringInArray($string){
        $matches = array();
        $regex = "/<%\s*([\s*A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-]*[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-])\s*%>/";
        $string_array = preg_split($regex, $string);
        return $string_array;
    }

    // fill_options - words_text view
    function get_delimiters($str){
        $matches = array();
        $regex = "/<%\s*([\s*A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-]*[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-])\s*%>/";
        preg_match_all($regex, $str, $matches);
        return $matches[1];
    }
    function getStringWithSelects($string){
        $matches = array();
        $regex = "/<%\s*%>/";
        $string_array = preg_split($regex, $string);
        return $string_array;
    }

    // fill_options - writing view
    function getInbetweenStrings2($str){
        $matches = array();
        $regex = "/<%\s*([\s*A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-]*[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-])\s*%>/";
        preg_match_all($regex, $str, $matches);
        return $matches[1];
    }
    function getStringInArray2($string){
        $matches = array();
        $regex = "/<%\s*([\s*A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-]*[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-])\s*%>/";
        $string_array = preg_split($regex, $string);
        return $string_array;
    }

    // vowels view
    function getUniqueVowels($question_items){
        $unique_vowels = [];
        foreach($question_items as $item){
            for ($i = 0; $i < $item->options_number; $i++){
                $option = "options_".($i+1);
                $unique_vowels[] = $item->$option;
            }
        }
        return array_unique($unique_vowels);
    }
    function getNumberOfVowels($question_items, $vowel){
        $all_vowels = [];
        foreach($question_items as $item){
            for ($i = 0; $i < $item->options_number; $i++){
                $option = "options_".($i+1);
                $all_vowels[] = $item->$option;
            }
        }
        $counts = array_count_values($all_vowels);
        return $counts[$vowel];
    }
    function getVowelsUnderlined($str, $skip){
        $matches = array();
        $regex = "/<%\s*([\s*A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-]*[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-])\s*%>/";
        preg_match_all($regex, $str, $matches);
        $string_array = preg_split($regex, $str);
        $underlined_string = '';
        for($i = 0; $i < sizeof($string_array); $i++){
            
            if($i == (sizeof($string_array) - 1)){
                $underlined_string .= $string_array[$i];
            }
            else if($i != (sizeof($string_array) - 1)){
                if($skip == $i){
                    $underlined_string .= $string_array[$i] . '<u>' . $matches[1][$i] . '</u>';
                }
                else{
                    $underlined_string .= $string_array[$i] . $matches[1][$i];
                }
                continue;
            }
        }

        return $underlined_string;
    }

    function skipFun($str){
        $regex = "/<%\s*([\s*A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-]*[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-])\s*%>/";
        preg_match_all($regex, $str, $matches);
        return sizeof($matches[1]);
    }

?>

{{-- END OF FUNCTIONS --}}

<!-- ============================ Page Title Start================================== -->
<section class="page-title articles">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <div class="wrap">
                    <h1 class="title">Exame: “{{ $exercise->title }}”</h1>
                </div>

                <div class="exercise_time wrap float-right {{ $exame_review ? '' : 'd-none' }}">
                    @if($exame_review && !$exame_correction)
                        <div id="" class="time_countdown ml-2" style="padding: 10px 15px !important;">
                            Revisão
                        </div>
                    @elseif($exame_review && $exame_correction)
                        <form method="POST" id="finish_exame_correction_form" action="" enctype="multipart/form-data">
                            @csrf
                            <a href="#" id="finish_exame_correction" class="btn search-btn comment_submit" style="float: none; padding: 15px 25px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Check.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                <span class="pt_label button_label">Finalizar Correção</span>
                            </a>
                        </form>
                    @endif
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

                        @if($exame->medias)
                            <div class="row mb-3 under_tabs_video_card">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="card-body">

                                        <div class="row" style="place-content: center;">
                                            <div class="form-group m-2">
                                                @if($exame->medias && strpos($exame->medias->media_type, 'audio') !== false)
                                                    <audio controls="true" name="media" controlsList="nodownload" width="100%" height="100%" style="background-color: transparent;">
                                                        <source src="{{ '/webapp-macau-storage/exercises/'.$exame->exercise->id.'/medias/'. $exame->medias->media_url }}" type="{{ $exame->medias->media_type }}">
                                                        </audio>                                
                                                @elseif ($exame->medias && strpos($exame->medias->media_type, 'video') !== false)
                                                    <video controls="true" name="media" width="100%" height="100%" style="background-color: black;">
                                                        <source src="{{ '/webapp-macau-storage/exercises/'.$exame->exercise->id.'/medias/'. $exame->medias->media_url }}" type="{{ $exame->medias->media_type }}">
                                                    </video>
                                                @elseif ($exame->medias && strpos($exame->medias->media_type, 'image') !== false)
                                                    <img src="{{ '/webapp-macau-storage/exercises/'.$exame->exercise->id.'/medias/'. $exame->medias->media_url }}" alt=""
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
                        @endif

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
            {{-- <div class="info_help mt-3">
                <img src="{{asset('/assets/backoffice_assets/icons/help-circle.svg')}}" alt="" class="mb-1" style="width: 90%">
                Ajuda
            </div> --}}
            <a href="#" data-toggle="modal" data-target="#statement_modal" class="info_statement mt-2">
                <img src="{{asset('/assets/backoffice_assets/icons/file-text.svg')}}" alt="" class="mb-1" style="width: 44%">
                Enunciado
            </a>
        </div>
    </div>
</section>
<!-- ============================ Find Courses with Sidebar End ================================== -->

<!-- New Class Modal -->
<div class="modal fade" id="statement_modal" tabindex="-1" role="dialog" aria-labelledby="open_statement_modal" aria-hidden="true">
    <div class="container modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content container pr-4 pl-4" id="open_statement_modal">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true" style="background-color: #ff2850;">
                <img src="{{asset('/assets/landing_page/icons/Close.svg')}}" alt="" class="w-100">
            </span>
            <div class="modal-body page-title">
                <h4 class="modal-header-title title mb-3">Enunciado</h4>
                <div class="login-form row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <div class="d-flex float-left flex-column shop_grid_caption ml-0">
                                <div class="article_description m-0 mb-2" style="line-height: 25px; -webkit-line-clamp: unset;">
                                    @if($exame->statement)
                                        {!! $exame->statement !!}
                                    @else
                                        (Sem Enunciado)
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

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

<button class="btn search-btn comment_submit {{ !$exame_review ? 'show_video' : 'd-none' }}" style="display: none; float: none;">
    <img src="{{asset('/assets/backoffice_assets/icons/Arrow_back.svg')}}" alt="">
</button>
<button class="btn search-btn comment_submit {{ !$exame_review ? 'hide_video' : 'd-none' }}" style="float: none; -webkit-transform: scaleX(-1); transform: scaleX(-1);">
    <img src="{{asset('/assets/backoffice_assets/icons/Arrow_back.svg')}}" alt="">
</button>

@if($exercise->medias)
    <div class="{{ !$exame_review ? 'videoWrapper stuck' : 'd-none' }}">
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

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https')) }}?v=1.9"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https')) }}?v=1.9"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/exercises.js', config()->get('app.https')) }}?v=1.9"></script>
    {{-- <script src="{{asset('/assets/js/drag-and-drop-plugin/src/draganddrop.js', config()->get('app.https')) }}?v=1.9"></script> --}}
    <script src="{{asset('/assets/js/jquery-ui/jquery-ui.js', config()->get('app.https')) }}?v=1.9"></script>
    {{-- <script src="{{asset('/assets/js/ckeditor/ckeditor.js', config()->get('app.https')) }}?v=1.9"></script>
    <script src="{{asset('/assets/js/ckeditor/config.js', config()->get('app.https')) }}?v=1.9"></script>

    <script src="{{asset('/assets/js/dropzone/dist/dropzone.js', config()->get('app.https')) }}?v=1.9"></script> --}}
    <script src="{{asset('/assets/js/webapp-macau-custom-js/exercises-perform.js', config()->get('app.https')) }}?v=1.9"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/TableDnD/0.9.1/jquery.tablednd.js" integrity="sha256-d3rtug+Hg1GZPB7Y/yTcRixO/wlI78+2m08tosoRn7A=" crossorigin="anonymous"></script> --}}

    <script>
        $(function(){
            $(document).on('click', '#finish_exame_correction', function(e){
                e.preventDefault();

                // $(this).attr("id", "");

                $('[data-toggle="tooltip"]').tooltip();

                $("#perform_exercise_form").hide();
                $(".preloader.ajax").show();

                var exame_id = $('#exame_id').val();
                var exame_student_id = $('#exame_student_id').val();

                var formData = new FormData($("form#finish_exame_correction_form")[0]);

                $('[id^="free_question_correction_scores_"]').each(function(index, element){
                    formData.append(element.name, element.value);
                });

                $.ajax({
                    url: "/exercicios/corrigir/"+exame_id+"/aluno/" + exame_student_id,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $("#perform_exercise_form").show();
                        $(".preloader.ajax").hide();
                        if (response && response.status == "success") {
                            window.location = '/sala_de_aula';
                        }
                        else if (response.status == "error") {
                            $(".errorMsg").text(response.message);
                            $(".errorMsg").fadeIn();
                            setTimeout(() => {
                                $(".errorMsg").fadeOut();
                            }, 5000);
                        }
                    }
                });
            });

            $('[id^="free_question_correction_scores_"]').change(function() {
                var max = parseInt($(this).attr('max'));
                var min = parseInt($(this).attr('min'));
                if ($(this).val() > max)
                {
                    $(this).val(max);
                }
                else if ($(this).val() < min)
                {
                    $(this).val(min);
                }       
            });

            $(document).on('click', '.word_button:not(.inactive)', function(e){
                if($(this).hasClass('word_selected')){
                    $(this).removeClass('word_selected');
                    $(this).next('.word_input').attr('disabled', true);
                }
                else{
                    $(this).addClass('word_selected');
                    $(this).next('.word_input').attr('disabled', false);
                }
            });

            /* Find any element which has a 'data-onload' function and load that to simulate an onload. */
            $('[data-onload]').each(function(){
                eval($(this).data('onload'));
            });
        });
    </script>

@stop