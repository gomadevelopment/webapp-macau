<div class="form-group to_choose true_or_false">
    <label class="label_title mb-3" style="font-size: 30px;">
        Afirmações <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
    <div class="row mb-3 align-items-center">
        <div class="row_to_remove col col-wrap d-flex mb-3 text-center small_inline_selects2">
            <input name="true_or_false_input_0" id="true_or_false_input_0" type="text" class="form-control" placeholder="Descrição da Afirmação">
            <select name="true_or_false_select_0" id="true_or_false_select_0" class="form-control corr_exp_select select2" style="margin-left: 15px;">
                <option value="true">Verdadeiro</option>
                <option value="false">Falso</option>
            </select>
            <a href="#" id="true_or_false_associate_media_file_button_0" class="btn search-btn button-wrap-2 comment_submit" style="float: none; padding: 16px 20px; margin-left: 15px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Associar Media
            </a>
            <input type="file" name="true_or_false_associate_media_file_input_0" id="true_or_false_associate_media_file_input_0" hidden disabled>
            <a href="#" class="btn btn-theme remove_button remove_row button-wrap-3" style="float: none; padding: 16px 20px; margin-left: 15px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <a href="#" class="btn search-btn comment_submit m-3 button_add_true_or_false" style="font-size: 21px; float: none;">
                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                Adicionar Alínea
            </a>
        </div>
    </div>
</div>

{{-- CLONES --}}

<div class="add_true_or_false_clone" hidden>
    <div class="col-12 mb-3 empty_col"></div>
    <div class="row_to_remove col col-wrap d-flex mb-3 text-center small_inline_selects2">
        <input name="true_or_false_input_0" id="true_or_false_input_0" type="text" class="form-control" placeholder="Descrição da Afirmação">
        <select name="true_or_false_select_0" id="true_or_false_select_0" class="form-control corr_exp_select select2" style="margin-left: 15px;">
            <option value="true">Verdadeiro</option>
            <option value="false">Falso</option>
        </select>
        <a href="#" id="true_or_false_associate_media_file_button_0" class="btn search-btn button-wrap-2 comment_submit" style="float: none; padding: 16px 20px; margin-left: 15px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Associar Media
        </a>
        <input type="file" name="true_or_false_associate_media_file_input_0" id="true_or_false_associate_media_file_input_0" hidden disabled>
        <a href="#" class="btn btn-theme remove_button remove_row button-wrap-3" style="float: none; padding: 16px 20px; margin-left: 15px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Remover
        </a>
    </div>
</div>