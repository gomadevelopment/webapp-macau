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

            <div class="custom-tab customize-tab tabs_creative">
                <ul class="nav nav-tabs p-0 b-0 m-auto" id="perform_listening_shop_tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="ex1-shop-tab" data-toggle="tab" href="#ex1-shop" role="tab" aria-controls="ex1-shop" aria-selected="false" style="padding: 8px 30px !important;">
                            Exercício 1
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="ex2-shop-tab" data-toggle="tab" href="#ex2-shop" role="tab" aria-controls="ex2-shop" aria-selected="false" style="padding: 8px 30px !important;">
                            Exercício 2
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="perform_listening_shop_tabs_content">
                    
                    <div class="tab-pane fade" id="ex1-shop" role="tabpanel" aria-labelledby="ex1-shop-tab">

                        <div class="row page-title p-0" style="margin-bottom: -15px;">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group wrap m-0">
                                    <label class="label_title d-block" style="font-size: 30px;">
                                        Oficina da Escuta </label>
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
                                        Fronteira da Palavra </label>
                                    <div class="d-flex float-left flex-column">
                                        <p class="exercise_author" style="margin-bottom: -10px;">
                                            Ouça as seguintes passagens do vídeo e separe
                                        </p>
                                        <p class="exercise_author">
                                            cada palavra e nova frase.
                                        </p>
                                        <p class="exercise_author mt-3" style="margin-bottom: -10px;">
                                            <strong>Clique uma vez</strong> para separar a palavra e <strong>duas</strong>
                                        </p>
                                        <p class="exercise_author">
                                            <strong>vezes</strong> no início de cada frase:
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-4">

                        <div class="row mt-5">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <textarea name="words_to_split" class="form-control" id="" cols="30" rows="2">Já estou a viver aqu ihá20anos masPortanto,veio pequenina.NãoVeio,veioObrigada.</textarea>
                                    {{-- <input class="form-control" type="text" name="words_to_split" id=""
                                    value="Já estou a viver aqu ihá20anos masPortanto,veio pequenina.NãoVeio,veioObrigada."> --}}
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <textarea name="words_to_split" class="form-control" id="" cols="30" rows="2">SoudaÁustria,crescinaÁustria,estudeinaÁustria,comeceiatrabalharnaÁustria.E,depois,sim,umdiaconheciumportuguêsemViena.</textarea>
                                    {{-- <input class="form-control" type="text" name="words_to_split" id=""
                                    value="SoudaÁustria,crescinaÁustria,estudeinaÁustria,comeceiatrabalharnaÁustria.E,depois,sim,umdiaconheciumportuguêsemViena."> --}}
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

                        <div class="d-block text-center mt-4 mb-4">
                            <a href="#listening" class="btn btn-theme remove_button m-2 perform_exercise_nav_button" style="float: none; padding: 15px 25px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/small_arrow_back.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                Voltar
                            </a>
                            <a href="#ex2-shop" class="btn search-btn comment_submit m-2 perform_exercise_nav_button" style="float: none; padding: 15px 25px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Seguinte
                            </a>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="ex2-shop" role="tabpanel" aria-labelledby="ex2-shop-tab">
                        
                        <div class="row page-title p-0" style="margin-bottom: -15px;">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group wrap m-0">
                                    <label class="label_title d-block" style="font-size: 30px;">
                                        Oficina da Escuta </label>
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
                                        Verbos </label>
                                    <div class="d-flex float-left flex-column">
                                        <p class="exercise_author" style="margin-bottom: -10px;">
                                            Pratique o <strong>Presente do Indicativo</strong> e o <strong>Pretérito</strong>
                                        </p>
                                        <p class="exercise_author">
                                            <strong>Perfeito Simples</strong>. Clique na opção correta:
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-4">

                        <div class="row mt-3">

                            <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                <div class="form-group d-inline-flex">
                                    <img src="{{asset('/assets/backoffice_assets/images/pt_flag_image.png')}}" alt="" class="mr-4 mt-2 mb-2 align-self-center" style="height: fit-content;">
                                    <label class="label_title m-0 d-block align-self-center">
                                        - E 
                                        <div class="drag_and_drop_hole fill_hole word_hole m-2 border-0">
                                            <select name="verbs_select_1" id="verbs_select_1" class="form-control">
                                                <option value="1">ser</option>
                                                <option value="2">foi</option>
                                                <option value="3">é</option>
                                            </select>
                                        </div>
                                        de onde?
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                <div class="form-group d-inline-flex">
                                    <img src="{{asset('/assets/backoffice_assets/images/pt_flag_image.png')}}" alt="" class="mr-4 mt-2 mb-2 align-self-center" style="height: fit-content;">
                                    <label class="label_title m-0 d-block align-self-center">
                                        <div class="drag_and_drop_hole fill_hole word_hole m-2 border-0">
                                            <select name="verbs_select_2" id="verbs_select_2" class="form-control">
                                                <option value="1">Vem</option>
                                                <option value="2">Foi</option>
                                                <option value="3">É</option>
                                            </select>
                                        </div>
                                        de onde?
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
                                            <strong>Pontuação:</strong> Esta questão vale <strong>10</strong> pontos.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-block text-center mt-4 mb-4">
                            <a href="#ex1-shop" class="btn btn-theme remove_button m-2 perform_exercise_nav_button" style="float: none; padding: 15px 25px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/small_arrow_back.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                Voltar
                            </a>
                            <a href="#after-listening" class="btn search-btn comment_submit m-2 perform_exercise_nav_button" style="float: none; padding: 15px 25px;">
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