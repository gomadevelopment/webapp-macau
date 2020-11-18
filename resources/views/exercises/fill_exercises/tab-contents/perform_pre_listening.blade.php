<div class="row mb-5">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card-body">

            <div class="row mb-4" style="place-content: center;">
                <div class="form-group m-2">
                    <video controls="true" name="media" width="100%" height="100%" style="background-color: black;">
                        <source src="{{asset('/assets/backoffice_assets/videos/dummy_video.mp4')}}" type="video/mp4">
                    </video>
                </div>
            </div>

            <div class="row page-title p-0" style="margin-bottom: -15px;">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group wrap m-0">
                        <label class="label_title d-block" style="font-size: 30px;">
                            Pré-Escuta </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label class="label_title mb-3 d-block">
                            Observar as Imagens </label>
                        <div class="d-flex float-left flex-column">
                            <p class="exercise_author" style="margin-bottom: -10px;">
                                Comece por associar cada Frase a uma Imagem.
                            </p>
                            <p class="exercise_author">
                                <strong>Arraste a Frase para a Imagem correcta.</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="mt-4 mb-4">

            <div class="row mb-4">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group" style="text-align: -webkit-center;">
                        <div class="drag_and_drop_image text-center">
                            <img src="{{asset('/assets/backoffice_assets/images/drag_image_1.png')}}" alt="">
                        </div>
                        <div class="drag_and_drop_hole mt-3">

                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group" style="text-align: -webkit-center;">
                        <div class="drag_and_drop_image text-center">
                            <img src="{{asset('/assets/backoffice_assets/images/drag_image_2.png')}}" alt="">
                        </div>
                        <div class="drag_and_drop_hole mt-3">

                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group" style="text-align: -webkit-center;">
                        <div class="drag_and_drop_image text-center">
                            <img src="{{asset('/assets/backoffice_assets/images/drag_image_3.png')}}" alt="">
                        </div>
                        <div class="drag_and_drop_hole mt-3">

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
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
                                Conheci um Português em Viena. Ele agora é o meu Marido.
                            </div>
                        </div>
                            
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <div class="drag_and_drop_hole origin_hole">
                            <div class="drag_and_drop_item p-2" draggable="true">
                                Acho que o português e o Alemão são duas línguas difíceis.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <div class="drag_and_drop_hole origin_hole">
                            <div class="drag_and_drop_item p-2" draggable="true">
                                Sou da Áustria, cresci, estudei e trabalhei na Áustria.
                            </div>
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

            <div class="d-block text-center mt-5 mb-5">
                <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 15px 25px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                    Continuar Exercício
                </a>
            </div>

        </div>
    </div>
</div>