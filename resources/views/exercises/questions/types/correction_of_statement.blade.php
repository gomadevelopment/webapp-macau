<div class="form-group to_choose correction_of_statement">
    <label class="label_title mb-3" style="font-size: 30px;">
        Afirmações <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
    {{-- Questions ROW --}}
    <div class="row mb-3 align-items-center pl-3 pr-3">
        <div class="col-12">
            <label class="label_title statement_number">
                <span>Afirmação 1</span>
            </label>
        </div>
        <div class="col col-wrap d-flex mb-3">
            <input name="correction_of_statement_question_0" id="correction_of_statement_question_0" type="text" class="form-control" placeholder="Questão...">
            <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_correction_of_statement ml-3" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
        <div class="col-12 mb-2">
            <label class="label_title m-0" style="font-size: 18px;">
                <span>Solução</span> <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;">
            </label>
        </div>
        <div class="col-12">
            <input name="correction_of_statement_solution_0" id="correction_of_statement_solution_0" type="text" class="form-control" placeholder="Questão...">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <a href="#" class="btn search-btn comment_submit m-3 button_add_correction_of_statement" style="font-size: 21px; float: none;">
                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                Adicionar Alínea
            </a>
        </div>
    </div>
</div>

{{-- CLONES --}}

<div class="add_correction_of_statement_clone" hidden>
    <div class="col-12 mt-4 mb-3 hr_row"><hr></div>
    {{-- Questions ROW --}}
    <div class="col-12">
        <label class="label_title statement_number">
            <span>Afirmação 1</span>
        </label>
    </div>
    <div class="col col-wrap d-flex mb-3">
        <input name="correction_of_statement_question_0" id="correction_of_statement_question_0" type="text" class="form-control" placeholder="Questão...">
        <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_correction_of_statement ml-3" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Remover
        </a>
    </div>
    <div class="col-12 mb-2">
        <label class="label_title m-0" style="font-size: 18px;">
            <span>Solução</span> <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;">
        </label>
    </div>
    <div class="col-12">
        <input name="correction_of_statement_solution_0" id="correction_of_statement_solution_0" type="text" class="form-control" placeholder="Questão...">
    </div>
</div>