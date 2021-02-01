<div class="form-group to_choose associate_media">
    <label class="label_title mb-3" style="font-size: 30px;">
        Associar Media <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" data-toggle="tooltip" title="Estas Tooltips servem para explicar ao Utilizador como usar o módulo." alt="" style="margin-left: 5px;"></label>
    <div class="row mb-3 align-items-center">
        <div class="col col-wrap d-flex mb-3">
            <input name="media_descriptions[]" id="media_description_0" type="text" class="form-control" placeholder="Descrição do Media">
            <a href="#" id="associate_media_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Associar Media
            </a>
            <input type="file" name="associate_media_file_inputs[]" id="associate_media_file_input_0" hidden disabled>
            <a href="#" class="btn btn-theme remove_button button-wrap-2 remove_row associate_media_remove" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <a href="#" class="btn search-btn comment_submit m-3 button_add_media" style="font-size: 21px; float: none;">
                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                Adicionar Alínea
            </a>
        </div>
    </div>
</div>

{{-- CLONE --}}

<div class="add_media_clone" hidden>
    <div class="col-12 mb-3"><hr></div>
    <div class="col col-wrap d-flex mb-3">
        <input name="media_descriptions[]" id="media_description_0" type="text" class="form-control" placeholder="Descrição do Media">
        <a href="#" id="associate_media_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Associar Media
        </a>
        <input type="file" name="associate_media_file_inputs[]" id="associate_media_file_input_0" hidden disabled>
        <a href="#" class="btn btn-theme remove_button button-wrap-2 remove_row associate_media_remove" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Remover
        </a>
    </div>
</div>