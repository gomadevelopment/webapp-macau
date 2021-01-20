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
                            Os meus Modelos</label>
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
                                    <option value="1">Informação</option>
                                    <option value="2">Correspondência</option>
                                    <option value="3">Preenchimento</option>
                                    <option value="4">Verdadeiro ou Falso</option>
                                    <option value="5">Escolha Múltipla</option>
                                    <option value="6">Questões Livres</option>
                                    <option value="7">Diferenças</option>
                                    <option value="8">Correção de Afirmações</option>
                                    <option value="9">Conteúdo gerado automaticamente</option>
                                    <option value="10">Ordenação</option>
                                    <option value="11">Vogais</option>
                                </select>
                            </div>
                            <div class="col-xs-0 col-sm-0 col-md-0 col-lg-2"></div>
                        </div>

                        <div class="row mb-2">
                             <div class="col-sm-12 col-md-12 col-lg-12">
                                <input name="exercise_reference" id="exercise_reference" type="text" class="form-control" placeholder="Referência da questão">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input name="exercise_description" id="exercise_description" type="text" class="form-control" placeholder="Descrição da questão a mostrar ao aluno">
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

            $('#true_or_false_select_0').select2();

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
            }

            function showSpecificQuestionType(selector){
                $(selector).show();
            }

            $(document).on('change', '#question_type', function(){
                $('.choose_question_type').hide();

                $('#correction_required').attr('checked', false);
                $('#correction_required').removeAttr('onclick');

                if($(this).val() == 1){
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.information'));
                }
                else if($(this).val() == 2){
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.correspondence'));
                }
                else if($(this).val() == 3){
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.fill_options'));
                }
                else if($(this).val() == 4){
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.true_or_false'));
                }
                else if($(this).val() == 5){
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.multiple_choice'));
                }
                else if($(this).val() == 6){
                    hideAllQuestionTypes();
                    $('#correction_required').prop('checked', true);
                    $('#correction_required').attr('onclick', 'return false;');
                    showSpecificQuestionType($('.to_choose.free_question'));
                }
                else if($(this).val() == 7){
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.differences'));
                }
                else if($(this).val() == 8){
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.correction_of_statement'));
                }
                else if($(this).val() == 9){
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.automatic_content'));
                }
                else if($(this).val() == 10){
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.assortment'));
                }
                else if($(this).val() == 11){
                    hideAllQuestionTypes();
                    showSpecificQuestionType($('.to_choose.vowels'));
                }
            });

            // $('#question_type').val(11).trigger("change");

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

                // if($(this).hasClass('associate_media_remove') || $(this).hasClass('corr_expressions_remove')){
                //     $(this).parent().prev().prev().remove();
                //     $(this).parent().prev().remove();
                //     $(this).parent().remove();
                // }
                // else if($(this).hasClass('remove_multiple_choice_answer')){
                //     // $(this).parent().prev().prev().remove();
                //     $(this).parent().prev().remove();
                //     $(this).parent().remove();
                // }
                // else if($(this).hasClass('remove_entire_question')){
                //     $(this).parent().parent().next().remove();
                //     $(this).parent().parent().remove();
                // }
                // else{
                //     $(this).parent().remove();
                // }

                // if(exercise_type_classes.hasClass('automatic_content')){
                //     $(this).parent().prev().remove();
                //     $(this).parent().remove();
                // }
            });

            /*
                TEMPLATE TYPES
            */

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
                                "<img class=\"associate_media_thumbnail_remove\" src=\"/assets/backoffice_assets/icons/Cross.svg\">" +
                                "</a>"
                            ).insertAfter("#corr_image_file_input_" + id_index);

                            $('#corr_image_button_' + id_index).hide();

                            $(".associate_media_thumbnail_remove").click(function(e){
                                e.stopImmediatePropagation();
                                e.preventDefault();
                                $('#corr_image_button_' + id_index).show();
                                $('#corr_image_file_input_' + id_index).remove();
                                $(this).parent(".associate_media_preview").remove();
                            });
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

                            $(".associate_media_thumbnail_remove").click(function(e){
                                e.stopImmediatePropagation();
                                e.preventDefault();
                                $('#corr_audio_button_' + id_index).show();
                                $('#corr_audio_file_input_' + id_index).remove();
                                $(this).parent(".associate_media_preview").remove();
                            });
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

                var html = $('.add_correspondence_categories_answer_clone').children();

                // Change answers names and ids
                var question_number = parseInt($(this)[0].id.match(/\d+/g)[0]);
                var answer_number = parseInt($(this)[0].id.match(/\d+/g)[1]);

                html.find("[name^='multiple_choice_correct_answer_']").attr('name', 'multiple_choice_correct_answer_'+answer_number+'_question_'+question_number);
                html.find("[id^='multiple_choice_correct_answer_']").attr('id', 'multiple_choice_correct_answer_'+answer_number+'_question_'+question_number);

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

                html.find("[name^='true_or_false_select_']").attr('name', 'true_or_false_select_'+new_index);
                html.find("[id^='true_or_false_select_']").attr('id', 'true_or_false_select_'+new_index);

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

                            $(".associate_media_thumbnail_remove").click(function(e){
                                e.stopImmediatePropagation();
                                e.preventDefault();
                                $('#true_or_false_associate_media_file_button_' + id_index).show();
                                $('#true_or_false_associate_media_file_input_' + id_index).remove();
                                $(this).parent(".associate_media_preview").remove();
                            });
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            });


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

                            $(".associate_media_thumbnail_remove").click(function(e){
                                e.stopImmediatePropagation();
                                e.preventDefault();
                                $('#m_c_associate_media_button_' + id_index).show();
                                $('#m_c_associate_media_file_input_' + id_index).remove();
                                $(this).parent(".associate_media_preview").remove();
                            });
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
                html.find('.add_intruders_question_').attr('id', 'add_intruders_question_'+question_number+'_answer_1');

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

                            $(".associate_media_thumbnail_remove").click(function(e){
                                e.stopImmediatePropagation();
                                e.preventDefault();
                                $('#fill_associate_media_file_button_' + id_index).show();
                                $('#fill_associate_media_file_input_' + id_index).remove();
                                $(this).parent(".associate_media_preview").remove();
                            });
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

                html.find("[id^='perc_delimiter_']").attr('id', 'perc_delimiter_'+new_index);

                html.find("[name^='fill_text_word_']").attr('name', 'fill_text_word_'+new_index);
                html.find("[id^='fill_text_word_']").attr('id', 'fill_text_word_'+new_index);

                html.find("[id^='selects_row_text_words_']").attr('id', 'selects_row_text_words_'+new_index);

                html = html.clone();

                $(paste_before).before(html);

                // applyCKEditor('fill_text_word_' + new_index);
                
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
                        new_vowel_select += '<select name="select_text_word_' + word_id + '_option_' + index+'" id="select_text_word_' + word_id + '_option_' + index+'" class="form-control select_vowels_class" multiple></select>';
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
            $(document).on('click', '[id^="fill_text_word_perc_delimiter_"]', function(e){
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

                            $(".associate_media_thumbnail_remove").click(function(e){
                                e.stopImmediatePropagation();
                                e.preventDefault();
                                $('#f_q_associate_media_button_' + id_index).show();
                                $('#f_q_associate_media_file_input_' + id_index).remove();
                                $(this).parent(".associate_media_preview").remove();
                            });
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

            // Clone new Assort Sentences
            $(document).on('click', '.button_add_assort_sentence', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_assort_sentences_clone').children();

                var new_index = parseInt(html.find("[id^='assort_sentence_question_']")[0].id.match(/\d+/)[0]) + 1;

                // html.find('.sentence_number>span').text('Frase ' + (new_index + 1));

                html.find("[name^='assort_sentence_question_']").attr('name', 'assort_sentence_question_'+new_index);
                html.find("[id^='assort_sentence_question_']").attr('id', 'assort_sentence_question_'+new_index);

                html = html.clone();

                $(paste_before).append(html);
                
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
            $(document).on('click', '.button_add_assort_images', function(e){
                e.preventDefault();
                var paste_before = $(this).parent().parent().prev();

                var html = $('.add_assort_images_clone').children();

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

                            $(".associate_media_thumbnail_remove").click(function(e){
                                e.stopImmediatePropagation();
                                e.preventDefault();
                                $('#assort_image_media_button_' + id_index).show();
                                $('#assort_image_media_file_input_' + id_index).remove();
                                $(this).parent(".associate_media_preview").remove();
                            });
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
        });

    </script>

@stop