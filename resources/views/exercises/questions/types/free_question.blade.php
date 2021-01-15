<div class="form-group to_choose free_question">
    <label class="label_title mb-1" style="font-size: 30px;">
        Questões <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
        *Questões de resposta aberta/livre.
    </p>
    {{-- Questions ROW --}}
    <div class="row mb-3 align-items-center mt-2 questions_row">
        <div class="row_to_remove col col-wrap d-flex mb-3">
            <input name="free_question_0" id="free_question_0" type="text" class="form-control" placeholder="Questão...">
            <a href="#" id="f_q_associate_media_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Associar Media
            </a>
            <input type="file" name="f_q_associate_media_file_input_0" id="f_q_associate_media_file_input_0" hidden disabled>
            <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <a href="#" class="btn search-btn comment_submit m-3 button_add_free_question" style="font-size: 21px; float: none;">
                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                Adicionar Alínea
            </a>
        </div>
    </div>
</div>

{{-- CLONES --}}

<div class="add_free_question_clone" hidden>
    <div class="col-12 mb-3 empty_col"></div>
    {{-- Questions ROW --}}
    <div class="row_to_remove col col-wrap d-flex mb-3">
        <input name="free_question_0" id="free_question_0" type="text" class="form-control" placeholder="Questão...">
        <a href="#" id="f_q_associate_media_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Associar Media
        </a>
        <input type="file" name="f_q_associate_media_file_input_0" id="f_q_associate_media_file_input_0" hidden disabled>
        <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Remover
        </a>
    </div>
</div>