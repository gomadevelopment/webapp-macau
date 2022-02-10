@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}?v=2.2">

@stop

@section('content')

@if (session('restrict_page_error'))
    <div class="global-alert alert alert-danger" role="alert">
        {{session('restrict_page_error')}}
    </div>
@endif

<!-- ============================ Page Title Start================================== -->
<section class="page-title articles">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <div class="wrap">
                    <h1 class="title">Artigo</h1>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- ============================ Page Title End ================================== -->	

<!-- ============================ Create / Edit article ================================== -->
<section class="pt-0">
    <div class="container">
        <div class="alert alert-success successMsg global-alert" style="display:none;" role="alert">

        </div>

        <div class="alert alert-danger errorMsg global-alert" style="display:none;" role="alert">

        </div>
        <div class="row">
            
            <div class="col-lg-12 col-md-12 col-sm-12 order-1 order-lg-2 order-md-1">
                
                <div class="row">
            
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form method="POST" id="save_article_form" novalidate="true" action="{{ $article->id ? '/artigos/editar/' . $article->id : '/artigos/criar' }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="article_id_hidden" id="article_id_hidden" value="{{ $article->id ? $article->id : null }}">
                            <div class="shop_grid save_article_card">
                                <div class="row">
                                    {{-- <div class="col-12">
                                        @if (session('save_article_error'))
                                            <div class="alert alert-danger">
                                                {{ session('save_article_error') }}
                                            </div>
                                        @endif
                                    </div> --}}
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Criar Novo</label>
                                                    <input type="text" name="title" class="form-control" placeholder="Título do artigo"
                                                    value="{{ old('title', $article->title) }}">
                                                    <span class="error-block-span pink title_error" hidden>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Tags</label>
                                                    <div class="select2_with_search">
                                                        <select name="tags[]" id="tags" class="form-control" multiple  style="border: none;">
                                                            @foreach ($tags as $tag)
                                                                <?php 
                                                                    $selected = '';
                                                                    if (!empty($article->article_tags)) {
                                                                        foreach ($article->article_tags as $article_tag) {
                                                                            if ($article_tag->id == $tag->id) {
                                                                                $selected = 'selected';
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                ?>                                                        
                                                                <option value="{{ $tag->id }}" <?php echo $selected;?>>{{ $tag->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Tema</label>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 p-0">
                                                        <select name="category" id="category" class="form-control">
                                                            @foreach ($article_categories as $category)
                                                                <option value="{{ $category->id }}" {{ $article->id && $article->article_category_id == $category->id ? 'selected' : '' }}
                                                                    >{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Foto de Capa</label>
                                                    <div class="col-lg-9 col-md-9 col-sm-12 p-0">
                                                        <div id="dropzone">
                                                            <div class="dropzone needsclick" id="form-dropzone-poster">
                                                                <div class="dz-message needsclick">
                                                                    <img src="{{asset('/assets/backoffice_assets/icons/Upload.svg')}}" alt="">
                                                                    <br>
                                                                    Arraste e solte a foto de capa do artigo aqui
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <span class="error-block-span pink poster_files_error" hidden>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Descrição</label>
                                                    <textarea class="form-control" name="text" id="text" cols="30" rows="4" placeholder="Descrição do artigo">{{ old('text', $article->text) }}</textarea>
                                                    <span class="error-block-span pink text_error" hidden>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Media</label>
                                                    <div class="col-lg-9 col-md-9 col-sm-12 p-0">
                                                        <div id="dropzone">
                                                            <div class="dropzone needsclick" id="form-dropzone-media">
                                                                <div class="dz-message needsclick">
                                                                    <img src="{{asset('/assets/backoffice_assets/icons/Upload.svg')}}" alt="">
                                                                    <br>
                                                                    Arraste e solte os seus ficheiros aqui 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" class="btn search-btn comment_submit save_article_form_button">Gravar <img src="{{asset('/assets/backoffice_assets/icons/save.svg')}}" alt="" style="margin-left: 10px;"></button>
                        </form>
                    </div>
                    
                </div>
                
            </div>
        
        </div>
        
    </div>
</section>

<div hidden>
    @if($article->id)
        <img src="{{ '/webapp-macau-storage/articles/'.$article->id.'/poster/'.$article->poster->media_url }}"
            alt="" id="existing_article_poster"/>
        <input type="file" name="qq" id="qq" value="">
        @foreach ($article->medias() as $media)
            <img src="{{ '/webapp-macau-storage/articles/'.$article->id.'/medias/'.$article->media->media_url }}"
                alt="" class="existing_article_medias"/>
        @endforeach
    @endif
</div>

<DIV id="preview-template" style="display: none;">
    <DIV class="dz-preview dz-file-preview">
        <DIV class="dz-image"><IMG data-dz-thumbnail=""></DIV>
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

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https')) }}?v=2.2"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https')) }}?v=2.2"></script>
    <script src="{{asset('/assets/js/ckeditor5/ckeditor.js', config()->get('app.https')) }}?v=2.2"></script>
    <script src="{{asset('/assets/js/ckeditor5/translations/pt.js', config()->get('app.https')) }}?v=2.2"></script>

    <script src="{{asset('/assets/js/dropzone/dist/dropzone.js', config()->get('app.https')) }}?v=2.2"></script>

    <script>
        function openNav() {
            document.getElementById("filter-sidebar").style.width = "320px";
        }

        function closeNav() {
            document.getElementById("filter-sidebar").style.width = "0";
        }

        Dropzone.autoDiscover = false;

        Dropzone.prototype.defaultOptions.dictDefaultMessage = "Largue aqui os seus ficheiros para carregamento";
        Dropzone.prototype.defaultOptions.dictFallbackMessage = "O seu browser não suporta arrastar e largar ficheiros.";
        Dropzone.prototype.defaultOptions.dictFileTooBig = "Ficheiro demasiado grande ({{'filesize'}}MiB). Máximo: {{'maxFilesize'}}MiB.";
        Dropzone.prototype.defaultOptions.dictInvalidFileType = "Não pode carregar ficheiros deste tipo.";
        Dropzone.prototype.defaultOptions.dictResponseError = "Servidor respondeu com o código: {{'statusCode'}} .";
        Dropzone.prototype.defaultOptions.dictCancelUpload = "Cancelar Carregamento";
        Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "Tem a certeza que pretende cancelar este carregamento?";
        Dropzone.prototype.defaultOptions.dictRemoveFile = "Remover ficheiro";
        Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "Não pode carregar mais ficheiros.";

        $(function(){

            ClassicEditor.create(document.querySelector( '#text' ), {
                language: 'pt',
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', '|',
                        'link', '|',
                        'outdent', 'indent', '|',
                        'bulletedList', 'numberedList', '|',
                        'insertTable', '|',
                        'blockQuote',
                    ],
                    shouldNotGroupWhenFull: true
                },

                link: {
                    defaultProtocol: "https://",
                    decorators: {
                        openInNewTab: {
                            mode: "manual",
                            label: "Abrir numa nova janela",
                            defaultValue: true, // This option will be selected by default.
                            attributes: {
                                target: "_blank",
                                rel: "noopener noreferrer"
                            }
                        }
                    }
                }
            })
            .then(editor => {
                editor.ui.focusTracker.on( 'change:isFocused', ( evt, name, value ) => {
                    if(value){
                        $('.ck.ck-reset.ck-editor').addClass('focused');
                    }
                    else{
                        $('.ck.ck-reset.ck-editor').removeClass('focused');
                    }
                } );
                text = editor;
            })
            .catch(error => {
                console.error(error);
            });


            $('#category').select2({
                placeholder: "Escolher categoria",
                dropdownAutoWidth : false
            });

            $('#tags').select2({
                placeholder: "Pesquisar"
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

            var article_id = $('#article_id_hidden').val();
            var dropzone_poster_counter = 0;
            var dropzone_medias_counter = 0;

            var dropzone_poster = new Dropzone('#form-dropzone-poster', {
                url: '/dropzone_poster',
                previewTemplate: document.querySelector('#preview-template').innerHTML,
                addRemoveLinks: true,
                parallelUploads: 2,
                uploadMultiple: false,
                maxFiles: 1,
                thumbnailHeight: 120,
                thumbnailWidth: 120,
                // maxFilesize: 3,
                // filesizeBase: 1000,
                acceptedFiles:'image/*',
                init: function(e) {
                    
                    this.on("maxfilesexceeded", function(file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    });
                    if(dropzone_poster_counter == 0){
                        var thisDropzone = this;
                        if(article_id){
                            $.get('/artigos/get_article_poster/' + article_id, function(data) {
                                if(data != 'no_poster'){
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
                    dropzone_poster_counter = 1;
                },
                thumbnail: function(file, dataUrl) {
                    if (file.previewElement) {
                    file.previewElement.classList.remove("dz-file-preview");
                    var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
                    for (var i = 0; i < images.length; i++) {
                        var thumbnailElement = images[i];
                        thumbnailElement.alt = file.name;
                        thumbnailElement.src = dataUrl;
                    }
                    setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
                    }
                }

            });
            
            var dropzone_media = new Dropzone('#form-dropzone-media', {
                url: '/dropzone_media',
                previewTemplate: document.querySelector('#preview-template').innerHTML,
                addRemoveLinks: true,
                parallelUploads: 2,
                thumbnailHeight: 120,
                thumbnailWidth: 120,
                // maxFilesize: 3,
                // filesizeBase: 1000,
                acceptedFiles:'image/*',
                init: function(e) {
                    if(dropzone_medias_counter == 0){
                        var thisDropzone = this;
                        if(article_id){
                            $.get('/artigos/get_article_medias/' + article_id, function(data) {
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
                    }
                    setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
                    }
                }

            });

            var poster_files = [];
            var media_files = [];

            var minSteps = 6,
                maxSteps = 60,
                timeBetweenSteps = 100,
                bytesPerStep = 100000;

            dropzone_poster.uploadFiles = function(files) {
                var self = this;
                if($('#form-dropzone-poster .dz-preview.dz-complete.dz-image-preview')){
                    $('#form-dropzone-poster .dz-preview.dz-complete.dz-image-preview').remove();
                }
                for (var i = 0; i < files.length; i++) {

                    var file = files[i];
                    // if(!file.type.match('image.*')){
                    //     alert('Não foi possível associar esse tipo de ficheiro. Associe ficheiro de imagem.');
                    //     return false;
                    // }
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
                        // console.log(file);
                    }
                }
                poster_files = files;
            }

            dropzone_media.uploadFiles = function(files) {
                var self = this;

                for (var i = 0; i < files.length; i++) {

                    var file = files[i];
                    // if(!file.type.match('image.*')){
                    //     alert('Não foi possível associar esse tipo de ficheiro. Associe ficheiro de imagem.');
                    //     return false;
                    // }
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
                    media_files.push(file);

                }
                // media_files = files;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                }
            });

            // function updateAllMessageForms()
            // {
            //     for (instance in CKEDITOR.instances) {
            //             CKEDITOR.instances[instance].updateElement();
            //     }
            // }

            $(document).on('click', '.save_article_form_button', function(){
                // updateAllMessageForms();
                var article_id = $('#article_id_hidden').val();
                var url = article_id ? '/artigos/editar/' + article_id : '/artigos/criar';

                var formData = new FormData($("#save_article_form")[0]);

                formData.set('text', text.getData());

                if(poster_files[0]){
                    formData.append('poster_files', poster_files[0]);
                }
                else if(!poster_files[0] && $('#form-dropzone-poster .dz-preview.dz-complete.dz-image-preview')){
                    var existing_poster = $('#form-dropzone-poster .dz-preview .dz-details .dz-filename span').text();
                    formData.append('poster_files', existing_poster);
                }
                // if(media_files != []){
                //     media_files.forEach(element => {
                //         formData.append('media_files[]', element);
                //     });
                // }

                if(media_files == []){
                    $('#form-dropzone-media .dz-preview .dz-details .dz-filename span').each(function(index, element){
                        formData.append('media_files[]', $(element).text());
                    });
                }
                else{
                    media_files.forEach(element2 => {
                        
                        $('#form-dropzone-media .dz-preview .dz-details .dz-filename span').each(function(index, element){
                            if(element2.name != $(element).text()){
                                formData.append('media_files[]', $(element).text());
                                // console.log(element2.name, $(element).text());
                            }
                            else{
                                formData.append('media_files[]', element2);
                                // console.log(element2.name, $(element).text());
                            }
                            
                        });
                    });
                }
                
                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if(response && response.status == 'success'){
                            window.location = response.url;
                        }
                        else if(response.status == 'error'){

                            Object.keys(response.errors).forEach(function (key) {
                                if(key == 'title'){
                                    $('.title_error').text(response.errors[key]);
                                    $('.title_error').removeAttr('hidden');
                                }
                                if(key == 'text'){
                                    $('.text_error').text(response.errors[key]);
                                    $('.text_error').removeAttr('hidden');
                                }
                                if(key == 'poster_files'){
                                    $('.poster_files_error').text(response.errors[key]);
                                    $('.poster_files_error').removeAttr('hidden');
                                }
                                // document.write('key: ' + key + ', value: ' + sArray[key] + '<br>');
                            });
                        }
                    }
                });
            });
            
        });
        
    </script>

@stop