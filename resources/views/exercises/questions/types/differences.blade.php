<div class="form-group to_choose differences">
    <label class="label_title mb-3" style="font-size: 30px;">
        Diferenças <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
    <div class="row mb-3 pl-3 pr-3">
        <div class="col-12">
            <label class="label_title mb-0 text_number">
                <span>Texto 1</span>
            </label>
            <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                *Insira o texto com as diferenças a apresentar ao aluno.
            </p>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
            <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                <textarea class="form-control" name="differences_text_0" id="differences_text_0" cols="30" rows="5" placeholder=""></textarea>
            </div>
        </div>
        <div class="col-12">
            <label class="label_title mb-0 solution_number">
                <span>Solução 1</span>
            </label>
            <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                *Insira o texto correto, para termos de correção.
            </p>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
            <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                <textarea class="form-control" name="differences_solution_0" id="differences_solution_0" cols="30" rows="5" placeholder=""></textarea>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <a href="#" class="btn search-btn comment_submit m-3 button_add_differences" style="font-size: 21px; float: none;">
                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                Adicionar Alínea
            </a>
        </div>
    </div>
</div>

{{-- CLONES --}}

<div class="add_differences_clone" hidden>
    <div class="col-12 mb-3"><hr></div>
    <div class="col-12">
        <label class="label_title mb-0 text_number">
            <span>Texto 1</span>
        </label>
        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
            *Insira o texto com as diferenças a apresentar ao aluno.
        </p>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
        <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
            <textarea class="form-control" name="differences_text_0" id="differences_text_0" cols="30" rows="5" placeholder=""></textarea>
        </div>
    </div>
    <div class="col-12">
        <label class="label_title mb-0 solution_number">
            <span>Solução 1</span>
        </label>
        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
            *Insira o texto correto, para termos de correção.
        </p>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
        <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
            <textarea class="form-control" name="differences_solution_0" id="differences_solution_0" cols="30" rows="5" placeholder=""></textarea>
        </div>
    </div>
</div>