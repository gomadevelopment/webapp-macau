@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}?v=1.2">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}?v=1.2">

@stop

@section('content')

<!-- ============================ Page Title Start================================== -->
<section class="page-title articles">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <div class="wrap">
                    @if (isset($details_page) && $details_page)
                        <h1 class="title details_page_title">
                            Detalhes do exercício: "{{ $exercise->title }}"
                        </h1>
                    @elseif(isset($exercise->id))
                        <h1 class="title edit_title">Editar exercício</h1>
                    @else
                        <h1 class="title">Criar exercício</h1>
                    @endif
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
                <ul class="nav nav-tabs p-2 b-0" id="create_exercise_tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ $land_on_structure_tab ? '' : 'active' }}" id="begin-tab" data-toggle="tab" href="#begin" role="tab" aria-controls="begin" aria-selected="{{ $land_on_structure_tab ? 'false' : 'true' }}">
                            <img src="{{asset('/assets/backoffice_assets/icons/Home.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Home_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="intro-tab" data-toggle="tab" href="#intro" role="tab" aria-controls="intro" aria-selected="false">
                            <img src="{{asset('/assets/backoffice_assets/icons/File.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/File_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Introdução</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $land_on_structure_tab ? 'active' : '' }} {{ isset($exercise->id) ? '' : 'disabled' }}" id="structure-tab" data-toggle="tab" href="#structure" role="tab" aria-controls="structure" aria-selected="{{ $land_on_structure_tab ? 'true' : 'false' }}">
                            <img src="{{asset('/assets/backoffice_assets/icons/Layers.svg')}}" class="white_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Layers_black.svg')}}" class="black_icon" alt="" style="margin-bottom: 3px; margin-right: 5px;">
                            Estrutura</a>
                    </li>
                </ul>

                <div class="preloader ajax col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="height: 500px !important; margin: auto !important;"><span></span><span></span></div>

                <form method="POST" id="save_exercise_form" novalidate="true" action="{{ $exercise->id ? '/exercicios/editar/' . $exercise->id : '/exercicios/criar' }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="exercise_id_hidden" id="exercise_id_hidden" value="{{ $exercise->id ? $exercise->id : null }}">
                    <div class="tab-content" id="create_exercise_tabs_content">
                        {{-- BEGIN TAB --}}
                        <div class="tab-pane fade {{ $land_on_structure_tab ? '' : 'show active' }}" id="begin" role="tabpanel" aria-labelledby="begin-tab">
                            
                            @include('exercises.tab-contents.save_beginning')

                        </div>
                        {{-- INTRO TAB --}}
                        <div class="tab-pane fade" id="intro" role="tabpanel" aria-labelledby="intro-tab">

                            @include('exercises.tab-contents.save_intro')

                        </div>
                        {{-- STRUCTURE TAB --}}
                        <div class="tab-pane fade {{ $land_on_structure_tab ? 'show active' : '' }}" id="structure" role="tabpanel" aria-labelledby="structure-tab">

                            @include('exercises.tab-contents.save_structure')

                        </div>
                    </div>
                </form>

            </div>
            
        
    </div>
</section>

<DIV id="preview-template" style="display: none;">
    <DIV class="dz-preview dz-file-preview">
        <DIV class="dz-image"><IMG data-dz-thumbnail="" style="width: 120px; height: 120px;"></DIV>
        <DIV class="dz-details">
        <DIV class="dz-size"><SPAN data-dz-size=""></SPAN></DIV>
        <DIV class="dz-filename"><SPAN data-dz-name=""></SPAN></DIV>
        </DIV>

        <DIV class="dz-progress"><SPAN class="dz-upload" data-dz-uploadprogress=""></SPAN></DIV>
        <DIV class="dz-error-message"><SPAN data-dz-errormessage=""></SPAN></DIV>
        
        <div class="dz-success-mark">
        <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
            <title>Check</title>
            <desc>Created with Sketch.</desc>
            <defs></defs>
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
            <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
            </g>
        </svg>
        </div>

        <div class="dz-error-mark">
        <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
            <title>error</title>
            <desc>Created with Sketch.</desc>
            <defs></defs>
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
            <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
            </g>
            </g>
        </svg>
        </div>
    </DIV>
</DIV>
<!-- ============================ Find Courses with Sidebar End ================================== -->

@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https')) }}?v=1.2"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https')) }}?v=1.2"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/exercises.js', config()->get('app.https')) }}?v=1.2"></script>
    <script src="{{asset('/assets/js/ckeditor/ckeditor.js', config()->get('app.https')) }}?v=1.2"></script>
    <script src="{{asset('/assets/js/ckeditor/config.js', config()->get('app.https')) }}?v=1.2"></script>

    <script src="{{asset('/assets/js/dropzone/dist/dropzone.js', config()->get('app.https')) }}?v=1.2"></script>

    <script>

        CKEDITOR.replace( 'introduction' , {
            language: 'pt'
        });

        CKEDITOR.replace( 'statement' , {
            language: 'pt'
        });

        CKEDITOR.replace( 'audiovisual_desc' , {
            language: 'pt'
        });

        CKEDITOR.replace( 'audio_transcript' , {
            language: 'pt'
        });

        Dropzone.autoDiscover = false;

        $(function() {

            var exercise_id = $('#exercise_id_hidden').val();

            // Change icon image on tab change
            changeIconImage();
            function changeIconImage(){
                $('#create_exercise_tabs a.nav-link').each(function(index, element){
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

            $(document).on('click', '#create_exercise_tabs a.nav-link', function(){
                changeIconImage();
            });

            if($('#has_time:checked').length == 0){
                $('#time').attr('disabled', true);
            }
            if($('#has_interruption:checked').length == 0){
                $('#interruption_time').attr('disabled', true);
            }

            $(document).on('click', '#has_time, #has_interruption', function(){
                if($(this).is(':checked')){
                    if($(this).attr('id') == 'has_time'){
                        $('select#time').attr('disabled', false);
                    }
                    else{
                        $('select#interruption_time').attr('disabled', false);
                    }
                }
                else{
                    if($(this).attr('id') == 'has_time'){
                        $('select#time').attr('disabled', true);
                    }
                    else{
                        $('select#interruption_time').attr('disabled', true);
                    }
                }
            });

            changePageTitle('#create_exercise_tabs .nav-link.active');

            function changePageTitle(selector){
                if($(selector).hasClass('active') && $(selector).attr('id') != 'begin-tab'){
                    if($('.page-title .title:not(.details_page_title)').hasClass('edit_title')){
                        $('.page-title .title:not(.details_page_title)').text('Editar exercício: "'+$('#title').val()+'"');
                    }
                    else{
                        $('.page-title .title:not(.details_page_title)').text('Exercício: "'+$('#title').val()+'"');
                    }
                }
                else{
                    if($('.page-title .title:not(.details_page_title)').hasClass('edit_title')){
                        $('.page-title .title:not(.details_page_title)').text('Editar exercício');
                    }
                    else{
                        $('.page-title .title:not(.details_page_title)').text('Criar exercício');
                    }
                }
            }

            $(document).on('click', '#create_exercise_tabs .nav-link', function(){
                changePageTitle(this);
            });

            $('#exercise_template').select2({
                placeholder: "Escolher exercício..."
            });

            $('#category').select2({
                placeholder: "Escolher tema"
            });

            $('#level').select2({
                placeholder: "Escolher Nível"
            });

            $('#tags').select2({
                placeholder: "Pesquisar"
            });

            $('#time').select2({
                placeholder: "Sel. Tempo"
            });

            $('#interruption_time').select2({
                placeholder: "Sel. Tempo"
            });

            $('li.select2-search.select2-search--inline').css('padding', '0px !important');

            $('#tags').on('change', function(){

                if($(this).val() == null){
                    $('input.select2-search__field')
                        .prop('placeholder', 'Pesquisar')
                        .removeClass('big');
                }
                else{
                    $('input.select2-search__field')
                        .prop('placeholder', '+')
                        .addClass('big');
                }
                $('input.select2-search__field').css('padding-left', '10px !important');
                
                $('.select2-container--default .select2-selection--multiple .select2-selection__rendered li.select2-search.select2-search--inline')
                    .css('padding-top', '0px !important')
                    .css('padding-left', '10px !important');
            });

            var remove_file_button_clicked = false;

            $(document).on('click', '.dz-remove', function(){
                remove_file_button_clicked = true;
            });

            var dropzone_medias_counter = 0;

            var dropzone_media = new Dropzone('#form-dropzone-media', {
                url: '/dropzone_media',
                previewTemplate: document.querySelector('#preview-template').innerHTML,
                addRemoveLinks: true,
                parallelUploads: 2,
                uploadMultiple: false,
                maxFiles: 1,
                thumbnailHeight: 120,
                thumbnailWidth: 120,
                // maxFilesize: 3,
                // filesizeBase: 1000,
                init: function(e) {
                    this.on("maxfilesexceeded", function(file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    });
                    if(dropzone_medias_counter == 0){
                        var thisDropzone = this;
                        if(exercise_id || !remove_file_button_clicked){
                            $.get('/exercicios/get_exercise_medias/' + exercise_id, function(data) {
                                if(data != 'no_medias'){
                                    JSON.stringify(data);
                                    $.each(data, function(key,value){
                                        var mockFile = { name: value.name, size: value.size };

                                        thisDropzone.emit("addedfile", mockFile);

                                        thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.path);

                                        // Make sure that there is no progress bar, etc...
                                        thisDropzone.emit("complete", mockFile);

                                    });
                                }
                                

                            });
                        }
                            
                    }
                    dropzone_medias_counter = 1;
                },
                thumbnail: function(file, dataUrl) {
                    if (file.previewElement) {
                    file.previewElement.classList.remove("dz-file-preview");
                    var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
                    for (var i = 0; i < images.length; i++) {
                        var thumbnailElement = images[i];
                        thumbnailElement.alt = file.name;
                        thumbnailElement.src = dataUrl;
                        thumbnailElement.width = "120px";
                        thumbnailElement.height = "120px";
                    }
                    setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
                    }
                },
                removedfile: function(file){
                    
                }

            });

            var media_files = [];

            var minSteps = 6,
                maxSteps = 60,
                timeBetweenSteps = 100,
                bytesPerStep = 100000;

            dropzone_media.uploadFiles = function(files) {
                var self = this;
                if($('#form-dropzone-media .dz-preview.dz-complete.dz-image-preview')){
                    $('#form-dropzone-media .dz-preview.dz-complete.dz-image-preview').remove();
                }
                for (var i = 0; i < files.length; i++) {

                    var file = files[i];
                    totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

                    for (var step = 0; step < totalSteps; step++) {
                        var duration = timeBetweenSteps * (step + 1);
                        setTimeout(function(file, totalSteps, step) {
                            return function() {
                                file.upload = {
                                    progress: 100 * (step + 1) / totalSteps,
                                    total: file.size,
                                    bytesSent: (step + 1) * file.size / totalSteps
                                };

                                self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
                                if (file.upload.progress == 100) {
                                    file.status = Dropzone.SUCCESS;
                                    self.emit("success", file, 'success', null);
                                    self.emit("complete", file);
                                    self.processQueue();
                                }
                            };
                        }(file, totalSteps, step), duration);
                    }
                    // media_files.push(file);
                }
                media_files = files;
            }

            // Go to Intro tab button (Gravar button on beggining tab_content)
            $(document).on('click', '.go_to_intro_tab', function(e){
                e.preventDefault();
                $('a#intro-tab').click();
            });

            // Save Exercise FORM
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

            // Save POST AJAX
            $(document).on('click', '.save_exercise_form_button', function(){

                $("#save_exercise_form").hide();
                $('.preloader.ajax').show();
                $('html, body').animate({scrollTop: '0px'}, 300);

                updateAllMessageForms();
                var redirect = false;
                if($(this).hasClass('intro_save')){
                    redirect = true;
                }

                var exercise_id = $('#exercise_id_hidden').val();
                var url = exercise_id ? '/exercicios/editar/' + exercise_id : '/exercicios/criar';

                var formData = new FormData($("#save_exercise_form")[0]);

                if(media_files[0]){
                    formData.append('media_files', media_files[0]);
                }
                else if(!media_files[0] && $('#form-dropzone-media .dz-preview.dz-complete.dz-image-preview')){
                    var existing_file = $('#form-dropzone-media .dz-preview .dz-details .dz-filename span').text();
                    formData.append('media_files', existing_file);
                }
                
                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if(response && response.status == 'success'){
                            $('#exercise_id_hidden').attr('value', response.ex_id);
                            // $('#structure-tab').removeClass('disabled');
                            // $('.add_question_form').attr('action', '/exercicios/' + response.ex_id + '/questao/criar');
                            if(redirect){
                                window.location = response.url + '?land_on_structure_tab=true';
                            }
                            else{
                                $("#save_exercise_form").show();
                                $('.preloader.ajax').hide();
                            }
                        }
                        else if(response.status == 'error'){

                            $("#save_exercise_form").show();
                            $('.preloader.ajax').hide();

                            Object.keys(response.errors).forEach(function (key) {
                                if(key == 'title'){
                                    $('.title_error').text(response.errors[key]);
                                    $('.title_error').removeAttr('hidden');
                                    $('a#begin-tab').click();
                                }
                            });
                        }
                    }
                });
            });

            // Clone exercise template
            $(document).on('change', '#exercise_template', function(e){
                e.preventDefault();
                var exercise_id = $(this).val();
                if(exercise_id != 0){
                    $.ajax({
                        type: 'POST',
                        url: '/exercicios/clonar/' + exercise_id,
                        success: function(response){
                            if(response && response.status == 'success'){
                                window.location = '/exercicios/editar/' + response.clone_exercise_id;
                            }
                            else{
                                $(".errorMsg").text(response.message);
                                $(".errorMsg").fadeIn();
                                setTimeout(() => {
                                    $(".errorMsg").fadeOut();
                                }, 10000);
                            }
                        }
                    });
                }
            });

            // Delete question
            $(document).on('click', '.delete_question_button', function(e){
                e.preventDefault();
                var exercise_id = $('#exercise_id_hidden').val();
                var question_id = $(this).attr('data-id');
                if(confirm('Tem a certeza que deseja remover esta questão da sequência?')){
                    $.ajax({
                        type: 'GET',
                        url: '/exercicios/editar/'+exercise_id+'/apagar/'+question_id,
                        success: function(response){
                            if(response && response.status == 'success'){
                                $("#structure").html(response.html);
                                $(".successMsg").text(response.message);
                                $(".successMsg").fadeIn();
                                setTimeout(() => {
                                    $(".successMsg").fadeOut();
                                }, 5000);
                                if(!response.has_questions){
                                    $('#publish_exam').attr('disabled', true);
                                }
                            }
                            else{
                                $(".errorMsg").text(response.message);
                                $(".errorMsg").fadeIn();
                                setTimeout(() => {
                                    $(".errorMsg").fadeOut();
                                }, 2000);
                            }
                        }
                    });
                }
            });

        });

    </script>

@stop