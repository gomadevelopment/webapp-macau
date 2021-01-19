<div class="custom-tab customize-tab tabs_creative to_choose correspondence">
    <ul class="nav nav-tabs p-0 b-0 m-auto with-border" id="correspondence_tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="correspondence-images-tab" data-toggle="tab" href="#correspondence-images" role="correspondence-images" aria-controls="correspondence-images" aria-selected="true">Imagens</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="correspondence-audio-tab" data-toggle="tab" href="#correspondence-audio" role="tab" aria-controls="correspondence-audio" aria-selected="false">Audio / Videos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="correspondence-categories-tab" data-toggle="tab" href="#correspondence-categories" role="tab" aria-controls="correspondence-categories" aria-selected="false">Categorias</a>
        </li>
    </ul>

    <div class="tab-content" id="correspondence_tabs_content">

        <div class="tab-pane fade show active" id="correspondence-images" role="tabpanel" aria-labelledby="correspondence-images-tab">

            <div class="form-group">
                <div class="row">
                    <div class="col-12 mb-2">
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *Associe frases a imagens (insira uma imagem como media).
                        </p>
                    </div>
                </div>
                <div class="row mb-3 align-items-center">
                    <div class="row_to_remove col col-wrap d-flex mb-3">
                        <input name="corr_image_description_0" id="corr_image_description_0" type="text" class="form-control" placeholder="Frase a associar à imagem...">
                        <a href="#" id="corr_image_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Associar Media
                        </a>
                        <a href="#" class="btn btn-theme remove_button button-wrap-2 remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="#" class="btn search-btn comment_submit m-3 button_add_corr_image" style="font-size: 21px; float: none;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar Alínea
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="correspondence-audio" role="tabpanel" aria-labelledby="correspondence-audio-tab">
            
            <div class="form-group">
                <div class="row">
                    <div class="col-12 mb-2">
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *Associe frases a audios/videos (insira um ficheiro de audio ou video como media).
                        </p>
                    </div>
                </div>
                <div class="row mb-3 align-items-center">
                    <div class="row_to_remove col col-wrap d-flex mb-3">
                        <input name="corr_audio_description_0" id="corr_audio_description_0" type="text" class="form-control" placeholder="Frase a associar ao audio...">
                        <a href="#" id="corr_audio_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Associar Media
                        </a>
                        <a href="#" class="btn btn-theme remove_button button-wrap-2 remove_row associate_media_remove" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="#" class="btn search-btn comment_submit m-3 button_add_corr_audio" style="font-size: 21px; float: none;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar Alínea
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="correspondence-categories" role="tabpanel" aria-labelledby="correspondence-categories-tab">
            
            <div class="form-group">
                <div class="row">
                    <div class="col-12 mb-2">
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *Associe múltiplas frases/palavras a uma categoria ou frase.
                        </p>
                    </div>
                </div>
                {{-- Categories ROW --}}
                <div class="row_to_remove row mb-0 align-items-center questions_row">
                    <div class="col-12">
                        <label class="label_title question_number">
                            <span>Categoria/Frase 1</span>
                        </label>
                    </div>
                    <div class="col col-wrap d-flex mb-3">
                        <input name="corr_category_question_0" id="corr_category_question_0" type="text" class="form-control" placeholder="Questão...">
                        <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                </div>
                {{-- Answers ROW --}}
                <div class="row mb-3 align-items-center pl-3 answers_row">
                    <div class="col-12 mb-1">
                        <label class="label_title m-0" style="font-size: 18px;">
                            <span>Frases</span> <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;">
                        </label>
                    </div>
                    <div class="row_to_remove col col-wrap d-flex mb-3">
                        <input name="corr_category_answer_0_question_0" id="corr_category_answer_0_question_0" type="text" class="form-control" placeholder="Resposta...">
                        <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="#" id="add_corr_category_question_0_answer_1" class="btn search-btn comment_submit button_add_category_answer question_0 answer_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar
                        </a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="#" class="btn search-btn comment_submit m-3 button_add_corr_category" style="font-size: 21px; float: none;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar Alínea
                        </a>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
</div>


{{-- CLONES --}}

<div class="add_correspondence_images_clone" hidden>
    <div class="col-12 mb-3 empty_col"></div>
    <div class="row_to_remove col col-wrap d-flex mb-3">
        <input name="corr_image_description_0" id="corr_image_description_0" type="text" class="form-control" placeholder="Frase a associar à imagem...">
        <a href="#" id="corr_image_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Associar Media
        </a>
        <a href="#" class="btn btn-theme remove_button button-wrap-2 remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Remover
        </a>
    </div>
</div>

<div class="add_correspondence_audios_clone" hidden>
    <div class="col-12 mb-3 empty_col"></div>
    <div class="row_to_remove col col-wrap d-flex mb-3">
        <input name="corr_audio_description_0" id="corr_audio_description_0" type="text" class="form-control" placeholder="Frase a associar ao audio...">
        <a href="#" id="corr_audio_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Associar Media
        </a>
        <a href="#" class="btn btn-theme remove_button button-wrap-2 remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Remover
        </a>
    </div>
    
</div>

<div class="add_correspondence_categories_clone" hidden>
    <div class="mt-4 mb-3 hr_row"><hr></div>
    {{-- Categories ROW --}}
    <div class="row_to_remove row mb-0 align-items-center questions_row">
        <div class="col-12">
            <label class="label_title question_number">
                <span>Categoria/Frase 1</span>
            </label>
        </div>
        <div class="col col-wrap d-flex mb-3">
            <input name="corr_category_question_0" id="corr_category_question_0" type="text" class="form-control" placeholder="Questão...">
            <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
    </div>
    {{-- Answers ROW --}}
    <div class="row mb-3 align-items-center pl-3 answers_row">
        <div class="col-12 mb-1">
            <label class="label_title m-0" style="font-size: 18px;">
                <span>Frases</span> <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;">
            </label>
        </div>
        <div class="row_to_remove col col-wrap d-flex mb-3">
            <input name="corr_category_answer_0_question_0" id="corr_category_answer_0_question_0" type="text" class="form-control" placeholder="Resposta...">
            <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_multiple_choice_answer" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
        <div class="col-12">
            <a href="#" id="add_corr_category_question_0_answer_1" class="btn search-btn comment_submit button_add_category_answer question_0 answer_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                Adicionar
            </a>
        </div>
    </div>
</div>

<div class="add_correspondence_categories_answer_clone" hidden>
    <div class="col-12 empty_col"></div>
    <div class="row_to_remove col col-wrap d-flex mb-3">
        <input name="corr_category_answer_0_question_0" id="corr_category_answer_0_question_0" type="text" class="form-control" placeholder="Resposta...">
        <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_multiple_choice_answer" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Remover
        </a>
    </div>
</div>