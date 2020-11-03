@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}">

@stop

@section('content')

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

        <!-- Row -->
        <div class="row">
        
            
            <div class="col-lg-12 col-md-12 col-sm-12 order-1 order-lg-2 order-md-1">
                
                <div class="row">
            
                    <!-- Single Product -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form action="">
                            <div class="shop_grid save_article_card">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Criar Novo <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                                                    <input type="text" class="form-control" placeholder="Título do artigo">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Tags <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                                                    <div class="select2_with_search" style="border-radius: 5px; border: 2px solid #e6ebf1;">
                                                        {{-- <input type="text" class="form-control" placeholder="Pesquisar" style="border: none;">
                                                        <hr class="m-0" style="border-top: 2px solid rgba(0, 0, 0, .1);"> --}}
                                                        <select name="tags" id="tags" class="form-control" multiple  style="border: none;">
                                                            <option value=""></option>
                                                            <option value="1">Ciência</option>
                                                            <option value="2">Tecnologia</option>
                                                            <option value="3">Natureza</option>
                                                            <option value="4">Sintáx</option>
                                                            <option value="5">Geografia</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Categoria <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 p-0">
                                                        <select name="categories" id="categories" class="form-control">
                                                            <option value=""></option>
                                                            <option value="1">Gramática</option>
                                                            <option value="2">Ciência</option>
                                                            <option value="3">Desporto</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Descrição <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                                                    <textarea name="description" id="description" cols="30" rows="4" placeholder="Descrição do artigo"></textarea>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <form action=""></form>
                                                    <label>Media <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                                                    <div class="col-lg-9 col-md-9 col-sm-12 p-0">
                                                        <div id="dropzone">
                                                            <form class="dropzone needsclick" id="form-dropzone" action="#">
                                                                <div class="dz-message needsclick">
                                                                    <img src="{{asset('/assets/backoffice_assets/icons/Upload.svg')}}" alt="">
                                                                    <br>
                                                                    Arraste e solte os seus ficheiros aqui 
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="" class="btn search-btn comment_submit">Gravar <img src="{{asset('/assets/backoffice_assets/icons/save.svg')}}" alt="" style="margin-left: 10px;"></button>
                        </form>
                    </div>
                    
                </div>
                
                
            </div>
        
        </div>
        <!-- Row -->
        
    </div>
</section>

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
<!-- ============================ Find Courses with Sidebar End ================================== -->

@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https'))}}"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https'))}}"></script>
    <script src="{{asset('/assets/js/ckeditor/ckeditor.js', config()->get('app.https'))}}"></script>
    <script src="{{asset('/assets/js/ckeditor/config.js', config()->get('app.https'))}}"></script>

    <script src="{{asset('/assets/js/dropzone/dist/dropzone.js', config()->get('app.https'))}}"></script>

    <script>
        function openNav() {
            document.getElementById("filter-sidebar").style.width = "320px";
        }

        function closeNav() {
            document.getElementById("filter-sidebar").style.width = "0";
        }

        CKEDITOR.replace( 'description' , {
            language: 'pt'
        });

        Dropzone.autoDiscover = false;
        $(function(){
            $('#categories').select2({
                placeholder: "Escolher categoria..."
            });

            $('#tags').select2({
                placeholder: "Pesquisar"
            });

            $('li.select2-search.select2-search--inline').css('padding', '0px !important');

            $('#tags').on('change', function(){
                    console.log($(this).val());

                if($(this).val() == null){
                    console.log('EMPTY');
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

            
            var dropzone = new Dropzone('#form-dropzone', {
                previewTemplate: document.querySelector('#preview-template').innerHTML,
                addRemoveLinks: true,
                parallelUploads: 2,
                thumbnailHeight: 120,
                thumbnailWidth: 120,
                maxFilesize: 3,
                filesizeBase: 1000,
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

            var minSteps = 6,
                maxSteps = 60,
                timeBetweenSteps = 100,
                bytesPerStep = 100000;

            dropzone.uploadFiles = function(files) {
                var self = this;

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
                }
            }
        });
        
    </script>

@stop