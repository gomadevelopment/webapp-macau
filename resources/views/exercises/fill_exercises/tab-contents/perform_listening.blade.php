<div class="row mb-5">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card-body">

            <div class="row mb-4" style="place-content: center;">
                <div class="form-group">
                    <video controls="true" name="media" width="100%" height="100%" style="background-color: black;">
                        <source src="{{asset('/assets/backoffice_assets/videos/dummy_video.mp4')}}" type="video/mp4">
                    </video>
                </div>
            </div>

            <div class="custom-tab customize-tab tabs_creative">
                <ul class="nav nav-tabs p-0 b-0 m-auto" id="perform_listening_tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="ex1-tab" data-toggle="tab" href="#ex1" role="tab" aria-controls="ex1" aria-selected="false" style="padding: 8px 30px !important;">
                            Exercício 1
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="ex2-tab" data-toggle="tab" href="#ex2" role="tab" aria-controls="ex2" aria-selected="false" style="padding: 8px 30px !important;">
                            Exercício 2
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="perform_listening_tabs_content">
                    
                    <div class="tab-pane fade" id="ex1" role="tabpanel" aria-labelledby="ex1-tab">

                        <div class="row page-title p-0" style="margin-bottom: -15px;">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group wrap m-0">
                                    <label class="label_title d-block" style="font-size: 30px;">
                                        À Escuta </label>
                                </div>
                                {{-- <div class="exercise_time wrap float-right">
                                    <p class="time_label exercise_author align-self-center">
                                        <strong style="font-size: 22px;">Ir para:</strong>
                                    </p>
                                    <div class="time_countdown time_countdown_white ml-2 mr-2" style="padding: 8px 15px !important;">
                                        00:24:38
                                    </div>
                                    <a href="#" class="pause_time" style="padding: 10px 25px !important;">
                                        Ir
                                    </a>
                                </div> --}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="label_title mb-3 d-block">
                                        Correspondência Astrid </label>
                                    <div class="d-flex float-left flex-column">
                                        <p class="exercise_author" style="margin-bottom: -10px;">
                                            Assista agora ao <strong>Programa</strong>. Comece por <strong>arrastar</strong>
                                        </p>
                                        <p class="exercise_author">
                                            <strong>a frase para os Campos correctos.</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-4">

                        {{-- Frases --}}
                        <div class="row mt-5">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="label_title d-block" style="font-size: 30px;">
                                    Frases </label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="drag_and_drop_hole origin_hole">
                                        <div class="drag_and_drop_item p-2" draggable="true">
                                            Quantos anos tem?
                                        </div>
                                    </div>
                                        
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="drag_and_drop_hole origin_hole">
                                        <div class="drag_and_drop_item p-2" draggable="true">
                                            De onde é?
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="drag_and_drop_hole origin_hole">
                                        <div class="drag_and_drop_item p-2" draggable="true">
                                            Há quantos anos está em Portugal?
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        {{-- Campos --}}
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group mb-0">
                                    <label class="label_title d-block mb-4" style="font-size: 30px;">
                                    Campos </label>
                                    <label class="label_title mb-0 d-block">
                                        Astrid responde às Perguntas </label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="drag_and_drop_hole mt-3">

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="drag_and_drop_hole mt-3">

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="drag_and_drop_hole mt-3">

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group mb-0 mt-3">
                                    <label class="label_title mb-0 d-block">
                                        Astrid não responde às Perguntas </label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="drag_and_drop_hole mt-3">

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="drag_and_drop_hole mt-3">

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="drag_and_drop_hole mt-3">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-4">

                        <div class="row mb-4">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="label_title d-block" style="font-size: 30px;">
                                    Avaliação </label>
                                    <div class="d-flex float-left flex-column">
                                        <p class="exercise_author">
                                            <strong>Pontuação:</strong> Esta questão vale <strong>20</strong> pontos.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-block text-center mt-5 mb-3">
                            <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 15px 25px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Seguinte
                            </a>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="ex2" role="tabpanel" aria-labelledby="ex2-tab">
                        
                        <div class="row page-title p-0" style="margin-bottom: -15px;">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group wrap m-0">
                                    <label class="label_title d-block" style="font-size: 30px;">
                                        À Escuta </label>
                                </div>
                                {{-- <div class="exercise_time wrap float-right">
                                    <p class="time_label exercise_author align-self-center">
                                        <strong style="font-size: 22px;">Ir para:</strong>
                                    </p>
                                    <div class="time_countdown time_countdown_white ml-2 mr-2" style="padding: 8px 15px !important;">
                                        00:24:38
                                    </div>
                                    <a href="#" class="pause_time" style="padding: 10px 25px !important;">
                                        Ir
                                    </a>
                                </div> --}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="label_title mb-3 d-block">
                                        Preenchimento de espaços </label>
                                    <div class="d-flex float-left flex-column">
                                        <p class="exercise_author" style="margin-bottom: -10px;">
                                            <strong>Arraste as Palavras</strong> para completar as frases sobre
                                        </p>
                                        <p class="exercise_author">
                                            a Astrid. O <strong>Vídeo</strong> pode ajudar.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-4">

                        {{-- Palavras --}}
                        <div class="row mt-5">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="label_title d-block" style="font-size: 30px;">
                                    Palavras </label>
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                                <div class="form-group">
                                    <div class="drag_and_drop_hole origin_hole word_hole">
                                        <div class="drag_and_drop_item word_item p-2" draggable="true">
                                            Marido
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                                <div class="form-group">
                                    <div class="drag_and_drop_hole origin_hole word_hole">
                                        <div class="drag_and_drop_item word_item p-2" draggable="true">
                                            1993
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                                <div class="form-group">
                                    <div class="drag_and_drop_hole origin_hole word_hole">
                                        <div class="drag_and_drop_item word_item p-2" draggable="true">
                                            Português
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                                <div class="form-group">
                                    <div class="drag_and_drop_hole origin_hole word_hole">
                                        <div class="drag_and_drop_item word_item p-2" draggable="true">
                                            Alemão
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                                <div class="form-group">
                                    <div class="drag_and_drop_hole origin_hole word_hole">
                                        <div class="drag_and_drop_item word_item p-2" draggable="true">
                                            Fazer
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                                <div class="form-group">
                                    <div class="drag_and_drop_hole origin_hole word_hole">
                                        <div class="drag_and_drop_item word_item p-2" draggable="true">
                                            Portugueses
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Frases --}}
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group mb-0">
                                    <label class="label_title d-block mb-4" style="font-size: 30px;">
                                    Frases </label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                <div class="form-group">
                                    <label class="label_title mb-0 d-block">
                                        <img src="{{asset('/assets/backoffice_assets/images/pt_flag_image.png')}}" alt="" class="mr-4">
                                        Astrid esteve em Portugal em 
                                        <div class="drag_and_drop_hole fill_hole word_hole ml-2 mr-2">
                                            
                                        </div>
                                        .
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                <div class="form-group">
                                    <label class="label_title mb-0 d-block">
                                        <img src="{{asset('/assets/backoffice_assets/images/pt_flag_image.png')}}" alt="" class="mr-4">
                                        Ela fala 
                                        <div class="drag_and_drop_hole fill_hole word_hole ml-2 mr-2">
                                            
                                        </div>
                                        e não foi fácil fazer uma Pós-Graduação em
                                        <div class="drag_and_drop_hole fill_hole word_hole ml-2 mr-2">
                                            
                                        </div>
                                        .
                                    </label>
                                </div>
                            </div>

                        </div>

                        <hr class="mt-4 mb-4">

                        <div class="row mb-4">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="label_title d-block" style="font-size: 30px;">
                                    Avaliação </label>
                                    <div class="d-flex float-left flex-column">
                                        <p class="exercise_author">
                                            <strong>Pontuação:</strong> Esta questão vale <strong>20</strong> pontos.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-block text-center mt-5 mb-3">
                            <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 15px 25px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Continuar
                            </a>
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>
</div>