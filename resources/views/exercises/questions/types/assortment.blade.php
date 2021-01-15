<div class="custom-tab customize-tab tabs_creative to_choose assortment">
    <ul class="nav nav-tabs p-0 b-0 m-auto with-border" id="assortment_tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="assort-sentences-tab" data-toggle="tab" href="#assort-sentences" role="tab" aria-controls="assort-sentences" aria-selected="true">Frases</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="assort-words-tab" data-toggle="tab" href="#assort-words" role="tab" aria-controls="assort-words" aria-selected="false">Palavras / Excertos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="assort-images-tab" data-toggle="tab" href="#assort-images" role="tab" aria-controls="assort-images" aria-selected="false">Imagens</a>
        </li>
    </ul>

    <div class="tab-content mt-4" id="assortment_tabs_content">

        <div class="tab-pane fade show active" id="assort-sentences" role="tabpanel" aria-labelledby="assort-sentences-tab">

            <div class="form-group">
                <div class="row mb-3">
                    <div class="col-12">
                        <label class="label_title mb-0 sentence_number">
                            <span>Frases</span>
                        </label>
                    </div>
                    <div class="col-12 mb-2">
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *Construa frases de forma ordenada/correta.
                        </p>
                    </div>
                    <div class="col col-wrap d-flex mb-3">
                        <input name="assort_sentence_question_0" id="assort_sentence_question_0" type="text" class="form-control" placeholder="Frase...">
                        <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="#" class="btn search-btn comment_submit m-3 button_add_assort_sentence" style="font-size: 21px; float: none;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar Alínea
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="assort-words" role="tabpanel" aria-labelledby="assort-words-tab">

            <div class="form-group">
                {{-- QUESTIONS --}}
                <div class="row">
                    <div class="col-12">
                        <label class="label_title mb-0 sentence_number">
                            <span>Frase 1</span>
                        </label>
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *Construa a frase separada em palavras/excertos de forma ordenada/correta.
                        </p>
                    </div>
                    <input name="assort_words_question_0" id="assort_words_question_0" type="text" class="form-control" placeholder="Frase..." hidden disabled>
                </div>
                {{-- SOLUTIONS --}}
                <div class="row mt-1 mb-3 align-items-center">
                    <div class="col col-wrap d-flex mb-3">
                        <input name="assort_words_solution_0_question_0" id="assort_words_solution_0_question_0" type="text" class="form-control" placeholder="Resposta...">
                        <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="#" id="add_assort_words_question_0_solution_1" class="btn search-btn comment_submit button_add_assort_words_solution question_0 solution_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar
                        </a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="#" class="btn search-btn comment_submit m-3 button_add_assort_words" style="font-size: 21px; float: none;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar Alínea
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="assort-images" role="tabpanel" aria-labelledby="assort-images-tab">
            
            <div class="form-group">
                <div class="row mb-3 align-items-center">
                    <div class="col-12">
                        <label class="label_title mb-0 sentence_number">
                            <span>Frases</span>
                        </label>
                    </div>
                    <div class="col-12 mb-2">
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *Insira imagens com descrição de forma ordenada/correta.
                        </p>
                    </div>
                    <div class="col col-wrap d-flex mb-3">
                        <input name="assort_image_input_0" id="assort_image_input_0" type="text" class="form-control" placeholder="Descrição do Media">
                        <a href="#" id="assort_image_media_button_0" class="btn search-btn comment_submit button-wrap" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Associar Media
                        </a>
                        <input type="file" name="assort_image_media_file_input_0" id="assort_image_media_file_input_0" hidden disabled>
                        <a href="#" class="btn btn-theme remove_button remove_row button-wrap-2" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="#" class="btn search-btn comment_submit m-3 button_add_assort_images" style="font-size: 21px; float: none;">
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

<div class="add_assort_sentences_clone" hidden>
    <div class="col-12 mb-3"></div>
    <div class="col col-wrap d-flex mb-3">
        <input name="assort_sentence_question_0" id="assort_sentence_question_0" type="text" class="form-control" placeholder="Frase...">
        <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Remover
        </a>
    </div>
</div>

<div class="add_assort_words_clone" hidden>
    <div class="mb-3"><hr></div>
    {{-- QUESTIONS --}}
    <div class="row">
        <div class="col-12">
            <label class="label_title mb-0 sentence_number">
                <span>Frase 1</span>
            </label>
            <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                *Construa a frase separada em palavras/excertos de forma ordenada/correta.
            </p>
        </div>
        <input name="assort_words_question_0" id="assort_words_question_0" type="text" class="form-control" placeholder="Frase..." hidden disabled>
    </div>
    {{-- SOLUTIONS --}}
    <div class="row mt-1 mb-3 align-items-center">
        <div class="col col-wrap d-flex mb-3">
            <input name="assort_words_solution_0_question_0" id="assort_words_solution_0_question_0" type="text" class="form-control" placeholder="Resposta...">
            <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
        <div class="col-12">
            <a href="#" id="add_assort_words_question_0_solution_1" class="btn search-btn comment_submit button_add_assort_words_solution question_0 solution_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                Adicionar
            </a>
        </div>
    </div>
</div>

<div class="add_assort_words_solution_clone" hidden>
    <div class="col-12"></div>
    <div class="col col-wrap d-flex mb-3">
        <input name="assort_words_solution_0_question_0" id="assort_words_solution_0_question_0" type="text" class="form-control" placeholder="Resposta...">
        <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Remover
        </a>
    </div>
</div>


<div class="add_assort_images_clone" hidden>
    <div class="col-12 mb-3"></div>
    <div class="col col-wrap d-flex mb-3">
        <input name="assort_image_input_0" id="assort_image_input_0" type="text" class="form-control" placeholder="Descrição do Media">
        <a href="#" id="assort_image_media_button_0" class="btn search-btn comment_submit button-wrap" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Associar Media
        </a>
        <input type="file" name="assort_image_media_file_input_0" id="assort_image_media_file_input_0" hidden disabled>
        <a href="#" class="btn btn-theme remove_button remove_row button-wrap-2" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Remover
        </a>
    </div>
</div>