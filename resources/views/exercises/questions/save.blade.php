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
            <div class="col-lg-12 col-md-12 d-flex align-items-center">
                <a href="javascript:history.back()" class="btn search-btn comment_submit mr-5" style="float: none; padding: 10px 15px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Arrow_back.svg')}}" alt=""></a>
                <div class="wrap d-inline-block">
                    <h1 class="title mb-0">Pré-Escuta / Visionamento</h1>
                    <p class="sub_title m-0">Do Exercício: “De Áustria para Portugal”</p>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- ============================ Page Title End ================================== -->	

<!-- ============================ Find Courses with Sidebar ================================== -->
<section class="pt-0 create_question">
    <div class="container">

        {{-- CREATED CARDS --}}
        <div class="row mb-5">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card-body">
                    <div class="form-group">
                        <label class="label_title mb-4 d-block">
                            Fronteira da Palavra</label>
                        <div class="d-flex float-left flex-column">
                            <p class="exercise_level m-0"><strong>Tipo:</strong> Preenchimento</p>
                            <p class="exercise_level m-0"><strong>Referência:</strong> Texto para ajudar a identificar a Questão</p>
                            <p class="exercise_level m-0"><strong>Autor:</strong> Professor João Paulo</p>
                        </div>
                        <div class="d-block float-right mt-3">
                            <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Pencil.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Editar
                            </a>
                            <a href="#" class="btn btn-theme remove_button" style="float: none; padding: 14px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 5px;">
                                Remover
                            </a>
                            <a href="#" class="btn btn-theme clone_button" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/clone.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Clonar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CREATE NEW CARD --}}
        <div class="row mb-5">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card-body">
                    {{-- Templates --}}
                    <div class="form-group">
                        <label class="label_title mb-2" style="font-size: 30px;">
                            Meus Modelos</label>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-4 mt-2 mb-2">
                                <select name="question_template" id="question_template" class="form-control">
                                    <option value=""></option>
                                    <option value="1">Modelo A</option>
                                    <option value="2">Modelo B</option>
                                    <option value="3">Modelo C</option>
                                </select>
                            </div>
                            {{-- <div class="col-sm-12 col-md-6 col-lg-8 mt-2 mb-2">
                                <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 16px 15px;">
                                    Ver todos os Modelos</a>
                            </div> --}}
                        </div>
                    </div>

                    <hr class="mt-4 mb-5">
                    {{-- Criar Novo --}}
                    <div class="form-group">
                        <label class="label_title mb-2" style="font-size: 30px;">
                            Criar Novo <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                        <div class="row mb-1">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-2 mb-2">
                                <input name="question_name" id="question_name" type="text" class="form-control" placeholder="Título da questão">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mt-2 mb-2">
                                <select name="question_type" id="question_type" class="form-control">
                                    <option value=""></option>
                                    <option value="1">Associar Medias</option>
                                    <option value="2">Correspondência e Escolha Múltipla</option>
                                    <option value="3">Preenchimento</option>
                                </select>
                            </div>
                            <div class="col-xs-0 col-sm-0 col-md-0 col-lg-2"></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input name="question_description" id="question_description" type="text" class="form-control" placeholder="Descrição da questão">
                            </div>
                        </div>
                    </div>

                    <hr class="mt-5 mb-4">

                    {{-- QUESTION HERE --}}

                    <div class="choose_question_type">
                        <p class="exercise_level float-none m-0"><strong>Escolha o tipo de questão!</strong></p>
                    </div>

                    @include('exercises.questions.types.associate_media')

                    @include('exercises.questions.types.corr_expressions')

                    @include('exercises.questions.types.fill_split')

                    <hr class="mt-4 mb-5">

                    {{-- Correção --}}
                    <div class="form-group">
                        <label class="label_title mb-3" style="font-size: 30px;">
                            Correção <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input id="correction_required" class="checkbox-custom" name="correction_required" type="checkbox">
                                <label for="correction_required" class="checkbox-custom-label d-inline-block">Requer correção do Professor</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input name="question_reference" id="question_reference" type="text" class="form-control" placeholder="Referência sobre o tipo de questão">
                            </div>
                        </div>
                    </div>

                    <hr class="mt-5 mb-5">
                    {{-- Avaliação --}}
                    <div class="form-group">
                        <label class="label_title mb-3" style="font-size: 30px;">
                            Avaliação</label>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label class="label_title" style="font-size: 16px;">
                                    Pontuação <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                                
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <select name="question_score" id="question_score" class="form-control">
                                    <option value=""></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="60">60</option>
                                    <option value="70">70</option>
                                    <option value="80">80</option>
                                    <option value="90">90</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="" class="btn search-btn comment_submit m-3" style="float: none;">
                            Gravar <img src="{{asset('/assets/backoffice_assets/icons/save.svg')}}" alt="" style="margin-left: 10px;"></button>
                        {{-- <input id="save_as_template" class="checkbox-custom" name="save_as_template" type="checkbox">
                        <label for="save_as_template" class="checkbox-custom-label d-inline-block">Gravar como Template</label> --}}
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <a href="#" class="btn search-btn comment_submit m-3" style="font-size: 21px; float: none;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                    Criar Questão
                </a>
            </div>
        </div>

        <button class="btn search-btn comment_submit show_video" style="display: none; float: none;">
            <img src="{{asset('/assets/backoffice_assets/icons/Arrow_back.svg')}}" alt="">
        </button>
        <button class="btn search-btn comment_submit hide_video" style="float: none; -webkit-transform: scaleX(-1); transform: scaleX(-1);">
            <img src="{{asset('/assets/backoffice_assets/icons/Arrow_back.svg')}}" alt="">
        </button>


        <div class="videoWrapper stuck">
            <div>
                {{-- <span class="close-videoWrapper" style="float: right; cursor: pointer;">x</span> --}}
                {{-- <iframe width="100%" height="240px" style="background-color: black;"
                    src="http://techslides.com/demos/sample-videos/small.mp4">
                </iframe> --}}
                <video controls="true" autoplay="false" name="media" width="100%" height="240px" style="background-color: black;">
                    <source src="{{asset('/assets/backoffice_assets/videos/dummy_video.mp4')}}" type="video/mp4">
                </video>
            </div>
        </div>

    </div>
</section>

{{-- CLONES --}}


{{-- END CLONES --}}

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

            var count = 3;

            CKEDITOR.replace( 'fill_textarea' , {
                language: 'pt'
            });

            $('#question_template').select2({
                placeholder: "Escolher Modelo"
            });

            $('#question_type').select2({
                placeholder: "Escolher tipo de questão"
            });

            $('#question_score').select2({
                placeholder: "Pontuação da Pergunta"
            });

            $('#corr_exp_select_0, #corr_exp_select_1, #corr_exp_select_2').select2({
                placeholder: "Escolher opção"
            });

            $('#fill_time').select2({
                placeholder: "Sel. Tempo"
            });

            $('#interruption_time').select2({
                placeholder: "Sel. Tempo"
            });

            // Button show/hide video
            // $('.videoWrapper video').trigger('play');
            $(document).on('click', 'button.show_video, button.hide_video', function(){
                if($(this).hasClass('show_video')){
                    $(this).hide();
                    $('button.hide_video').show();
                    // $('.videoWrapper video').trigger('play');
                    $('.videoWrapper').show().addClass('stuck');
                }
                else{
                    $(this).hide();
                    $('button.show_video').show();
                    // $('.videoWrapper video').trigger('pause');
                    $('.videoWrapper').hide().removeClass('stuck');
                }

            });

            // Buttons add clones
            $(document).on('click', '.button_add_media', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_media_clone').children().clone();

                $(paste_before).append(html);
                
            });

            $(document).on('click', '.button_add_corr_exp', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_corr_expr_clone').children().clone();

                html.find('select#corr_exp_select')
                    .attr('id','corr_exp_select_' + count)
                    .select2({
                        placeholder: "Escolher opção"
                    });

                count++;

                $(paste_before).append(html);
                
            });

            $(document).on('click', '.button_add_fill', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_fill_clone').children().clone();

                html.find('textarea#fill_textarea')
                    .attr('id','fill_textarea_' + count);

                $(paste_before).append(html);

                CKEDITOR.replace( 'fill_textarea_' + count , {
                    language: 'pt'
                });

                count++;
                
            });

            $(document).on('click', '.button_add_split', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_split_clone').children().clone();

                $(paste_before).append(html);
                
            });

            // Button remove clone/row
            $(document).on('click', '.remove_button.remove_row', function(e){
                e.preventDefault();
                if($(this).hasClass('associate_media_remove') || $(this).hasClass('corr_expressions_remove')){
                    $(this).parent().prev().prev().remove();
                    $(this).parent().prev().remove();
                    $(this).parent().remove();
                }
                else{
                    $(this).parent().remove();
                }
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
                iframeWrap.height(iframeHeight);
                iframe.addClass('stuck');
            });
            /*Floating js End*/

            $(document).on('click', '#time_for_fill, #allow_interruptions', function(){
                if($(this).is(':checked')){
                    if($(this).attr('id') == 'time_for_fill'){
                        $('select#fill_time').attr('disabled', false);
                    }
                    else{
                        $('select#interruption_time').attr('disabled', false);
                    }
                }
                else{
                    if($(this).attr('id') == 'time_for_fill'){
                        $('select#fill_time').attr('disabled', true);
                    }
                    else{
                        $('select#interruption_time').attr('disabled', true);
                    }
                }
            });

            // Change question type on select change
            hideAllQuestionTypes();

            function hideAllQuestionTypes(){
                $('.to_choose').hide();
            }

            function showSpecificQuestionType(selector){
                $(selector).show();
            }

            $(document).on('change', '#question_type', function(){
                $('.choose_question_type').hide();
                if($(this).val() == 1){
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.associate_media'));
                }
                else if($(this).val() == 2){
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.corr_exp'));
                }
                else if($(this).val() == 3){
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.fill_split'));
                }
            });

        });

    </script>

@stop