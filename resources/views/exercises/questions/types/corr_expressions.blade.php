<div class="custom-tab customize-tab tabs_creative to_choose corr_exp">
    <ul class="nav nav-tabs p-0 b-0 m-auto" id="corr_exp_tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="corr-tab" data-toggle="tab" href="#corr" role="tab" aria-controls="corr" aria-selected="true">Correspondência</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="expressions-tab" data-toggle="tab" href="#expressions" role="tab" aria-controls="expressions" aria-selected="false">Expressões</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="other-subtype-tab" data-toggle="tab" href="#other-subtype" role="tab" aria-controls="other-subtype" aria-selected="false">Outro Subtipo</a>
        </li>
    </ul>

    <div class="tab-content" id="corr_exp_tabs_content">
        <div class="tab-pane fade show active" id="corr" role="tabpanel" aria-labelledby="corr-tab">

            <div class="form-group">
                <div class="row mb-3 align-items-center">
                    <div class="col-sm-12 col-md-8 col-lg-8 mb-3">
                        <input name="corr_expr_description" id="corr_expr_description" type="text" class="form-control m-1" placeholder="Descrição da Expressão">
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 mb-3 text-center small_inline_selects2">
                        <select name="corr_exp_select" id="corr_exp_select_0" class="form-control corr_exp_select select2" style="margin-left: 15px;">
                            <option value=""></option>
                            <option value="1">Opção 1</option>
                            <option value="2">Opção 2</option>
                            <option value="3">Opção 3</option>
                        </select>
                        <a href="#" class="btn btn-theme remove_button remove_row corr_expressions_remove m-1" style="float: none; padding: 16px 20px; margin-left: 15px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="#" class="btn search-btn comment_submit m-3 button_add_corr_exp" style="font-size: 21px; float: none;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="expressions" role="tabpanel" aria-labelledby="expressions-tab">
            
            <div class="form-group">
                <div class="row mb-3 align-items-center">
                    <div class="col-sm-12 col-md-8 col-lg-8 mb-3">
                        <input name="corr_expr_description" id="corr_expr_description" type="text" class="form-control m-1" placeholder="Descrição da Expressão">
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 mb-3 text-center small_inline_selects2">
                        <select name="corr_exp_select" id="corr_exp_select_1" class="form-control corr_exp_select select2" style="margin-left: 15px;">
                            <option value=""></option>
                            <option value="1">Opção 1</option>
                            <option value="2">Opção 2</option>
                            <option value="3">Opção 3</option>
                        </select>
                        <a href="#" class="btn btn-theme remove_button remove_row corr_expressions_remove m-1" style="float: none; padding: 16px 20px; margin-left: 15px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="#" class="btn search-btn comment_submit m-3 button_add_corr_exp" style="font-size: 21px; float: none;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="other-subtype" role="tabpanel" aria-labelledby="other-subtype-tab">
            
            <div class="form-group">
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="#" class="btn search-btn comment_submit m-3 button_add_other_type" style="font-size: 21px; float: none;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>


{{-- CLONES --}}

<div class="add_corr_expr_clone" hidden>
    <div class="col-12 mb-3"><hr></div>
    <div class="col-sm-12 col-md-8 col-lg-8 mb-3">
        <input name="corr_expr_description" id="corr_expr_description" type="text" class="form-control m-1" placeholder="Descrição da Expressão">
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 mb-3 text-center small_inline_selects2">
        <select name="corr_exp_select" id="corr_exp_select" class="form-control corr_exp_select select2" style="margin-left: 15px;">
            <option value=""></option>
            <option value="1">Opção 1</option>
            <option value="2">Opção 2</option>
            <option value="3">Opção 3</option>
        </select>
        <a href="#" class="btn btn-theme remove_button remove_row corr_expressions_remove m-1" style="float: none; padding: 16px 20px; margin-left: 15px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Remover
        </a>
    </div>
</div>