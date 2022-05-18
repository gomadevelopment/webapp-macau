<div class="form-group to_choose automatic_content">

    <form id="form-automatic_content" class="question-form" action=""  enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            @if (isset($question->id) && $question->question_subtype_id == 13)
                @foreach ($question->question_items as $question_item)
                    @if (!$loop->first)
                        <div class="col-12 mb-1 hr_row"><hr></div>
                    @endif
                    <div class="col-12">
                        <label class="label_title mb-0 text_number">
                            <span>Texto {{ $loop->index + 1 }}</span>
                        </label>
                    </div>
                    <div class="col-12 mb-2">
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *Escreva o texto original para que as suas palavras possam ser separadas (com pré-visualização).
                        </p>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                        <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                            <textarea class="form-control" name="split_textarea_{{$loop->index}}" id="split_textarea_{{$loop->index}}" 
                                cols="30" rows="4" placeholder="Texto original...">{{$question_item->text_1}}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                        <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                            <textarea class="form-control" name="split_preview_{{$loop->index}}" id="split_preview_{{$loop->index}}" 
                                cols="30" rows="4" placeholder="Pré-visualização..." disabled style="background-color: #e9ecef5c;">{{str_replace(" ","",$question_item->text_1)}}</textarea>
                        </div>
                    </div>
                    <div class="col-12 text-right">

                        <a href="#" id="split_file_button_{{$loop->index}}" class="btn search-btn button-wrap comment_submit ml-auto" 
                            style="float: none; padding: 16px 20px; margin-left: 15px; display: {{$question_item->question_item_media ? 'none' : 'inline-block'}};">
                            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Associar Media
                        </a>

                        @if($question_item->question_item_media)
                            <input type="text" name="split_file_input_{{$loop->index}}" id="split_file_input_{{$loop->index}}" hidden
                                value="from_storage_{{ $question_item->id }}">
                            @if(explode('/', $question_item->question_item_media->media_type)[0] == 'audio')
                                <?php $preview_image_src = "/assets/backoffice_assets/icons/Soundclip_Icon.svg"; ?>
                            @elseif(explode('/', $question_item->question_item_media->media_type)[0] == 'video')
                                <?php $preview_image_src = "/assets/backoffice_assets/icons/Video_Icon.svg"; ?>
                            @else
                                <?php $preview_image_src = '/webapp-macau-storage/questions/'.$question->id.'/question_item/'.$question_item->id.'/'.$question_item->question_item_media->media_url; ?>
                            @endif
                            <a class="btn btn-theme remove_button associate_media_preview button-wrap ml-auto"
                                data-toggle="tooltip" 
                                data-html="true"
                                title='<img src="{{ $preview_image_src }}" 
                                title="{{ $question_item->question_item_media->media_url }}" class="associate_media_thumbnail_img mr-2" style="width: 100%;">'>
                                <img src="{{ $preview_image_src }}" 
                                title="{{ $question_item->question_item_media->media_url }}" class="associate_media_thumbnail_img mr-2">
                                <span class="associate_media_thumbnail_title">{{ $question_item->question_item_media->media_url }}</span>
                                <img class="associate_media_thumbnail_remove" id="corr_image_file_remove_{{$loop->index}}" src="/assets/backoffice_assets/icons/Cross.svg">
                            </a>
                        @endif
                        <input type="hidden" name="existent_question_item_id_{{ $loop->index }}" value="{{ $question_item->id }}">

                        <a href="#" class="btn btn-theme remove_button remove_row remove_automatic_content ml-2" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <label class="label_title mb-0 text_number">
                        <span>Texto 1</span>
                    </label>
                </div>
                <div class="col-12 mb-2">
                    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                        *Escreva o texto original para que as suas palavras possam ser separadas (com pré-visualização).
                    </p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                        <textarea class="form-control" name="split_textarea_0" id="split_textarea_0" cols="30" rows="4" placeholder="Texto original..."></textarea>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                        <textarea class="form-control" name="split_preview_0" id="split_preview_0" cols="30" rows="4" placeholder="Pré-visualização..." disabled style="background-color: #e9ecef5c;"></textarea>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <a href="#" id="split_file_button_0" class="btn search-btn button-wrap comment_submit ml-auto" style="float: none; padding: 16px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Associar Media
                    </a>
                    <a href="#" class="btn btn-theme remove_button remove_row remove_automatic_content ml-2" style="float: none; padding: 16px 20px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Remover
                    </a>
                </div>
            @endif
        </div>
        <div class="row mb-3">
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <a href="#" class="btn search-btn comment_submit m-3 button_add_split" style="font-size: 21px; float: none;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                    Adicionar Alínea
                </a>
            </div>
        </div>

    </form>

</div>

{{-- CLONES --}}

<div class="add_split_clone" hidden>
    <div class="col-12 mb-1 hr_row"><hr></div>
    @if (isset($question->id) && $question->question_subtype_id == 13)
        @foreach ($question->question_items as $question_item)
            @if($loop->last)
                <div class="col-12">
                    <label class="label_title mb-0 text_number">
                        <span>Texto {{ $loop->index + 1 }}</span>
                    </label>
                </div>
                <div class="col-12 mb-2">
                    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                        *Escreva o texto original para que as suas palavras possam ser separadas (com pré-visualização).
                    </p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                        <textarea class="form-control" name="split_textarea_{{$loop->index}}" id="split_textarea_{{$loop->index}}" cols="30" rows="4" placeholder="Texto original..."></textarea>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                        <textarea class="form-control" name="split_preview_{{$loop->index}}" id="split_preview_{{$loop->index}}" cols="30" rows="4" placeholder="Pré-visualização..." disabled style="background-color: #e9ecef5c;"></textarea>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <a href="#" id="split_file_button_{{$loop->index}}" class="btn search-btn button-wrap comment_submit ml-auto" style="float: none; padding: 16px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Associar Media
                    </a>
                    <a href="#" class="btn btn-theme remove_button remove_row remove_automatic_content" style="float: right; padding: 16px 20px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Remover
                    </a>
                </div>
            @endif
        @endforeach
    @else
        <div class="col-12">
            <label class="label_title mb-0 text_number">
                <span>Texto 1</span>
            </label>
        </div>
        <div class="col-12 mb-2">
            <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                *Escreva o texto original para que as suas palavras possam ser separadas (com pré-visualização).
            </p>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
            <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                <textarea class="form-control" name="split_textarea_0" id="split_textarea_0" cols="30" rows="4" placeholder="Texto original..."></textarea>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
            <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                <textarea class="form-control" name="split_preview_0" id="split_preview_0" cols="30" rows="4" placeholder="Pré-visualização..." disabled style="background-color: #e9ecef5c;"></textarea>
            </div>
        </div>
        <div class="col-12 text-right">
            <a href="#" id="split_file_button_0" class="btn search-btn button-wrap comment_submit ml-auto" style="float: none; padding: 16px 20px; margin-left: 15px;">
                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Associar Media
            </a>
            <a href="#" class="btn btn-theme remove_button remove_row remove_automatic_content ml-2" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
    @endif
    
</div>
