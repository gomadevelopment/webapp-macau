<div class="form-group to_choose true_or_false">

    <form id="form-true_or_false" class="question-form" action=""  enctype="multipart/form-data">
        @csrf

        <label class="label_title mb-3" style="font-size: 30px;">
            Afirmações <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" data-toggle="tooltip" title="Estas Tooltips servem para explicar ao Utilizador como usar o módulo." alt="" style="margin-left: 5px;"></label>
        <div class="row mb-3 align-items-center">
            @if (isset($question->id) && $question->question_subtype_id == 7)
                @foreach ($question->question_items as $question_item)
                    @if (!$loop->first)
                        <div class="col-12 mb-3 empty_col"></div>
                    @endif
                    <div class="row_to_remove col col-wrap d-flex mb-3 text-center small_inline_selects2">
                        <input name="true_or_false_input_{{$loop->index}}" id="true_or_false_input_{{$loop->index}}" 
                        value="{{ $question_item->text_1 }}"
                        type="text" class="form-control" placeholder="Descrição da Afirmação">
                        <select name="true_or_false_select_{{$loop->index}}" id="true_or_false_select_{{$loop->index}}" class="form-control corr_exp_select select2" style="margin-left: 15px;">
                            <option value="true" {{ $question_item->options_correct == 'true' ? 'selected' : '' }}>
                                Verdadeiro
                            </option>
                            <option value="false"{{ $question_item->options_correct == 'false' ? 'selected' : '' }}>
                                Falso
                            </option>
                            <option value="not_said"{{ $question_item->options_correct == 'not_said' ? 'selected' : '' }}>
                                Não dito
                            </option>
                        </select>
                        <a href="#" id="true_or_false_associate_media_file_button_{{$loop->index}}" class="btn search-btn button-wrap-2 comment_submit" 
                            style="float: none; padding: 16px 20px; margin-left: 15px; white-space: nowrap; display: {{$question_item->question_item_media ? 'none' : 'block'}};">
                            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Associar Media
                        </a>
                        @if($question_item->question_item_media)
                            <input type="text" name="true_or_false_associate_media_file_input_{{$loop->index}}" id="true_or_false_associate_media_file_input_{{$loop->index}}" hidden
                                value="from_storage_{{ $question_item->id }}">
                            @if(explode('/', $question_item->question_item_media->media_type)[0] == 'audio')
                                <?php $preview_image_src = "/assets/backoffice_assets/icons/Soundclip_Icon.svg"; ?>
                            @elseif(explode('/', $question_item->question_item_media->media_type)[0] == 'video')
                                <?php $preview_image_src = "/assets/backoffice_assets/icons/Video_Icon.svg"; ?>
                            @else
                                <?php $preview_image_src = '/webapp-macau-storage/questions/'.$question->id.'/question_item/'.$question_item->id.'/'.$question_item->question_item_media->media_url; ?>
                            @endif
                            <a class="btn btn-theme remove_button associate_media_preview button-wrap"
                                                data-toggle="tooltip" 
                                                data-html="true"
                                                title='<img src="{{ $preview_image_src }}" 
                                                title="{{ $question_item->question_item_media->media_url }}" class="associate_media_thumbnail_img mr-2" style="width: 100%;">'>
                                <img src="{{ $preview_image_src }}" 
                                title="{{ $question_item->question_item_media->media_url }}" class="associate_media_thumbnail_img mr-2">
                                <span class="associate_media_thumbnail_title">{{ $question_item->question_item_media->media_url }}</span>
                                <img class="associate_media_thumbnail_remove" src="/assets/backoffice_assets/icons/Cross.svg">
                            </a>
                        @endif
                        <input type="hidden" name="existent_question_item_id_{{ $loop->index }}" value="{{ $question_item->id }}">
                        <a href="#" class="btn btn-theme remove_button remove_row button-wrap-3" style="float: none; padding: 16px 20px; margin-left: 15px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                @endforeach
            @else
                <div class="row_to_remove col col-wrap d-flex mb-3 text-center small_inline_selects2">
                    <input name="true_or_false_input_0" id="true_or_false_input_0" type="text" class="form-control" placeholder="Descrição da Afirmação">
                    <select name="true_or_false_select_0" id="true_or_false_select_0" class="form-control corr_exp_select select2" style="margin-left: 15px;">
                        <option value="true">Verdadeiro</option>
                        <option value="false">Falso</option>
                        <option value="not_said">Não dito</option>
                    </select>
                    <a href="#" id="true_or_false_associate_media_file_button_0" class="btn search-btn button-wrap-2 comment_submit" style="float: none; padding: 16px 20px; margin-left: 15px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Associar Media
                    </a>
                    <a href="#" class="btn btn-theme remove_button remove_row button-wrap-3" style="float: none; padding: 16px 20px; margin-left: 15px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Remover
                    </a>
                </div>
            @endif
            
        </div>
        <div class="row mb-3">
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <a href="#" class="btn search-btn comment_submit m-3 button_add_true_or_false" style="font-size: 21px; float: none;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                    Adicionar Alínea
                </a>
            </div>
        </div>

    </form>

</div>

{{-- CLONES --}}

<div class="add_true_or_false_clone" hidden>
    <div class="col-12 mb-3 empty_col"></div>
    @if (isset($question->id) && $question->question_subtype_id == 7)
        @foreach ($question->question_items as $question_item)
            @if($loop->last)
                <div class="row_to_remove col col-wrap d-flex mb-3 text-center small_inline_selects2">
                    <input name="true_or_false_input_{{$loop->index}}" id="true_or_false_input_{{$loop->index}}" type="text" class="form-control" placeholder="Descrição da Afirmação">
                    <select name="true_or_false_select_{{$loop->index}}" class="form-control corr_exp_select select2" style="margin-left: 15px;">
                        <option value="true">Verdadeiro</option>
                        <option value="false">Falso</option>
                        <option value="not_said">Não dito</option>
                    </select>
                    <a href="#" id="true_or_false_associate_media_file_button_{{$loop->index}}" class="btn search-btn button-wrap-2 comment_submit" style="float: none; padding: 16px 20px; margin-left: 15px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Associar Media
                    </a>
                    <a href="#" class="btn btn-theme remove_button remove_row button-wrap-3" style="float: none; padding: 16px 20px; margin-left: 15px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Remover
                    </a>
                </div>
            @endif
        @endforeach
    @else
        <div class="row_to_remove col col-wrap d-flex mb-3 text-center small_inline_selects2">
            <input name="true_or_false_input_0" id="true_or_false_input_0" type="text" class="form-control" placeholder="Descrição da Afirmação">
            <select name="true_or_false_select_0" id="true_or_false_select_0" class="form-control corr_exp_select select2" style="margin-left: 15px;">
                <option value="true">Verdadeiro</option>
                <option value="false">Falso</option>
                <option value="not_said">Não dito</option>
            </select>
            <a href="#" id="true_or_false_associate_media_file_button_0" class="btn search-btn button-wrap-2 comment_submit" style="float: none; padding: 16px 20px; margin-left: 15px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Associar Media
            </a>
            <a href="#" class="btn btn-theme remove_button remove_row button-wrap-3" style="float: none; padding: 16px 20px; margin-left: 15px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
    @endif
    
</div>