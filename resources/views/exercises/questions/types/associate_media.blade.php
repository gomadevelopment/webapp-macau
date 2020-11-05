<div class="form-group to_choose associate_media">
    <label class="label_title mb-3" style="font-size: 30px;">
        Associar Media <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
    <div class="row mb-3">
        <div class="col-sm-12 col-md-12 col-lg-12 mb-3 d-flex">
            <input name="media_description" id="media_description" type="text" class="form-control" placeholder="Descrição do Media">
            <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 16px 20px; margin-left: 15px;">
                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Associar Media</a>
            <a href="#" class="btn btn-theme remove_button remove_row" style="float: none; padding: 16px 20px; margin-left: 15px;">
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
    <div class="col-sm-12 col-md-12 col-lg-12 mb-3 d-flex">
        <input name="media_description" id="media_description" type="text" class="form-control" placeholder="Descrição do Media">
        <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 16px 20px; margin-left: 15px;">
            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Associar Media</a>
        <a href="#" class="btn btn-theme remove_button remove_row" style="float: none; padding: 16px 20px; margin-left: 15px;">
            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
            Remover
        </a>
    </div>
</div>