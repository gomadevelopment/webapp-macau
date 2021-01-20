<div class="custom-tab customize-tab tabs_creative to_choose multiple_choice">
    <ul class="nav nav-tabs p-0 b-0 m-auto with-border" id="multiple_choice_tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="multiple_choice-questions-tab" data-toggle="tab" href="#multiple_choice-questions" role="tab" aria-controls="multiple_choice-questions" aria-selected="true">Questões</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="multiple_choice-intruder-tab" data-toggle="tab" href="#multiple_choice-intruder" role="tab" aria-controls="multiple_choice-intruder" aria-selected="false">Palavra Intrusa</a>
        </li>
    </ul>

    <div class="tab-content mt-4" id="multiple_choice_tabs_content">

        <div class="tab-pane fade show active" id="multiple_choice-questions" role="tabpanel" aria-labelledby="multiple_choice-questions-tab">

            <div class="form-group">
                {{-- Questions ROW --}}
                <div class="row_to_remove row mb-0 align-items-center questions_row">
                    <div class="col-12">
                        <label class="label_title question_number">
                            <span>Pergunta 1</span>
                        </label>
                    </div>
                    <div class="col col-wrap d-flex mb-3">
                        <input name="multiple_choice_question_0" id="multiple_choice_question_0" type="text" class="form-control" placeholder="Questão...">
                        <a href="#" id="m_c_associate_media_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Associar Media
                        </a>
                        <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                </div>
                {{-- Answers ROW --}}
                <div class="row mb-3 align-items-center pl-3 answers_row">
                    <div class="col-12">
                        <label class="label_title m-0" style="font-size: 18px;">
                            <span>Respostas</span> <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;">
                        </label>
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *A resposta certa deverá ser selecionada antes de gravar.
                        </p>
                    </div>
                    <div class="row_to_remove col col-wrap d-flex mb-3">
                        <input id="multiple_choice_correct_answer_0_question_0" class="checkbox-custom" name="multiple_choice_correct_answer_0_question_0" type="checkbox">
                        <label for="multiple_choice_correct_answer_0_question_0" class="checkbox-custom-label multiple_choice_correct_answer_0 d-inline-flex w-100 align-items-center m-0">
                            <input name="multiple_choice_answer_0_question_0" id="multiple_choice_answer_0_question_0" type="text" class="form-control" placeholder="Resposta...">
                        </label>
                        <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="#" id="add_questions_question_0_answer_1" class="btn search-btn comment_submit button_add_multiple_choice_answer question_0 answer_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar
                        </a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="#" class="btn search-btn comment_submit m-3 button_add_multiple_choice" style="font-size: 21px; float: none;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar Alínea
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="multiple_choice-intruder" role="tabpanel" aria-labelledby="multiple_choice-intruder-tab">

            <div class="form-group">
                {{-- Questions ROW --}}
                <div class="row_to_remove row mb-0 align-items-center questions_row">
                    <div class="col col-wrap d-flex m-0 align-items-center">
                        <label class="label_title question_number m-0" id="multiple_choice_intruder_question_0">
                            <span>Grupo de Palavras 1</span>
                        </label>
                        <a href="#" class="btn btn-theme remove_button remove_row remove_entire_question ml-auto" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                </div>
                {{-- Answers ROW --}}
                <div class="row mb-3 align-items-center pl-3 answers_row">
                    <div class="col-12">
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *A palavra intrusa deverá ser selecionada antes de gravar.
                        </p>
                    </div>
                    <div class="row_to_remove col col-wrap d-flex mb-3">
                        <input id="multiple_choice_intruder_intruder_answer_0_question_0" class="checkbox-custom" name="multiple_choice_intruder_intruder_answer_0_question_0" type="checkbox">
                        <label for="multiple_choice_intruder_intruder_answer_0_question_0" class="checkbox-custom-label multiple_choice_intruder_intruder_answer_0_question_0 d-inline-flex w-100 align-items-center m-0">
                            <input name="multiple_choice_intruder_input_answer_0_question_0" id="multiple_choice_intruder_input_answer_0_question_0" type="text" class="form-control" placeholder="Palavra...">
                        </label>
                        <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="#" id="add_intruders_question_0_answer_1" class="btn search-btn comment_submit button_add_multiple_choice_intruder_answer question_0 answer_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar
                        </a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="#" class="btn search-btn comment_submit m-3 button_add_multiple_choice_intruder" style="font-size: 21px; float: none;">
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

<div class="add_multiple_choice_clone" hidden>
    <div class="mt-4 mb-3 hr_row"><hr></div>
    {{-- Questions ROW --}}
    <div class="row_to_remove row mb-0 align-items-center pl-3 pr-3 questions_row">
        <div class="col-12">
            <label class="label_title question_number">
                <span>Pergunta 1</span>
            </label>
        </div>
        <div class="col col-wrap d-flex mb-3">
            <input name="multiple_choice_question_0" id="multiple_choice_question_0" type="text" class="form-control" placeholder="Questão...">
            <a href="#" id="m_c_associate_media_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Associar Media
            </a>
            <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
    </div>
    {{-- Answers ROW --}}
    <div class="row mb-3 align-items-center pl-5 pr-3 answers_row">
        <div class="col-12">
            <label class="label_title m-0" style="font-size: 18px;">
                <span>Respostas</span> <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;">
            </label>
            <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                *A resposta certa deverá ser selecionada antes de gravar.
            </p>
        </div>
        <div class="row_to_remove col col-wrap d-flex mb-3">
            <input id="multiple_choice_correct_answer_0_question_0" class="checkbox-custom" name="multiple_choice_correct_answer_0_question_0" type="checkbox">
            <label for="multiple_choice_correct_answer_0_question_0" class="checkbox-custom-label multiple_choice_correct_answer_0 d-inline-flex w-100 align-items-center m-0">
                <input name="multiple_choice_answer_0_question_0" id="multiple_choice_answer_0_question_0" type="text" class="form-control" placeholder="Resposta...">
            </label>
            <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
        <div class="col-12">
            <a href="#" id="add_questions_question_0_answer_1" class="btn search-btn comment_submit button_add_multiple_choice_answer question_0 answer_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                Adicionar
            </a>
        </div>
    </div>
</div>

<div class="add_multiple_choice_answers_clone" hidden>
    <div class="col-12 empty_col"></div>
    <div class="row_to_remove col col-wrap d-flex mb-3">
        <input id="multiple_choice_correct_answer_0_question_0" class="checkbox-custom" name="multiple_choice_correct_answer_0_question_0" type="checkbox">
        <label for="multiple_choice_correct_answer_0_question_0" class="checkbox-custom-label multiple_choice_correct_answer_0 d-inline-flex w-100 align-items-center m-0">
            <input name="multiple_choice_answer_0_question_0" id="multiple_choice_answer_0_question_0" type="text" class="form-control" placeholder="Resposta...">
        </label>
        <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Remover
        </a>
    </div>
</div>

<div class="add_multiple_choice_intruder_clone" hidden>
    <div class="mt-4 mb-4 hr_row"><hr></div>
    {{-- Questions ROW --}}
    <div class="row_to_remove row mb-0 align-items-center questions_row">
        <div class="col col-wrap d-flex m-0 align-items-center">
            <label class="label_title question_number m-0" id="multiple_choice_intruder_question_0">
                <span>Grupo de Palavras 1</span>
            </label>
            <a href="#" class="btn btn-theme remove_button remove_row remove_entire_question ml-auto" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
    </div>
    {{-- Answers ROW --}}
    <div class="row mb-3 align-items-center pl-3 answers_row">
        <div class="col-12">
            <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                *A palavra intrusa deverá ser selecionada antes de gravar.
            </p>
        </div>
        <div class="row_to_remove col col-wrap d-flex mb-3">
            <input id="multiple_choice_intruder_intruder_answer_0_question_0" class="checkbox-custom" name="multiple_choice_intruder_intruder_answer_0_question_0" type="checkbox">
            <label for="multiple_choice_intruder_intruder_answer_0_question_0" class="checkbox-custom-label multiple_choice_intruder_intruder_answer_0_question_0 d-inline-flex w-100 align-items-center m-0">
                <input name="multiple_choice_intruder_input_answer_0_question_0" id="multiple_choice_intruder_input_answer_0_question_0" type="text" class="form-control" placeholder="Palavra...">
            </label>
            <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
        <div class="col-12">
            <a href="#" id="add_intruders_question_0_answer_1" class="btn search-btn comment_submit button_add_multiple_choice_intruder_answer question_0 answer_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                Adicionar
            </a>
        </div>
    </div>
</div>

<div class="add_multiple_choice_intruder_answer_clone" hidden>
    <div class="col-12 empty_col"></div>
    <div class="row_to_remove col col-wrap d-flex mb-3">
        <input id="multiple_choice_intruder_intruder_answer_0_question_0" class="checkbox-custom" name="multiple_choice_intruder_intruder_answer_0_question_0" type="checkbox">
        <label for="multiple_choice_intruder_intruder_answer_0_question_0" class="checkbox-custom-label multiple_choice_intruder_intruder_answer_0_question_0 d-inline-flex w-100 align-items-center m-0">
            <input name="multiple_choice_intruder_input_answer_0_question_0" id="multiple_choice_intruder_input_answer_0_question_0" type="text" class="form-control" placeholder="Palavra...">
        </label>
        <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Remover
        </a>
    </div>
</div>