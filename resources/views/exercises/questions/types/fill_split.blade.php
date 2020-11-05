<div class="custom-tab customize-tab tabs_creative to_choose fill_split">
    <ul class="nav nav-tabs p-0 b-0 m-auto" id="fill_split_tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="fill-tab" data-toggle="tab" href="#fill" role="tab" aria-controls="fill" aria-selected="true">Preencher / Opções</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="split-tab" data-toggle="tab" href="#split" role="tab" aria-controls="split" aria-selected="false">Separar Palavras</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="other-subtype-tab" data-toggle="tab" href="#other-subtype" role="tab" aria-controls="other-subtype" aria-selected="false">Outro Subtipo</a>
        </li>
    </ul>

    <div class="tab-content" id="fill_split_tabs_content">
        <div class="tab-pane fade show active" id="fill" role="tabpanel" aria-labelledby="fill-tab">

            <div class="form-group">
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                        <textarea class="form-control" name="fill_textarea" id="fill_textarea" cols="30" rows="4" placeholder=""></textarea>
                        <div class="d-flex float-left flex-column mt-4">
                            <p class="fill_split_info_text m-0">Insira dentro de <% %> os termos no local para preenchimento.</p>
                            <p class="fill_split_info_text m-0">Insira dentro de <% %> o termo correcto e <%! %> a opção a apresentar.</p>
                        </div>
                        <div class="d-block float-right mt-3">
                            <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 16px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                Associar Media
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="#" class="btn search-btn comment_submit m-3 button_add_fill" style="font-size: 21px; float: none;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="split" role="tabpanel" aria-labelledby="split-tab">

            <div class="form-group">
                <label class="label_title mb-3" style="font-size: 30px;">
                    Texto para a Questão</label>
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                        <div class="p-4" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                            <textarea class="form-control" name="split_textarea" id="split_textarea" cols="30" rows="5" placeholder=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="#" class="btn search-btn comment_submit m-3 button_add_split" style="font-size: 21px; float: none;">
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

<div class="add_fill_clone" hidden>
    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
        <textarea class="form-control" name="fill_textarea" id="fill_textarea" cols="30" rows="4" placeholder=""></textarea>
        <div class="d-flex float-left flex-column mt-4">
            <p class="fill_split_info_text m-0">Insira dentro de <% %> os termos no local para preenchimento.</p>
            <p class="fill_split_info_text m-0">Insira dentro de <% %> o termo correcto e <%! %> a opção a apresentar.</p>
        </div>
        <div class="d-block float-right mt-3">
            <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 16px 20px; margin-left: 15px;">
                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Associar Media
            </a>
        </div>
    </div>
</div>

<div class="add_split_clone" hidden>
    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
        <div class="p-4" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
            <textarea class="form-control" name="split_textarea" id="split_textarea" cols="30" rows="5" placeholder=""></textarea>
        </div>
    </div>
</div>