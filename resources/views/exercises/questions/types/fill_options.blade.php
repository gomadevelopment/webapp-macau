<div class="form-group to_choose fill_options">
    <div class="row mb-3">
        <div class="col-12">
            <label class="label_title question_number">
                <span>Questão 1</span>
            </label>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
            <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                <textarea class="form-control" name="fill_textarea_0" id="fill_textarea_0" cols="30" rows="3" placeholder=""></textarea>
            </div>
            <div class="d-flex float-left flex-column mt-4">
                <p class="fill_split_info_text m-0">Insira dentro de <% %> os termos no local para preenchimento.</p>
                {{-- <p class="fill_split_info_text m-0">Insira dentro de <% %> o termo correcto e <%! %> a opção a apresentar.</p> --}}
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

{{-- CLONES --}}

<div class="add_fill_clone" hidden>
    <div class="col-12 mb-3 hr_row"><hr></div>
    <div class="col-12">
        <label class="label_title question_number">
            <span>Questão 1</span>
        </label>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
        <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
            <textarea class="form-control" name="fill_textarea_0" id="fill_textarea_0" cols="30" rows="3" placeholder=""></textarea>
        </div>
        <div class="d-flex float-left flex-column mt-4">
            <p class="fill_split_info_text m-0">Insira dentro de <% %> os termos no local para preenchimento.</p>
            {{-- <p class="fill_split_info_text m-0">Insira dentro de <% %> o termo correcto e <%! %> a opção a apresentar.</p> --}}
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