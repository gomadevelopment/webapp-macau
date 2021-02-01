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
                <form method="GET" action="/exercicios/editar/{{ $exercise->id }}" class="">
                    <button type="submit" class="btn search-btn comment_submit mr-5" style="float: none; padding: 10px 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Arrow_back.svg')}}" alt="">
                    </button>
                    <input type="hidden" name="land_on_structure_tab" id="land_on_structure_tab" value="true">
                </form>
                <div class="wrap d-inline-block">
                    <input type="hidden" name="exercise_question_section" id="exercise_question_section" value="{{ isset($exercise_question_section) ? $exercise_question_section : '' }}">
                    <h1 class="title mb-0">{{ isset($exercise_question_section) ? $exercise_question_section : '' }}</h1>
                    <p class="sub_title m-0">Do Exercício: “{{ $exercise->title }}”</p>
                </div>
                
            </div>
        </div>
    </div>
</section>
<input type="hidden" name="exercise_id_hidden" id="exercise_id_hidden" value="{{ $exercise->id }}">
<input type="hidden" name="question_id_hidden" id="question_id_hidden" value="{{ isset($question) && $question->id ? $question->id : null }}">
<input type="hidden" name="question_section_hidden" id="question_section_hidden" value="{{ isset($question) && $question->id ? $question->section : null }}">
<input type="hidden" name="question_type_id_hidden" id="question_type_id_hidden" value="{{ isset($question) && $question->id ? $question->question_type->id : null }}">
<input type="hidden" name="question_type_name_hidden" id="question_type_name_hidden" value="{{ isset($question) && $question->id ? $question->question_type->name : null }}">
<input type="hidden" name="question_subtype_id_hidden" id="question_subtype_id_hidden" value="{{ isset($question) && $question->id ? $question->question_subtype->id : null }}">
<input type="hidden" name="question_subtype_name_hidden" id="question_subtype_name_hidden" value="{{ isset($question) && $question->id ? $question->question_subtype->name : null }}">
<input type="hidden" name="question_avaliation_score_hidden" id="question_avaliation_score_hidden" value="{{ isset($question) && $question->id ? $question->avaliation_score : null }}">
<input type="hidden" name="model_question_id_hidden" id="model_question_id_hidden" value="{{ $model_question_id }}">



<!-- ============================ Page Title End ================================== -->	

<!-- ============================ Find Courses with Sidebar ================================== -->
<section class="pt-0 create_question">
    <div class="container">

        {{-- CREATED CARDS --}}
        {{-- @if($exercise->questions->count())

            @foreach ($exercise->questions as $created_question)
                @if(isset($question) && $created_question->id == $question->id)
                    @continue
                @endif
                @if ($created_question->section == $exercise_question_section)
                    <div class="row mb-5">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="label_title mb-4 d-block">
                                        {{ $created_question->title }}
                                    </label>
                                    <div class="d-flex float-left flex-column">
                                        <p class="exercise_level m-0"><strong>Tipo:</strong> {{ $created_question->question_type->name }}</p>
                                        <p class="exercise_level m-0"><strong>Referência:</strong> {{ $created_question->reference }}</p>
                                    </div>
                                    <div class="d-block float-right mt-3">
                                        <form method="GET" action="/exercicios/{{ $exercise->id }}/questao/editar/{{ $created_question->id }}" class="" style="display: contents;">
                                            <button class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                                <img src="{{asset('/assets/backoffice_assets/icons/Pencil.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                                Editar
                                            </button>
                                            <input type="hidden" name="exercise_question_section" id="exercise_question_section" value="{{ isset($exercise_question_section) ? $exercise_question_section : '' }}">
                                        </form>
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
                @endif
            @endforeach
                
        @endif --}}
        {{-- CREATE NEW CARD --}}
        <div class="row mb-5">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card-body">
                    {{-- Templates --}}
                    <div class="form-group">
                        <label class="label_title mb-2" style="font-size: 30px;">
                            Os meus Modelos</label>
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-6 mt-2 mb-2">
                                <select name="question_model" id="question_model" class="form-control">
                                    <option value=""></option>
                                    @foreach ($my_question_models as $question_model)
                                        <option value="{{$question_model->id}}">{{$question_model->reference}}</option>
                                    @endforeach
                                    {{-- <option value="1">Modelo A</option>
                                    <option value="2">Modelo B</option>
                                    <option value="3">Modelo C</option> --}}
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
                            Criar Novo <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" data-toggle="tooltip"
                            data-toggle="tooltip" title="Estas Tooltips servem para explicar ao Utilizador como usar o módulo." alt="" style="margin-left: 5px;">
                            {{-- <span class="info_tooltip_text">Tooltip text</span> --}}
                        </label>
                        <div class="row mb-1">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-2 mb-2">
                                <input name="question_name" id="question_name" type="text" class="form-control" placeholder="Título da questão"
                                value="{{ isset($question) ? $question->title : '' }}">
                                <span class="error-block-span pink question_title_error" hidden>
                                </span>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mt-2 mb-2">
                                <select name="question_type" id="question_type" class="form-control">
                                    <option value=""></option>
                                    @foreach ($question_types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <span class="error-block-span pink question_type_error" hidden>
                                </span>
                            </div>
                            <div class="col-xs-0 col-sm-0 col-md-0 col-lg-2"></div>
                        </div>

                        <div class="row mb-2">
                             <div class="col-sm-12 col-md-12 col-lg-12">
                                <input name="question_reference" id="question_reference" type="text" class="form-control" placeholder="Referência da questão"
                                value="{{ isset($question) ? $question->reference : '' }}">
                                <span class="error-block-span pink question_reference_error" hidden>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input name="question_description" id="question_description" type="text" class="form-control" placeholder="Descrição da questão a mostrar ao aluno"
                                value="{{ isset($question) ? $question->description : '' }}">
                                <span class="error-block-span pink question_description_error" hidden>
                                </span>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-5 mb-4">

                    {{-- QUESTION HERE --}}

                    <div class="choose_question_type">
                        <p class="exercise_level float-none m-0"><strong>Escolha o tipo de questão!</strong></p>
                    </div>

                    @include('exercises.questions.types.information')

                    @include('exercises.questions.types.correspondence')

                    {{-- @include('exercises.questions.types.fill_split') --}}

                    @include('exercises.questions.types.fill_options')

                    @include('exercises.questions.types.true_or_false')

                    @include('exercises.questions.types.multiple_choice')

                    @include('exercises.questions.types.free_question')
                    
                    @include('exercises.questions.types.differences')

                    @include('exercises.questions.types.correction_of_statement')

                    @include('exercises.questions.types.automatic_content')

                    @include('exercises.questions.types.assortment')

                    @include('exercises.questions.types.vowels')

                    <hr class="mt-4 mb-5">

                    {{-- Correção --}}
                    <div class="form-group">
                        <label class="label_title mb-3" style="font-size: 30px;">
                            Correção <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" data-toggle="tooltip" title="Estas Tooltips servem para explicar ao Utilizador como usar o módulo." alt="" style="margin-left: 5px;"></label>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input id="correction_required" class="checkbox-custom" name="correction_required" type="checkbox" {{ isset($question) && $question->teacher_correction == 1 ? 'checked' : 'LOL' }}>
                                <label for="correction_required" class="checkbox-custom-label d-inline-block">Requer correção do Professor</label>
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input name="question_reference" id="question_reference" type="text" class="form-control" placeholder="Referência sobre o tipo de questão">
                            </div>
                        </div> --}}
                    </div>

                    <hr class="mt-5 mb-5">
                    {{-- Avaliação --}}
                    <div class="form-group">
                        <label class="label_title mb-3" style="font-size: 30px;">
                            Avaliação</label>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label class="label_title" style="font-size: 16px;">
                                    Pontuação <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" data-toggle="tooltip" title="Estas Tooltips servem para explicar ao Utilizador como usar o módulo." alt="" style="margin-left: 5px;"></label>
                                
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <select name="question_score" id="question_score" class="form-control">
                                    {{-- <option value=""></option> --}}
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
                        <button type="button" id="submit_enabled_form" class="btn search-btn comment_submit m-3" style="float: none;">
                            Gravar <img src="{{asset('/assets/backoffice_assets/icons/save.svg')}}" alt="" style="margin-left: 10px;"></button>
                        {{-- <input id="save_as_template" class="checkbox-custom" name="save_as_template" type="checkbox">
                        <label for="save_as_template" class="checkbox-custom-label d-inline-block">Gravar como Template</label> --}}
                    </div>

                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <form method="GET" action="{{ isset($exercise->id) ? '/exercicios/' . $exercise->id . '/questao/criar' : '#' }}" class="add_question_form">
                    <button type="submit" class="btn search-btn comment_submit m-3" style="font-size: 21px; float: none;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                        Criar Questão
                    </button>
                    <input type="hidden" name="exercise_question_section" id="exercise_question_section" value="{{ isset($exercise_question_section) ? $exercise_question_section : '' }}">
                </form>
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

            // CKEDITOR

            CKEDITOR.replace('info_text', {
                language: 'pt'
            });

            CKEDITOR.plugins.add( 'perc_delimiter', {
                init: function( editor ) {
                    editor.addCommand( 'insertPercDelimiter', {
                        exec: function( editor ) {
                            var now = new Date();
                            editor.insertHtml('<% %>');
                        }
                    });
                    editor.ui.addButton( '<% %>', {
                        label: 'Inserir <% %>',
                        command: 'insertPercDelimiter',
                        toolbar: 'insert'
                    });
                }
            });

            CKEDITOR.config.extraPlugins = 'perc_delimiter';

            // applyCKEditor('fill_textarea_0');
            // applyCKEditor('fill_text_word_0');

            function applyCKEditor(textarea) {
                CKEDITOR.replace( textarea , {
                    height: 125,
                    toolbar: 'Custom',
                    toolbarStartupExpanded : false,
                    toolbarCanCollapse  : false,
                    toolbar_Custom: [
                        { name: 'test', items: ['perc_delimiter', '<% %>'] }
                    ],
                    language: 'pt',
                });
            }

            $('#question_model').select2({
                placeholder: "Escolher Modelo..."
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

            $('button.hide_video').click();

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

            // CHANGE QUESTION TYPE //

            hideAllQuestionTypes();

            function hideAllQuestionTypes(){
                $('.to_choose').hide();
                $('form.question-form').removeClass('form-enabled').addClass('form-disabled');
            }

            function showSpecificQuestionType(selector){
                hideAllQuestionTypes();
                // Form in tabs - Form with Type and Subtype
                if($(selector).hasClass('tabs_creative')){
                    var tab_active = $(selector).find('.nav-link.active').attr('aria-controls');
                    $('form.question-form#form-' + tab_active).removeClass('form-disabled').addClass('form-enabled');
                }
                // Form outside tabs - Form with Type only
                else{
                    var question_type = $(selector).attr('class').split(' ')[2];
                    $('form.question-form#form-' + question_type).removeClass('form-disabled').addClass('form-enabled');
                }

                $(selector).show();
            }

            $(document).on('click', '.nav-link', function(e){
                var tabs_creative = $(this).closest('.tabs_creative'); // Example: "Correspondence (Correspondência)"
                if(tabs_creative.hasClass('to_choose')){
                    var question_type = tabs_creative.attr('class').split(' ')[4];
                    showSpecificQuestionType($('.to_choose.' + question_type));
                }
            });

            $(document).on('change', '#question_type', function(){
                $('.choose_question_type').hide();
                $('.question_type_error').attr('hidden', 'hidden');

                if($(this).val() == 1){
                    // Information
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.information'));
                }
                else if($(this).val() == 2){
                    // Correspondence
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.correspondence'));
                }
                else if($(this).val() == 3){
                    // Fill Options
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.fill_options'));
                }
                else if($(this).val() == 4){
                    // True or False
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.true_or_false'));
                }
                else if($(this).val() == 5){
                    // Multiple Choice
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.multiple_choice'));
                }
                else if($(this).val() == 6){
                    // Free Question
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.free_question'));
                }
                else if($(this).val() == 7){
                    // Differences
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.differences'));
                }
                else if($(this).val() == 8){
                    // Correction of Statement
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.correction_of_statement'));
                }
                else if($(this).val() == 9){
                    // Automatic Content - Break Words
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.automatic_content'));
                }
                else if($(this).val() == 10){
                    // Assortment
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.assortment'));
                }
                else if($(this).val() == 11){
                    //Vowels
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.vowels'));
                }
            });

            // Button remove clone/row
            $(document).on('click', '.remove_button.remove_row', function(e){
                e.preventDefault();
                var row_to_remove = $(this).closest('.row_to_remove');

                // Remove simple row
                if(!$(this).hasClass('remove_entire_question') && !$(this).hasClass('remove_fill_option')){
                    if(row_to_remove.prev('.empty_col').length){
                        row_to_remove.prev('.empty_col').remove();
                    }
                    if(row_to_remove.prev('.hr_row').length){
                        row_to_remove.prev('.hr_row').remove();
                    }
                    row_to_remove.remove();
                }

                // Remove row with sub-questions/sub-answers
                else if($(this).hasClass('remove_entire_question')){
                    if(row_to_remove.prev('.hr_row').length){
                        row_to_remove.prev('.hr_row').remove();
                    }
                    row_to_remove.next('.row').remove();
                    row_to_remove.remove();
                }

                if($(this).hasClass('remove_fill_option')){
                    if($(this).parent().parent().prev().prev('.hr_row').length){
                        $(this).parent().parent().prev().prev('.hr_row').remove();
                    }
                    $(this).parent().parent().prev().remove();
                    $(this).parent().parent().remove();
                }

                if($(this).hasClass('remove_correction_of_statement')){
                    if($(this).parent().prev().prev('.hr_row').length){
                        $(this).parent().prev().prev('.hr_row').remove();
                    }
                    $(this).parent().prev().remove();
                    $(this).parent().next().next().remove();
                    $(this).parent().next().remove();
                    $(this).parent().remove();
                }

                if($(this).hasClass('remove_automatic_content')){
                    if($(this).parent().prev().prev().prev().prev().prev('.hr_row').length){
                        $(this).parent().prev().prev().prev().prev().prev('.hr_row').remove();
                    }
                    $(this).parent().prev().prev().prev().prev().remove();
                    $(this).parent().prev().prev().prev().remove();
                    $(this).parent().prev().prev().remove();
                    $(this).parent().prev().remove();
                    $(this).parent().remove();
                }
            });

            /*
                TEMPLATE TYPES
            */

            // Remove existent files
            $(document).on('click', ".associate_media_thumbnail_remove", function(e){
                e.stopImmediatePropagation();
                e.preventDefault();
                // var id_index = this.id.match(/\d+/)[0];
                $(this).parent(".associate_media_preview").prev().remove();
                $(this).parent(".associate_media_preview").prev().show();
                $(this).parent(".associate_media_preview").remove();
            });


            // CORRESPONDENCE // 1
            
            // Clone new Correspondence Image
            $(document).on('click', '.button_add_corr_image', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_correspondence_images_clone').children();

                var new_index = parseInt(html.find("[id^='corr_image_description_']")[0].id.match(/\d+/)[0]) + 1;

                html.find("[name^='corr_image_description_']").attr('name', 'corr_image_description_'+new_index);
                html.find("[id^='corr_image_description_']").attr('id', 'corr_image_description_'+new_index);
                
                html.find("[id^='corr_image_button_']").attr('id', 'corr_image_button_'+new_index);

                html.find("[name^='corr_image_file_input_']").attr('name', 'corr_image_file_input_'+new_index);
                html.find("[id^='corr_image_file_input_']").attr('id', 'corr_image_file_input_'+new_index);

                html = html.clone();

                $(paste_before).append(html);
            });
            // Correspondence Image upload and preview script
            $(document).on('click', "[id^='corr_image_button_']", function(e){
                e.preventDefault();
                var id_index = this.id.match(/\d+/)[0];

                var html = '<input type="file" name="corr_image_file_input_'+id_index+'" id="corr_image_file_input_'+id_index+'" hidden>';

                $(this).after(html);
                
                $('#corr_image_file_input_' + id_index).click();
                
                $('#corr_image_file_input_' + id_index).on("change", function(e) {
                    var id_index = this.id.match(/\d+/)[0];
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i];
                        if(!f.type.match('image.*')){
                            alert('Não foi possível associar esse tipo de ficheiro. Associe ficheiro de imagem.');
                            return false;
                        }
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<a href=\"#\" class=\"btn btn-theme remove_button associate_media_preview button-wrap\">" +
                                "<img src=\""+e.target.result+"\" title=\""+file.name+"\" class=\"associate_media_thumbnail_img mr-2\">" +
                                "<span class=\"associate_media_thumbnail_title\">"+f.name+"</span>" +
                                "<img class=\"associate_media_thumbnail_remove\" id=\"corr_image_file_remove_"+id_index+"\" src=\"/assets/backoffice_assets/icons/Cross.svg\">" +
                                "</a>"
                            ).insertAfter("#corr_image_file_input_" + id_index);

                            $('#corr_image_button_' + id_index).hide();
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            });

            // Clone new Correspondence Audio/Video
            $(document).on('click', '.button_add_corr_audio', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_correspondence_audios_clone').children();

                var new_index = parseInt(html.find("[id^='corr_audio_description_']")[0].id.match(/\d+/)[0]) + 1;

                html.find("[name^='corr_audio_description_']").attr('name', 'corr_audio_description_'+new_index);
                html.find("[id^='corr_audio_description_']").attr('id', 'corr_audio_description_'+new_index);
                
                html.find("[id^='corr_audio_button_']").attr('id', 'corr_audio_button_'+new_index);

                html.find("[name^='corr_audio_file_input_']").attr('name', 'corr_audio_file_input_'+new_index);
                html.find("[id^='corr_audio_file_input_']").attr('id', 'corr_audio_file_input_'+new_index);

                html = html.clone();

                $(paste_before).append(html);
            });
            // Correspondence Audio/Video upload and preview script
            $(document).on('click', "[id^='corr_audio_button_']", function(e){
                e.preventDefault();
                var id_index = this.id.match(/\d+/)[0];

                var html = '<input type="file" name="corr_audio_file_input_'+id_index+'" id="corr_audio_file_input_'+id_index+'" hidden>';

                $(this).after(html);

                $('#corr_audio_file_input_' + id_index).click();

                $('#corr_audio_file_input_' + id_index).on("change", function(e) {
                    var id_index = this.id.match(/\d+/)[0];
                    
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i];
                        if(!f.type.match('video.*')){
                            alert('Não foi possível associar esse tipo de ficheiro. Associe um ficheiro de audio ou video.');
                            $('#corr_audio_file_input_'+id_index).remove();
                            return false;
                        }
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<a href=\"#\" class=\"btn btn-theme remove_button associate_media_preview no-preview button-wrap\">" +
                                // "<img src=\""+e.target.result+"\" title=\""+file.name+"\" class=\"associate_media_thumbnail_img mr-2\">" +
                                "<span class=\"associate_media_thumbnail_title\">"+f.name+"</span>" +
                                "<img class=\"associate_media_thumbnail_remove\" src=\"/assets/backoffice_assets/icons/Cross.svg\">" +
                                "</a>"
                            ).insertAfter("#corr_audio_file_input_" + id_index);

                            $('#corr_audio_button_' + id_index).hide();
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            });

            // Clone new Correspondence Category QUESTION + ANSWER
            $(document).on('click', '.button_add_corr_category', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent();

                var html = $('.add_correspondence_categories_clone').children();

                var question_number = parseInt(html.find("[id^='corr_category_question_']")[0].id.match(/\d+/)[0]) + 1;

                html.find('.question_number>span').text('Categoria/Frase ' + (question_number + 1));

                html.find("[name^='corr_category_question_']").attr('name', 'corr_category_question_'+question_number);
                html.find("[id^='corr_category_question_']").attr('id', 'corr_category_question_'+question_number);
                
                // Change answers names and ids
                var answer_number = parseInt(html.find("[id^='corr_category_answer_']")[0].id.match(/\d+/)[0]);
                html.find("[name^='corr_category_answer_']").attr('name', 'corr_category_answer_'+answer_number+'_question_'+question_number);
                html.find("[id^='corr_category_answer_']").attr('id', 'corr_category_answer_'+answer_number+'_question_'+question_number);

                // Update add more questions - question number and answer number
                html.find('.button_add_category_answer').attr('id', 'add_corr_category_question_'+question_number+'_answer_1');

                html = html.clone();

                $(paste_before).before(html);
            });
            // Clone new Correspondence Category ANSWER ONLY
            $(document).on('click', '.button_add_category_answer', function(e){
                e.preventDefault();
                var paste_before = $(this).parent();
                // add_corr_category_question_0_answer_1
                var html = $('.add_correspondence_categories_answer_clone').children();

                // Change answers names and ids
                var question_number = parseInt($(this)[0].id.match(/\d+/g)[0]);
                var answer_number = parseInt($(this)[0].id.match(/\d+/g)[1]);

                if(answer_number >= 10){
                    alert('Não pode adicionar mais de 10 respostas por pergunta.');
                    return false;
                }

                html.find("[name^='corr_category_answer_']").attr('name', 'corr_category_answer_'+answer_number+'_question_'+question_number);
                html.find("[id^='corr_category_answer_']").attr('id', 'corr_category_answer_'+answer_number+'_question_'+question_number);

                // Update add more questions - question number and answer number
                $(this).attr('id', 'add_corr_category_question_'+question_number+'_answer_'+(answer_number + 1));

                html = html.clone();

                $(paste_before).before(html);
            });


            // TRUE OR FALSE //  2
            
            // Clone new True or Falses
            $(document).on('click', '.button_add_true_or_false', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_true_or_false_clone').children();

                var new_index = parseInt(html.find("[id^='true_or_false_input_']")[0].id.match(/\d+/)[0]) + 1;

                html.find("[name^='true_or_false_input_']").attr('name', 'true_or_false_input_'+new_index)
                html.find("[id^='true_or_false_input_']").attr('id', 'true_or_false_input_'+new_index)

                html.find("[name^='true_or_false_select_']")
                    .attr('name', 'true_or_false_select_'+new_index)
                    .attr('id', 'true_or_false_select_'+new_index);
                // html.find("[id^='true_or_false_select_']").attr('id', 'true_or_false_select_'+new_index);

                html.find("[id^='true_or_false_associate_media_file_button_']").attr('id', 'true_or_false_associate_media_file_button_'+new_index);

                html.find("[name^='true_or_false_associate_media_file_input_']").attr('name', 'true_or_false_associate_media_file_input_'+new_index);
                html.find("[id^='true_or_false_associate_media_file_input_']").attr('id', 'true_or_false_associate_media_file_input_'+new_index);

                html = html.clone();

                html.find('#true_or_false_select_'+new_index).select2();

                $(paste_before).append(html);
            });
            // True or Falses Media upload and preview script
            $(document).on('click', "[id^='true_or_false_associate_media_file_button_']", function(e){
                e.preventDefault();
                var id_index = this.id.match(/\d+/)[0];

                var html = '<input type="file" name="true_or_false_associate_media_file_input_'+id_index+'" id="true_or_false_associate_media_file_input_'+id_index+'" hidden>';

                $(this).after(html);

                $('#true_or_false_associate_media_file_input_' + id_index).click();

                $('#true_or_false_associate_media_file_input_' + id_index).on("change", function(e) {
                    var id_index = this.id.match(/\d+/)[0];
                    
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<a href=\"#\" class=\"btn btn-theme remove_button associate_media_preview button-wrap\">" +
                                "<img src=\""+e.target.result+"\" title=\""+file.name+"\" class=\"associate_media_thumbnail_img mr-2\">" +
                                "<span class=\"associate_media_thumbnail_title\">"+f.name+"</span>" +
                                "<img class=\"associate_media_thumbnail_remove\" src=\"/assets/backoffice_assets/icons/Cross.svg\">" +
                                "</a>"
                            ).insertAfter("#true_or_false_associate_media_file_input_" + id_index);

                            $('#true_or_false_associate_media_file_button_' + id_index).hide();

                            // $(".associate_media_thumbnail_remove").click(function(e){
                            //     e.stopImmediatePropagation();
                            //     e.preventDefault();
                            //     $('#true_or_false_associate_media_file_button_' + id_index).show();
                            //     $('#true_or_false_associate_media_file_input_' + id_index).remove();
                            //     $(this).parent(".associate_media_preview").remove();
                            // });
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            });
            // Apply select2 on load EDIT - true_or_false
            

            // MULTIPLE CHOICE // 3

            // Clone new Multiple Choice QUESTION + ANSWER
            $(document).on('click', '.button_add_multiple_choice', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent();

                var html = $('.add_multiple_choice_clone').children();

                var question_number = parseInt(html.find("[id^='multiple_choice_question_']")[0].id.match(/\d+/)[0]) + 1;

                html.find('.question_number>span').text('Pergunta ' + (question_number + 1));

                html.find("[name^='multiple_choice_question_']").attr('name', 'multiple_choice_question_'+question_number);
                html.find("[id^='multiple_choice_question_']").attr('id', 'multiple_choice_question_'+question_number);
                
                html.find("[id^='m_c_associate_media_button_']").attr('id', 'm_c_associate_media_button_'+question_number);

                // var new_m_c_associate_media_file_input_id = parseInt(html.find("[id^='m_c_associate_media_file_input_']")[0].id.match(/\d+/)[0]) + 1;
                // html.find("[name^='m_c_associate_media_file_input_']").attr('name', 'm_c_associate_media_file_input_'+new_m_c_associate_media_file_input_id);
                // html.find("[id^='m_c_associate_media_file_input_']").attr('id', 'm_c_associate_media_file_input_'+new_m_c_associate_media_file_input_id);

                // Change answers names and ids
                var answer_number = parseInt(html.find("[id^='multiple_choice_correct_answer_']")[0].id.match(/\d+/)[0]);
                html.find("[name^='multiple_choice_correct_answer_']").attr('name', 'multiple_choice_correct_answer_'+answer_number+'_question_'+question_number);
                html.find("[id^='multiple_choice_correct_answer_']").attr('id', 'multiple_choice_correct_answer_'+answer_number+'_question_'+question_number);
                html.find("[for^='multiple_choice_correct_answer_']").attr('for', 'multiple_choice_correct_answer_'+answer_number+'_question_'+question_number);
                html.find("[name^='multiple_choice_answer_']").attr('name', 'multiple_choice_answer_'+answer_number+'_question_'+question_number);
                html.find("[id^='multiple_choice_answer_']").attr('id', 'multiple_choice_answer_'+answer_number+'_question_'+question_number);

                // Update add more questions - question number and answer number
                html.find('.button_add_multiple_choice_answer').attr('id', 'add_questions_question_'+question_number+'_answer_1');

                html = html.clone();

                $(paste_before).before(html);
            });
            // Clone new Multiple Choice ANSWER ONLY
            $(document).on('click', '.button_add_multiple_choice_answer', function(e){
                e.preventDefault();
                var paste_before = $(this).parent();

                var html = $('.add_multiple_choice_answers_clone').children();

                // Change answers names and ids
                var question_number = parseInt($(this)[0].id.match(/\d+/g)[0]);
                var answer_number = parseInt($(this)[0].id.match(/\d+/g)[1]);

                html.find("[name^='multiple_choice_correct_answer_']").attr('name', 'multiple_choice_correct_answer_'+answer_number+'_question_'+question_number);
                html.find("[id^='multiple_choice_correct_answer_']").attr('id', 'multiple_choice_correct_answer_'+answer_number+'_question_'+question_number);
                html.find("[for^='multiple_choice_correct_answer_']").attr('for', 'multiple_choice_correct_answer_'+answer_number+'_question_'+question_number);
                html.find("[name^='multiple_choice_answer_']").attr('name', 'multiple_choice_answer_'+answer_number+'_question_'+question_number);
                html.find("[id^='multiple_choice_answer_']").attr('id', 'multiple_choice_answer_'+answer_number+'_question_'+question_number);

                // Update add more questions - question number and answer number
                $(this).attr('id', 'add_questions_question_'+question_number+'_answer_'+(answer_number + 1));

                html = html.clone();

                $(paste_before).before(html);
            });
            // Multiple Choice upload and preview script
            $(document).on('click', "[id^='m_c_associate_media_button_']", function(e){
                e.preventDefault();
                var id_index = this.id.match(/\d+/)[0];

                var html = '<input type="file" name="m_c_associate_media_file_input_'+id_index+'" id="m_c_associate_media_file_input_'+id_index+'" hidden>';

                $(this).after(html);

                $('#m_c_associate_media_file_input_' + id_index).click();

                $('#m_c_associate_media_file_input_' + id_index).on("change", function(e) {
                    var id_index = this.id.match(/\d+/)[0];
                    
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<a href=\"#\" class=\"btn btn-theme remove_button associate_media_preview button-wrap\">" +
                                "<img src=\""+e.target.result+"\" title=\""+file.name+"\" class=\"associate_media_thumbnail_img mr-2\">" +
                                "<span class=\"associate_media_thumbnail_title\">"+f.name+"</span>" +
                                "<img class=\"associate_media_thumbnail_remove\" src=\"/assets/backoffice_assets/icons/Cross.svg\">" +
                                "</a>"
                            ).insertAfter("#m_c_associate_media_file_input_" + id_index);

                            $('#m_c_associate_media_button_' + id_index).hide();

                            // $(".associate_media_thumbnail_remove").click(function(e){
                            //     e.stopImmediatePropagation();
                            //     e.preventDefault();
                            //     $('#m_c_associate_media_button_' + id_index).show();
                            //     $('#m_c_associate_media_file_input_' + id_index).remove();
                            //     $(this).parent(".associate_media_preview").remove();
                            // });
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            });

            // Clone new Multiple Choice INTRUDER + ANSWER
            $(document).on('click', '.button_add_multiple_choice_intruder', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent();

                var html = $('.add_multiple_choice_intruder_clone').children();

                var question_number = parseInt(html.find("[id^='multiple_choice_intruder_question_']")[0].id.match(/\d+/)[0]) + 1;

                html.find('.question_number>span').text('Grupo de Palavras ' + (question_number + 1));

                html.find("[id^='multiple_choice_intruder_question_']").attr('id', 'multiple_choice_intruder_question_'+question_number);
                
                // Change answers names and ids
                var answer_number = parseInt(html.find("[id^='multiple_choice_intruder_intruder_answer_']")[0].id.match(/\d+/)[0]);
                html.find("[name^='multiple_choice_intruder_intruder_answer_']").attr('name', 'multiple_choice_intruder_intruder_answer_'+answer_number+'_question_'+question_number);
                html.find("[id^='multiple_choice_intruder_intruder_answer_']").attr('id', 'multiple_choice_intruder_intruder_answer_'+answer_number+'_question_'+question_number);
                html.find("[for^='multiple_choice_intruder_intruder_answer_']").attr('for', 'multiple_choice_intruder_intruder_answer_'+answer_number+'_question_'+question_number);
                html.find("[name^='multiple_choice_intruder_input_answer_']").attr('name', 'multiple_choice_intruder_input_answer_'+answer_number+'_question_'+question_number);
                html.find("[id^='multiple_choice_intruder_input_answer_']").attr('id', 'multiple_choice_intruder_input_answer_'+answer_number+'_question_'+question_number);

                // Update add more questions - question number and answer number
                html.find('.button_add_multiple_choice_intruder_answer').attr('id', 'add_intruders_question_'+question_number+'_answer_1');

                html = html.clone();

                $(paste_before).before(html);
            });
            // Clone new Multiple Choice ANSWER ONLY
            $(document).on('click', '.button_add_multiple_choice_intruder_answer', function(e){
                e.preventDefault();
                var paste_before = $(this).parent();

                var html = $('.add_multiple_choice_intruder_answer_clone').children();

                // Change answers names and ids
                var question_number = parseInt($(this)[0].id.match(/\d+/g)[0]);
                var answer_number = parseInt($(this)[0].id.match(/\d+/g)[1]);

                html.find("[name^='multiple_choice_intruder_intruder_answer_']").attr('name', 'multiple_choice_intruder_intruder_answer_'+answer_number+'_question_'+question_number);
                html.find("[id^='multiple_choice_intruder_intruder_answer_']").attr('id', 'multiple_choice_intruder_intruder_answer_'+answer_number+'_question_'+question_number);
                html.find("[for^='multiple_choice_intruder_intruder_answer_']").attr('for', 'multiple_choice_intruder_intruder_answer_'+answer_number+'_question_'+question_number);
                html.find("[name^='multiple_choice_intruder_input_answer_']").attr('name', 'multiple_choice_intruder_input_answer_'+answer_number+'_question_'+question_number);
                html.find("[id^='multiple_choice_intruder_input_answer_']").attr('id', 'multiple_choice_intruder_input_answer_'+answer_number+'_question_'+question_number);

                // Update add more questions - question number and answer number
                $(this).attr('id', 'add_intruders_question_'+question_number+'_answer_'+(answer_number + 1));

                html = html.clone();

                $(paste_before).before(html);
            });

            // FILL OPTIONS // 4

            // Clone new Fill options SHUFFLE
            $(document).on('click', '.button_add_fill', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_fill_clone').children();

                var new_index = parseInt(html.find("[id^='fill_textarea_']")[0].id.match(/\d+/)[0]) + 1;

                html.find('.question_number>span').text('Questão ' + (new_index + 1));

                html.find("[id^='fill_perc_delimiter_']").attr('id', 'fill_perc_delimiter_'+new_index);

                html.find("[name^='fill_textarea_']").attr('name', 'fill_textarea_'+new_index);
                html.find("[id^='fill_textarea_']").attr('id', 'fill_textarea_'+new_index);

                html.find("[name^='fill_associate_media_file_button_']").attr('name', 'fill_associate_media_file_button_'+new_index);
                html.find("[id^='fill_associate_media_file_button_']").attr('id', 'fill_associate_media_file_button_'+new_index);

                html.find("[name^='fill_associate_media_file_input_']").attr('name', 'fill_associate_media_file_input_'+new_index);
                html.find("[id^='fill_associate_media_file_input_']").attr('id', 'fill_associate_media_file_input_'+new_index);

                html = html.clone();

                $(paste_before).append(html);

                // applyCKEditor('fill_textarea_' + new_index);
                
            });
            // Fill options SHUFFLE Media upload and preview script
            $(document).on('click', "[id^='fill_associate_media_file_button_']", function(e){
                e.preventDefault();
                var id_index = this.id.match(/\d+/)[0];

                var html = '<input type="file" name="fill_associate_media_file_input_'+id_index+'" id="fill_associate_media_file_input_'+id_index+'" hidden>';
                
                $(this).after(html);

                $('#fill_associate_media_file_input_' + id_index).click();

                $('#fill_associate_media_file_input_' + id_index).on("change", function(e) {
                    var id_index = this.id.match(/\d+/)[0];
                    
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<a href=\"#\" class=\"btn btn-theme remove_button associate_media_preview button-wrap\">" +
                                "<img src=\""+e.target.result+"\" title=\""+file.name+"\" class=\"associate_media_thumbnail_img mr-2\">" +
                                "<span class=\"associate_media_thumbnail_title\">"+f.name+"</span>" +
                                "<img class=\"associate_media_thumbnail_remove\" src=\"/assets/backoffice_assets/icons/Cross.svg\">" +
                                "</a>"
                            ).insertAfter("#fill_associate_media_file_input_" + id_index);

                            $('#fill_associate_media_file_button_' + id_index).hide();

                            // $(".associate_media_thumbnail_remove").click(function(e){
                            //     e.stopImmediatePropagation();
                            //     e.preventDefault();
                            //     $('#fill_associate_media_file_button_' + id_index).show();
                            //     $('#fill_associate_media_file_input_' + id_index).remove();
                            //     $(this).parent(".associate_media_preview").remove();
                            // });
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            });
            // <% %> button
            $(document).on('click', '[id^="fill_perc_delimiter_"]', function(e){
                e.preventDefault();
                var word_id = parseInt(this.id.match(/\d+/)[0]);
                var $txt = $("#fill_textarea_" + word_id);
                var caretPos = $txt[0].selectionStart;
                var textAreaTxt = $txt.val();
                var txtToAdd = "<% %>";
                $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
                $txt.keyup();
                $txt.focus();
            });

            // Clone new Fill Options TEXT WORDS
            $(document).on('click', '.button_add_fill_text_words', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent();

                var html = $('.add_fill_text_words_clone').children();

                var new_index = parseInt(html.find("[id^='fill_text_word_']")[0].id.match(/\d+/)[0]) + 1;

                html.find('.question_number>span').text('Frase ' + (new_index + 1));

                html.find("[id^='text_word_perc_delimiter_']").attr('id', 'text_word_perc_delimiter_'+new_index);

                html.find("[name^='fill_text_word_']").attr('name', 'fill_text_word_'+new_index);
                html.find("[id^='fill_text_word_']").attr('id', 'fill_text_word_'+new_index);

                html.find("[id^='selects_row_text_words_']").attr('id', 'selects_row_text_words_'+new_index);

                html = html.clone();

                $(paste_before).before(html);

                // applyCKEditor('fill_text_word_' + new_index);
                
            });
            // Apply select2 on load EDIT - text_words
            $('[id^="select_text_word_"]').select2({
                tags: true,
                placeholder: "Escreva as opções...",
                "language": {
                    "noResults": function(){
                        return "Não foram encontradas opções.";
                    }
                },
                multiple: true
            });

            // Generate multiple selects on KEYUP
            $(document).on('keyup', '[id^="fill_text_word_"]', function(e){
                e.preventDefault();
                var word_id = parseInt(this.id.match(/\d+/)[0]);
                var word = $(this).val();
                var regex_match = word.match(/<%\s*%>/gm);
                if(regex_match){

                    regex_match.forEach(function (value, index) {

                        if($('#select_text_word_' + word_id + '_option_' + index).length){
                            return;
                        }

                        var new_vowel_select = '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-1 d-flex">';
                        new_vowel_select += '<p class="exercise_level align-self-center m-0">'+(index + 1)+'ª&nbsp;&nbsp;</p>';
                        new_vowel_select += '<select name="select_text_word_' + word_id + '_option_' + index+'[]" id="select_text_word_' + word_id + '_option_' + index+'" class="form-control select_vowels_class" multiple></select>';
                        new_vowel_select += '</div>';

                        $('#selects_row_text_words_'+word_id).append(new_vowel_select);
                        
                        updateVowelSelects(index, word_id);

                        $('#select_text_word_' + word_id + '_option_' + index).select2({
                            tags: true,
                            placeholder: "Escreva as opções...",
                            "language": {
                                "noResults": function(){
                                    return "Não foram encontradas opções.";
                                }
                            },
                            multiple: true
                        });
                        
                    });
                    
                }
                else if(!regex_match){
                    $('#selects_row_text_words_'+word_id).empty();
                }
                // Delete selects "a mais"
                $('[id^="select_text_word_'+word_id+'"]').each(function(index, element){
                    var check_vowel_id = parseInt(element.id.match(/\d+/g)[1]);
                    if(!regex_match){
                        $('#select_text_word_' + word_id + '_option_0').parent().remove();
                        $('#select_text_word_' + word_id + '_option_0').remove();
                        return;
                    }
                    if(check_vowel_id >= regex_match.length){
                        $(element).parent().remove();
                        $(element).remove();
                    }
                });
                
            });
            // <% %> button
            $(document).on('click', '[id^="text_word_perc_delimiter_"]', function(e){
                e.preventDefault();
                var word_id = parseInt(this.id.match(/\d+/)[0]);
                var $txt = $("#fill_text_word_" + word_id);
                var caretPos = $txt[0].selectionStart;
                var textAreaTxt = $txt.val();
                var txtToAdd = "<% %>";
                $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
                $txt.keyup();
                $txt.focus();
            });

            // FREE QUESTION // 5

            // Clone new Free Question
            $(document).on('click', '.button_add_free_question', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_free_question_clone').children();

                var question_number = parseInt(html.find("[id^='f_q_associate_media_button_']")[0].id.match(/\d+/)[0]) + 1;

                html.find('.question_number>span').text('Questão ' + (question_number + 1));

                html.find("[name^='free_question_']").attr('name', 'free_question_'+question_number);
                html.find("[id^='free_question_']").attr('id', 'free_question_'+question_number);

                html.find("[id^='f_q_associate_media_button_']").attr('id', 'f_q_associate_media_button_'+question_number);
                
                html.find("[name^='f_q_associate_media_file_input_']").attr('name', 'f_q_associate_media_file_input_'+question_number);
                html.find("[id^='f_q_associate_media_file_input_']").attr('id', 'f_q_associate_media_file_input_'+question_number);

                html = html.clone();

                $(paste_before).append(html);
            });
            // Free Question Media upload and preview script
            $(document).on('click', "[id^='f_q_associate_media_button_']", function(e){
                e.preventDefault();
                var id_index = this.id.match(/\d+/)[0];

                var html = '<input type="file" name="f_q_associate_media_file_input_'+id_index+'" id="f_q_associate_media_file_input_'+id_index+'" hidden>';

                $(this).after(html);

                $('#f_q_associate_media_file_input_' + id_index).click();

                $(document).on("change", '#f_q_associate_media_file_input_' + id_index, function(e) {
                    var id_index = this.id.match(/\d+/)[0];
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i];
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<a href=\"#\" class=\"btn btn-theme remove_button associate_media_preview button-wrap\">" +
                                "<img src=\""+e.target.result+"\" title=\""+file.name+"\" class=\"associate_media_thumbnail_img mr-2\">" +
                                "<span class=\"associate_media_thumbnail_title\">"+f.name+"</span>" +
                                "<img class=\"associate_media_thumbnail_remove\" src=\"/assets/backoffice_assets/icons/Cross.svg\">" +
                                "</a>"
                            ).insertAfter("#f_q_associate_media_file_input_" + id_index);

                            $('#f_q_associate_media_button_' + id_index).hide();

                            // $(".associate_media_thumbnail_remove").click(function(e){
                            //     e.stopImmediatePropagation();
                            //     e.preventDefault();
                            //     $('#f_q_associate_media_button_' + id_index).show();
                            //     $('#f_q_associate_media_file_input_' + id_index).remove();
                            //     $(this).parent(".associate_media_preview").remove();
                            // });
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            });


            // DIFFERENCES //  6

            // Clone new Differences
            $(document).on('click', '.button_add_differences', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_differences_clone').children();

                var new_index = parseInt(html.find("[id^='differences_text_']")[0].id.match(/\d+/)[0]) + 1;

                html.find('.text_number>span').text('Texto ' + (new_index + 1));
                html.find('.solution_number>span').text('Solução ' + (new_index + 1));

                html.find("[name^='differences_text_']").attr('name', 'differences_text_'+new_index);
                html.find("[id^='differences_text_']").attr('id', 'differences_text_'+new_index);

                html.find("[name^='differences_solution_']").attr('name', 'differences_solution_'+new_index);
                html.find("[id^='differences_solution_']").attr('id', 'differences_solution_'+new_index);

                html = html.clone();

                $(paste_before).append(html);
                
            });


            // CORRECTION OF STATEMENTS 7

            // Clone new Correction of Statement
            $(document).on('click', '.button_add_correction_of_statement', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_correction_of_statement_clone').children();

                var new_index = parseInt(html.find("[id^='correction_of_statement_question_']")[0].id.match(/\d+/)[0]) + 1;

                html.find('.statement_number>span').text('Afirmação ' + (new_index + 1));

                html.find("[name^='correction_of_statement_question_']").attr('name', 'correction_of_statement_question_'+new_index);
                html.find("[id^='correction_of_statement_question_']").attr('id', 'correction_of_statement_question_'+new_index);

                html.find("[name^='correction_of_statement_solution_']").attr('name', 'correction_of_statement_solution_'+new_index);
                html.find("[id^='correction_of_statement_solution_']").attr('id', 'correction_of_statement_solution_'+new_index);

                html = html.clone();

                $(paste_before).append(html);
                
            });


            // AUTOMATIC CONTENT - SPLIT WORDS // 8

            // Clone new automatic content - split
            $(document).on('click', '.button_add_split', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_split_clone').children();

                var new_index = parseInt(html.find("[id^='split_textarea_']")[0].id.match(/\d+/)[0]) + 1;

                html.find('.text_number>span').text('Texto ' + (new_index + 1));

                html.find("[name^='split_textarea_']").attr('name', 'split_textarea_'+new_index);
                html.find("[id^='split_textarea_']").attr('id', 'split_textarea_'+new_index);

                html.find("[name^='split_preview_']").attr('name', 'split_preview_'+new_index);
                html.find("[id^='split_preview_']").attr('id', 'split_preview_'+new_index);

                html = html.clone();

                $(paste_before).append(html);
                
            });
            // Preview split text on key up
            $(document).on('keyup', "[id^='split_textarea_']", function(e){
                var textarea_id = parseInt($(this)[0].id.match(/\d+/)[0]);
                $('#split_preview_'+textarea_id).val($(this).val().replace(/ /g,''));
            });


            // ASSORTMENT // 9

            // Clone new Assort Sentences - SENTENCE + SOLUTION
            $(document).on('click', '.button_add_assort_sentence', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_assort_sentences_clone').children();

                var sentence_number = parseInt(html.find("[id^='assort_sentences_question_']")[0].id.match(/\d+/)[0]) + 1;

                html.find('.sentence_number>span').text('Conjunto de Frases ' + (sentence_number + 1));

                html.find("[name^='assort_sentences_question_']").attr('name', 'assort_sentences_question_'+sentence_number);
                html.find("[id^='assort_sentences_question_']").attr('id', 'assort_sentences_question_'+sentence_number);

                var sub_sentence_number = parseInt(html.find("[id^='assort_sentences_sentence_']")[0].id.match(/\d+/)[0]);

                html.find("[name^='assort_sentences_sentence_']").attr('name', 'assort_sentences_sentence_'+sub_sentence_number+'_question_'+sentence_number);
                html.find("[id^='assort_sentences_sentence_']").attr('id', 'assort_sentences_sentence_'+sub_sentence_number+'_question_'+sentence_number);

                html.find('.button_add_assort_sentences_solution').attr('id', 'add_assort_sentences_question_'+sentence_number+'_solution_1');

                html = html.clone();

                $(paste_before).after(html);
                
            });
            // Clone new Assort Sentences - SOLUTION ONLY
            $(document).on('click', '.button_add_assort_sentences_solution', function(e){
                e.preventDefault();
                var paste_before = $(this).parent();

                var html = $('.add_assort_sentences_sentence_clone').children();

                // Change solutions names and ids
                var sentence_number = parseInt($(this)[0].id.match(/\d+/g)[0]);
                var solution_number = parseInt($(this)[0].id.match(/\d+/g)[1]);
                html.find("[name^='assort_sentences_sentence_']").attr('name', 'assort_sentences_sentence_'+solution_number+'_question_'+sentence_number);
                html.find("[id^='assort_sentences_sentence_']").attr('id', 'assort_sentences_sentence_'+solution_number+'_question_'+sentence_number);

                // Update add more questions - question number and answer number
                $(this).attr('id', 'add_assort_sentences_question_'+sentence_number+'_solution_'+(solution_number + 1));

                html = html.clone();

                $(paste_before).before(html);
            });

            // Clone new Assort Words - SENTENCE + SOLUTION
            $(document).on('click', '.button_add_assort_words', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_assort_words_clone').children();

                var sentence_number = parseInt(html.find("[id^='assort_words_question_']")[0].id.match(/\d+/)[0]) + 1;

                html.find('.sentence_number>span').text('Frase ' + (sentence_number + 1));

                html.find("[name^='assort_words_question_']").attr('name', 'assort_words_question_'+sentence_number);
                html.find("[id^='assort_words_question_']").attr('id', 'assort_words_question_'+sentence_number);

                // Change solutions names and ids
                var solution_number = parseInt(html.find("[id^='assort_words_solution_']")[0].id.match(/\d+/)[0]);
                html.find("[name^='assort_words_solution_']").attr('name', 'assort_words_solution_'+solution_number+'_question_'+sentence_number);
                html.find("[id^='assort_words_solution_']").attr('id', 'assort_words_solution_'+solution_number+'_question_'+sentence_number);

                // Update add more questions - question number and answer number
                html.find('.button_add_assort_words_solution').attr('id', 'add_assort_words_question_'+sentence_number+'_solution_1');

                html = html.clone();

                $(paste_before).after(html);
            });
            // Clone new Assort Words - SOLUTION ONLY
            $(document).on('click', '.button_add_assort_words_solution', function(e){
                e.preventDefault();
                var paste_before = $(this).parent();

                var html = $('.add_assort_words_solution_clone').children();

                // Change solutions names and ids
                var sentence_number = parseInt($(this)[0].id.match(/\d+/g)[0]);
                var solution_number = parseInt($(this)[0].id.match(/\d+/g)[1]);
                html.find("[name^='assort_words_solution_']").attr('name', 'assort_words_solution_'+solution_number+'_question_'+sentence_number);
                html.find("[id^='assort_words_solution_']").attr('id', 'assort_words_solution_'+solution_number+'_question_'+sentence_number);

                // Update add more questions - question number and answer number
                $(this).attr('id', 'add_assort_words_question_'+sentence_number+'_solution_'+(solution_number + 1));

                html = html.clone();

                $(paste_before).before(html);
            });

            // Clone new Assort Images
            $(document).on('click', '.button_add_assort_assort_images', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_assort_assort_images_clone').children();

                var new_index = parseInt(html.find("[id^='assort_image_input_']")[0].id.match(/\d+/)[0]) + 1;

                html.find("[name^='assort_image_input_']").attr('name', 'assort_image_input_'+new_index);
                html.find("[id^='assort_image_input_']").attr('id', 'assort_image_input_'+new_index);

                html.find("[id^='assort_image_media_button_']").attr('id', 'assort_image_media_button_'+new_index);

                html.find("[id^='assort_image_media_file_input_']").attr('id', 'assort_image_media_file_input_'+new_index);

                html = html.clone();

                $(paste_before).append(html);
            });
            // Assort Images upload and preview script
            $(document).on('click', "[id^='assort_image_media_button_']", function(e){
                e.preventDefault();
                var id_index = this.id.match(/\d+/)[0];

                var html = '<input type="file" name="assort_image_media_file_input_'+id_index+'" id="assort_image_media_file_input_'+id_index+'" hidden>';
                
                $(this).after(html);

                $('#assort_image_media_file_input_' + id_index).click();

                $('#assort_image_media_file_input_' + id_index).on("change", function(e) {
                    var id_index = this.id.match(/\d+/)[0];
                    
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<a href=\"#\" class=\"btn btn-theme remove_button associate_media_preview button-wrap\">" +
                                "<img src=\""+e.target.result+"\" title=\""+file.name+"\" class=\"associate_media_thumbnail_img mr-2\">" +
                                "<span class=\"associate_media_thumbnail_title\">"+f.name+"</span>" +
                                "<img class=\"associate_media_thumbnail_remove\" src=\"/assets/backoffice_assets/icons/Cross.svg\">" +
                                "</a>"
                            ).insertAfter("#assort_image_media_file_input_" + id_index);

                            $('#assort_image_media_button_' + id_index).hide();

                            // $(".associate_media_thumbnail_remove").click(function(e){
                            //     e.stopImmediatePropagation();
                            //     e.preventDefault();
                            //     $('#assort_image_media_button_' + id_index).show();
                            //     $('#assort_image_media_file_input_' + id_index).remove();
                            //     $(this).parent(".associate_media_preview").remove();
                            // });
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            });


            // VOWELS // 10

            $('#possible_vowels').select2({
                tags: true,
                placeholder: 'Escreva as vogais...',
                multiple: true
            });
            $('[id^=select_word_]').select2({
                placeholder: 'Seleccionar vogal...'
            });
            // Clone new Vowels
            $(document).on('click', '.button_add_vowels', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent();

                var html = $('.add_vowels_clone').children();

                var new_index = parseInt(html.find("[id^='vowels_word_']")[0].id.match(/\d+/)[0]) + 1;

                html.find('.question_number>span').text('Palavra ' + (new_index + 1));

                html.find("[id^='vow_word_perc_delimiter_']").attr('id', 'vow_word_perc_delimiter_'+new_index);

                html.find("[name^='vowels_word_']").attr('name', 'vowels_word_'+new_index);
                html.find("[id^='vowels_word_']").attr('id', 'vowels_word_'+new_index);

                html.find("[id^='selects_row_word_']").attr('id', 'selects_row_word_'+new_index);
                
                html = html.clone();

                $(paste_before).before(html);
                
            });
            // Generate multiple selects on KEYUP
            $(document).on('keyup', '[id^="vowels_word_"]', function(e){
                e.preventDefault();
                var word_id = parseInt(this.id.match(/\d+/)[0]);
                var word = $(this).val();
                var regex_match = word.match(/<%[a-zA-Z ]+%>/gm);
                if(regex_match){

                    regex_match.forEach(function (value, index) {

                        if($('#select_word_' + word_id + '_vowel_' + index).length){
                            return;
                        }

                        var new_vowel_select = '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 mb-1 d-flex">';
                        new_vowel_select += '<p class="exercise_level align-self-center m-0">'+(index + 1)+'ª&nbsp;&nbsp;</p>';
                        new_vowel_select += '<select name="select_word_' + word_id + '_vowel_' + index+'" id="select_word_' + word_id + '_vowel_' + index+'" class="form-control select_vowels_class"></select>';
                        new_vowel_select += '</div>';

                        $('#selects_row_word_'+word_id).append(new_vowel_select);
                        
                        updateVowelSelects(index, word_id);

                        $('#select_word_' + word_id + '_vowel_' + index).select2({
                            placeholder: 'Seleccionar vogal...'
                        });
                        
                    });
                    
                }
                else if(!regex_match){
                    $('#selects_row_word_'+word_id).empty();
                }
                // Delete selects "a mais"
                $('[id^="select_word_'+word_id+'"]').each(function(index, element){
                    var check_vowel_id = parseInt(element.id.match(/\d+/g)[1]);
                    if(!regex_match){
                        $('#select_word_' + word_id + '_vowel_0').parent().remove();
                        $('#select_word_' + word_id + '_vowel_0').remove();
                        return;
                    }
                    if(check_vowel_id >= regex_match.length){
                        $(element).parent().remove();
                        $(element).remove();
                    }
                });
                
            });
            // <% %> button
            $(document).on('click', '[id^="vow_word_perc_delimiter_"]', function(e){
                e.preventDefault();
                var word_id = parseInt(this.id.match(/\d+/)[0]);
                var $txt = $("#vowels_word_" + word_id);
                var caretPos = $txt[0].selectionStart;
                var textAreaTxt = $txt.val();
                var txtToAdd = "<% %>";
                $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
                $txt.keyup();
                $txt.focus();
            });
            // Update all Vowel Selects
            $(document).on('change', '#possible_vowels', function(e){
                updateVowelSelects();
            });
            function updateVowelSelects(index = null, word_id = null) {
                var possible_vowels_selected = $('#possible_vowels').find(':selected');
                if(!index && !word_id){
                    $('[id^="select_word_"]').empty();
                }
                else{
                    $('#select_word_' + word_id + '_vowel_' + index).empty();
                }
                possible_vowels_selected.each(function(possible_vowels_index, possible_vowels_element){
                    var new_option = new Option(possible_vowels_element.text, possible_vowels_element.value);
                    if(!index && !word_id){
                        $('[id^="select_word_"]').each(function(select_vowel_index, select_vowel_element){
                            $(select_vowel_element)
                                .append('<option value="'+new_option.value+'">'+new_option.text+'</option>');
                        });
                    }
                    else{
                        $('#select_word_' + word_id + '_vowel_' + index).append(new_option);
                    }
                });
            }
            
            // 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                }
            });

            function updateAllMessageForms()
            {
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
            }
            //


            // SUBMIT ENABLED FORM
            
            var question_id = $('#question_id_hidden').val();

            $(document).on('click', '#submit_enabled_form', function(e){
                updateAllMessageForms();

                var exercise_id = $('#exercise_id_hidden').val();
                var url = question_id ? '/exercicios/'+exercise_id+'/questao/editar/'+question_id : '/exercicios/'+exercise_id+'/questao/criar';

                if($('#model_question_id_hidden').val() == "true"){
                    url = '/exercicios/'+exercise_id+'/questao/criar';
                }

                var form_id = $('form.question-form.form-enabled').attr('id');
                var formData = new FormData($('form.question-form.form-enabled')[0]);
                var question_subtype;

                if(typeof form_id == 'undefined'){
                    $('.question_type_error').text('Escolha um tipo de questão e preencha os seus campos.');
                    $('.question_type_error').removeAttr('hidden');
                    return false;
                }

                if (form_id.split('-').length > 2) {
                    question_subtype = form_id.split('-')[2];
                }
                else{
                    question_subtype = 'same_type_and_subtype';
                }
                
                switch (question_subtype) {
                    case "images":
                        question_subtype_id = "2";
                        break;
                    case "audio":
                        question_subtype_id = "3";
                        break;
                    case "categories":
                        question_subtype_id = "4";
                        break;
                    case "shuffle":
                        question_subtype_id = "5";
                        break;
                    case "text_words":
                        question_subtype_id = "6";
                        break;
                    case "questions":
                        question_subtype_id = "8";
                        break;
                    case "intruder":
                        question_subtype_id = "9";
                        break;
                    case "sentences":
                        question_subtype_id = "14";
                        break;
                    case "words":
                        question_subtype_id = "15";
                        break;
                    case "assort_images":
                        question_subtype_id = "16";
                        break;
                    case "same_type_and_subtype":
                        question_subtype_id = 'same_type_and_subtype';
                        break;
                    default:
                        question_subtype_id = 'same_type_and_subtype';
                        break;
                }

                // FormData append outside form inputs
                formData.append($('#question_name')[0].name, $('#question_name')[0].value);
                formData.append($('#question_type')[0].name, $('#question_type')[0].value);
                formData.append('question_subtype', question_subtype_id);
                formData.append($('#question_reference')[0].name, $('#question_reference')[0].value);
                formData.append($('#question_description')[0].name, $('#question_description')[0].value);
                formData.append($('#correction_required')[0].name, $('#correction_required')[0].value);
                formData.append($('#question_score')[0].name, $('#question_score')[0].value);
                if(question_id){
                    formData.append('exercise_question_section', $('#question_section_hidden').val());
                }
                else{
                    formData.append('exercise_question_section', $('#exercise_question_section')[0].value);
                }

                if($('#model_question_id_hidden').val() == "true"){
                    formData.set('exercise_question_section', $('#exercise_question_section')[0].value);
                    formData.append('question_model_id', question_id);
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if(response && response.status == 'success'){
                            window.location = response.url + '?land_on_structure_tab=true';
                        }
                        else if(response.status == 'error'){
                            // question_title_error
                            // question_type_error
                            // question_reference_error
                            // question_description_error
                            Object.keys(response.errors).forEach(function (key) {
                                if(key == 'question_name'){
                                    $('.question_title_error').text(response.errors[key]);
                                    $('.question_title_error').removeAttr('hidden');
                                }
                                if(key == 'question_reference'){
                                    $('.question_reference_error').text(response.errors[key]);
                                    $('.question_reference_error').removeAttr('hidden');
                                }
                                if(key == 'question_description'){
                                    $('.question_description_error').text(response.errors[key]);
                                    $('.question_description_error').removeAttr('hidden');
                                }
                                if(key == 'question_type'){
                                    $('.question_type_error').text(response.errors[key]);
                                    $('.question_type_error').removeAttr('hidden');
                                }
                            });
                        }
                    }
                });
            });


            // QUESTIONS
            updateQuestionOnEdit(question_id);
            function updateQuestionOnEdit(question_id) {
                if(question_id){
                    var question_type_id = $('#question_type_id_hidden').val();
                    var question_type_name = $('#question_type_name_hidden').val();
                    var question_subtype_id = $('#question_subtype_id_hidden').val();
                    var question_subtype_name = $('#question_subtype_name_hidden').val();
                    $('#question_type').val(question_type_id).trigger('change');
                    $('#question_score').val($('#question_avaliation_score_hidden').val()).trigger('change');
                    if(question_subtype_id == 7){
                        $('[id^="true_or_false_select_"]').select2();
                    }
                    else{
                        $('#true_or_false_select_0').select2();
                    }
                }
            }

            // Models
            $(document).on('change', '#question_model', function(){
                var exercise_id = $('#exercise_id_hidden').val();
                var model_question_id = $(this).val();
                var exercise_question_section = $('#exercise_question_section').val();
                $.ajax({
                    url: '/exercicios/'+exercise_id+'/questao/criar',
                    type: "GET",
                    data: {model_question_id : model_question_id, exercise_question_section : exercise_question_section},
                    success: function (response) {
                        if(response && response.status == 'success'){
                            window.location = response.url;
                        }
                        else if(response.status == 'error'){
                        }
                    }
                });
            });
        });

    </script>

@stop