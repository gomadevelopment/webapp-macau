<div class="custom-tab customize-tab tabs_creative to_choose fill_options">
    <ul class="nav nav-tabs p-0 b-0 m-auto with-border" id="fill_options_tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="fill_options-shuffle-tab" data-toggle="tab" href="#fill_options-shuffle" role="tab" aria-controls="fill_options-shuffle" aria-selected="true">Mistura</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="fill_options-text-words-tab" data-toggle="tab" href="#fill_options-text-words" role="tab" aria-controls="fill_options-text-words" aria-selected="false">Palavras em texto</a>
        </li>
    </ul>

    <div class="tab-content mt-4" id="fill_options_tabs_content">

        <div class="tab-pane fade show active" id="fill_options-shuffle" role="tabpanel" aria-labelledby="fill_options-shuffle-tab">
            
            <div class="form-group">
                <div class="row mb-3">
                    <div class="col-12">
                        <label class="label_title question_number m-0">
                            <span>Questão 1</span>
                            <a href="#" id="fill_perc_delimiter_0" class="btn search-btn button-wrap comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                                <% %>
                            </a>
                        </label>
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *Insira dentro de <% %> os termos no local para preenchimento.
                        </p>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                        <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                            <textarea class="form-control" name="fill_textarea_0" id="fill_textarea_0" cols="30" rows="3" placeholder="Questão..."></textarea>
                        </div>
                        
                        <div class="d-block float-right mt-3">
                            <a href="#" id="fill_associate_media_file_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                Associar Media
                            </a>
                            <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row remove_fill_option" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                Remover
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="#" class="btn search-btn comment_submit m-3 button_add_fill" style="font-size: 21px; float: none;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar Alínea
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="fill_options-text-words" role="tabpanel" aria-labelledby="fill_options-text-words-tab">
            
            <div class="form-group">
                {{-- Categories ROW --}}
                <div class="row_to_remove row mb-0 align-items-center questions_row">
                    <div class="col-12">
                         <label class="label_title question_number m-0">
                            <span>Frase 1</span>
                            <a href="#" id="fill_text_word_perc_delimiter_0" class="btn search-btn button-wrap comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                                <% %>
                            </a>
                        </label>
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *Escolha as possíveis opções em cada espaço possível <% %>.
                        </p>
                    </div>
                    <div class="col col-wrap d-flex mb-3 align-items-center">
                        <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01); width: -webkit-fill-available !important;">
                            <textarea class="form-control" name="fill_text_word_0" id="fill_text_word_0" cols="30" rows="3" placeholder="Frase..."></textarea>
                        </div>
                        <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap; height: fit-content;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                </div>
                {{-- Answers ROW --}}
                <div class="row mb-3 pl-3 align-items-center" id="selects_row_text_words_0">
                </div>

                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="#" class="btn search-btn comment_submit m-3 button_add_fill_text_words" style="font-size: 21px; float: none;">
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

<div class="add_fill_clone" hidden>
    <div class="col-12 mb-3 hr_row"><hr></div>
    <div class="col-12">
        <label class="label_title question_number m-0">
            <span>Questão 1</span>
            <a href="#" id="fill_perc_delimiter_0" class="btn search-btn button-wrap comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                <% %>
            </a>
        </label>
        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
            *Insira dentro de <% %> os termos no local para preenchimento.
        </p>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
        <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
            <textarea class="form-control" name="fill_textarea_0" id="fill_textarea_0" cols="30" rows="3" placeholder=""></textarea>
        </div>
        
        <div class="d-block float-right mt-3">
            <a href="#" id="fill_associate_media_file_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; margin-left: 15px;">
                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Associar Media
            </a>
            <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row remove_fill_option" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
    </div>
</div>

<div class="add_fill_text_words_clone" hidden>
    <div>
        <div class="col-12 mb-3 hr_row" style="display: contents;"><hr></div>
        {{-- Categories ROW --}}
        <div class="row_to_remove row mb-0 align-items-center questions_row">
            <div class="col-12">
                    <label class="label_title question_number m-0">
                    <span>Frase 1</span>
                    <a href="#" id="perc_delimiter_0" class="btn search-btn button-wrap comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                        <% %>
                    </a>
                </label>
                <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                    *Escolha as possíveis opções em cada espaço possível <% %>.
                </p>
            </div>
            <div class="col col-wrap d-flex mb-3 align-items-center">
                <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01); width: -webkit-fill-available !important;">
                    <textarea class="form-control" name="fill_text_word_0" id="fill_text_word_0" cols="30" rows="3" placeholder="Texto..."></textarea>
                </div>
                <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap; height: fit-content;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                    Remover
                </a>
            </div>
        </div>
        {{-- Answers ROW --}}
        <div class="row mb-3 pl-3 align-items-center" id="selects_row_text_words_0">
        </div>
    </div>
</div>