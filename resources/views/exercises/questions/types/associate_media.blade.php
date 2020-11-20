<div class="form-group to_choose associate_media">
    <label class="label_title mb-3" style="font-size: 30px;">
        Associar Media <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
    <div class="row mb-3 align-items-center">
        <div class="col-sm-12 col-md-8 col-lg-8 mb-3">
            <input name="media_description" id="media_description" type="text" class="form-control" placeholder="Descrição do Media">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 mb-3 text-center">
            <a href="#" class="btn search-btn comment_submit m-1" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Associar Media</a>
            <a href="#" class="btn btn-theme remove_button remove_row associate_media_remove m-1" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <a href="#" class="btn search-btn comment_submit m-3 button_add_media" style="font-size: 21px; float: none;">
                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                Adicionar
            </a>
        </div>
    </div>
</div>

{{-- CLONE --}}

<div class="add_media_clone" hidden>
    <div class="col-12 mb-3"><hr></div>
    <div class="col-sm-12 col-md-8 col-lg-8 mb-3">
        <input name="media_description" id="media_description" type="text" class="form-control" placeholder="Descrição do Media">
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 mb-3 text-center">
        <a href="#" class="btn search-btn comment_submit m-1" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Associar Media</a>
        <a href="#" class="btn btn-theme remove_button remove_row associate_media_remove m-1" style="float: none; padding: 16px 20px; white-space: nowrap;">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Remover
        </a>
    </div>
</div>