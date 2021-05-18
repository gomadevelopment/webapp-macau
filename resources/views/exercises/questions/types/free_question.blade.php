<div class="form-group to_choose free_question">

    <form id="form-free_question" class="question-form" action=""  enctype="multipart/form-data">
        @csrf

        <label class="label_title mb-1" style="font-size: 30px;">
            Questões <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" data-toggle="tooltip" title="Estas Tooltips servem para explicar ao Utilizador como usar o módulo." alt="" style="margin-left: 5px;"></label>
        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
            *Questões de resposta aberta/livre.
        </p>
        @if (isset($question->id) && $question->question_subtype_id == 10)
            <div class="row mb-3 align-items-center mt-2 questions_row">
                @foreach ($question->question_items as $question_item)
                    @if (!$loop->first)
                        <div class="col-12 mb-3 empty_col"></div>
                    @endif
                    <div class="row_to_remove col col-wrap d-flex mb-3">
                        <input name="free_question_{{$loop->index}}" id="free_question_{{$loop->index}}" 
                        value="{{ $question_item->text_1 }}"
                        type="text" class="form-control" placeholder="Questão...">
                        <a href="#" id="f_q_associate_media_button_{{$loop->index}}" class="btn search-btn button-wrap comment_submit" 
                            style="float: none; padding: 16px 20px; white-space: nowrap; display: {{$question_item->question_item_media ? 'none' : 'block'}};">
                            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Associar Media
                        </a>
                        @if($question_item->question_item_media)
                            <input type="text" name="f_q_associate_media_file_input_{{$loop->index}}" id="f_q_associate_media_file_input_{{$loop->index}}" hidden
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
                                <img class="associate_media_thumbnail_remove" id="corr_image_file_remove_{{$loop->index}}" src="/assets/backoffice_assets/icons/Cross.svg">
                            </a>
                        @endif
                        <input type="hidden" name="existent_question_item_id_{{ $loop->index }}" value="{{ $question_item->id }}">
                        <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Questions ROW --}}
            <div class="row mb-3 align-items-center mt-2 questions_row">
                <div class="row_to_remove col col-wrap d-flex mb-3">
                    <input name="free_question_0" id="free_question_0" type="text" class="form-control" placeholder="Questão...">
                    <a href="#" id="f_q_associate_media_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Associar Media
                    </a>
                    <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Remover
                    </a>
                </div>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <a href="#" class="btn search-btn comment_submit m-3 button_add_free_question" style="font-size: 21px; float: none;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                    Adicionar Alínea
                </a>
            </div>
        </div>

    </form>

</div>

{{-- CLONES --}}

<div class="add_free_question_clone" hidden>
    <div class="col-12 mb-3 empty_col"></div>
    @if (isset($question->id) && $question->question_subtype_id == 10)
        @foreach ($question->question_items as $question_item)
            @if($loop->last)
                {{-- Questions ROW --}}
                <div class="row_to_remove col col-wrap d-flex mb-3">
                    <input name="free_question_{{$loop->index}}" id="free_question_{{$loop->index}}" type="text" class="form-control" placeholder="Questão...">
                    <a href="#" id="f_q_associate_media_button_{{$loop->index}}" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Associar Media
                    </a>
                    <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Remover
                    </a>
                </div>
            @endif
        @endforeach
    @else
        {{-- Questions ROW --}}
        <div class="row_to_remove col col-wrap d-flex mb-3">
            <input name="free_question_0" id="free_question_0" type="text" class="form-control" placeholder="Questão...">
            <a href="#" id="f_q_associate_media_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Associar Media
            </a>
            <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
    @endif
    
</div>