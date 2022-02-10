<div class="custom-tab customize-tab tabs_creative to_choose differences">
    <ul class="nav nav-tabs p-0 b-0 m-auto with-border" id="differences_tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ (isset($question->id) && $question->question_subtype_id == 11) 
                            || !isset($question->id)
                            || $question->question_subtype_id != 19 ? 'active' : '' }}" 
                id="differences-differences-tab" data-toggle="tab" href="#differences-differences" role="tab" aria-controls="differences-differences" 
                aria-selected="{{ (isset($question->id) && $question->question_subtype_id == 11) || !isset($question->id) ? 'true' : 'false' }}">Diferenças</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (isset($question->id) && $question->question_subtype_id == 19) ? 'active' : '' }}" 
            id="differences-find-words-tab" data-toggle="tab" href="#differences-find-words" role="tab" aria-controls="differences-find-words" 
            aria-selected="{{ (isset($question->id) && $question->question_subtype_id == 19) ? 'true' : 'false' }}">Descobrir Palavras</a>
        </li>
    </ul>

    <div class="tab-content mt-4" id="differences_tabs_content">

        <div class="tab-pane fade {{ (isset($question->id) && $question->question_subtype_id == 11) 
                        || !isset($question->id)
                        || $question->question_subtype_id != 19 ? 'show active' : '' }}" id="differences-differences" role="tabpanel" aria-labelledby="differences-differences-tab">

            <div class="form-group">

                <form id="form-differences-differences" class="question-form" action=""  enctype="multipart/form-data">
                    @csrf

                    @if (isset($question->id) && $question->question_subtype_id == 11)
                        @foreach ($question->question_items as $question_item)
                            @if (!$loop->first)
                                <div class="col-12 mb-3 hr_row"><hr></div>
                            @endif
                            <div class="row_to_remove row mb-3 ">
                                <div class="col-12">
                                    <label class="label_title mb-0 text_number">
                                    <span>Texto {{ $loop->index + 1 }}</span>
                                    </label>
                                    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                        *Insira o texto com as diferenças a apresentar ao aluno.
                                    </p>
                                </div>
                                <div class="col col-wrap d-flex mb-3 align-items-center">
                                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);width: -webkit-fill-available;">
                                        <textarea class="form-control" name="differences_text_{{$loop->index}}" id="differences_text_{{$loop->index}}" cols="30" rows="5" placeholder="">{{$question_item->text_1}}</textarea>
                                    </div>

                                    <div class="d-block float-right text-center ml-auto">
                                        <a href="#" id="differences_file_button_{{$loop->index}}" class="btn search-btn button-wrap comment_submit button-wrap-2 ml-auto mt-1 mb-1" 
                                            style="float: none; padding: 16px 20px; margin-left: 15px; display: {{$question_item->question_item_media ? 'none' : 'inline-block'}};">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                            Associar Media
                                        </a>


                                        @if($question_item->question_item_media)
                                            <input type="text" name="differences_file_input_{{$loop->index}}" id="differences_file_input_{{$loop->index}}" hidden
                                                value="from_storage_{{ $question_item->id }}">
                                            @if(explode('/', $question_item->question_item_media->media_type)[0] == 'audio')
                                                <?php $preview_image_src = "/assets/backoffice_assets/icons/Soundclip_Icon.svg"; ?>
                                            @elseif(explode('/', $question_item->question_item_media->media_type)[0] == 'video')
                                                <?php $preview_image_src = "/assets/backoffice_assets/icons/Video_Icon.svg"; ?>
                                            @else
                                                <?php $preview_image_src = '/webapp-macau-storage/questions/'.$question->id.'/question_item/'.$question_item->id.'/'.$question_item->question_item_media->media_url; ?>
                                            @endif
                                            <a class="btn btn-theme remove_button associate_media_preview button-wrap button-wrap-2 ml-auto mt-1 mb-1"
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


                                        <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row remove_fill_option mt-1 mb-1" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                            Remover
                                        </a>
                                    </div>
                                    {{-- <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap; height: fit-content;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                        Remover
                                    </a> --}}
                                </div>
                                <div class="col-12">
                                    <label class="label_title mb-0 solution_number">
                                        <span>Solução {{ $loop->index + 1 }}</span>
                                    </label>
                                    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                        *Insira o texto correto, para termos de correção.
                                    </p>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                                        <textarea class="form-control" name="differences_solution_{{$loop->index}}" id="differences_solution_{{$loop->index}}" cols="30" rows="5" placeholder="">{{$question_item->text_2}}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row_to_remove row mb-3 ">
                            <div class="col-12">
                                <label class="label_title mb-0 text_number">
                                    <span>Texto 1</span>
                                </label>
                                <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                    *Insira o texto com as diferenças a apresentar ao aluno.
                                </p>
                            </div>
                            <div class="col col-wrap d-flex mb-3 align-items-center">
                                <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);width: -webkit-fill-available;">
                                    <textarea class="form-control" name="differences_text_0" id="differences_text_0" cols="30" rows="5" placeholder=""></textarea>
                                </div>
                                <div class="d-block float-right text-center ml-auto">
                                    <a href="#" id="differences_file_button_0" class="btn search-btn button-wrap comment_submit button-wrap-2 ml-auto mt-1 mb-1" style="float: none; padding: 16px 20px; margin-left: 15px;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                        Associar Media
                                    </a>
                                    <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row remove_fill_option mt-1 mb-1" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                        Remover
                                    </a>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="label_title mb-0 solution_number">
                                    <span>Solução 1</span>
                                </label>
                                <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                    *Insira o texto correto, para termos de correção.
                                </p>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                                    <textarea class="form-control" name="differences_solution_0" id="differences_solution_0" cols="30" rows="5" placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                            <a href="#" class="btn search-btn comment_submit m-3 button_add_differences_differences" style="font-size: 21px; float: none;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                                Adicionar Alínea
                            </a>
                        </div>
                    </div>

                </form>
            </div>

        </div>

        <div class="tab-pane fade {{ (isset($question->id) && $question->question_subtype_id == 19) ? 'show active' : '' }}" id="differences-find-words" role="tabpanel" aria-labelledby="differences-find-words-tab">

            <div class="form-group">

                <form id="form-differences-find-words" class="question-form" action=""  enctype="multipart/form-data">
                    @csrf
                    @if (isset($question->id) && $question->question_subtype_id == 19)
                        <div class="row mb-3">
                            @foreach ($question->question_items as $question_item)
                                @if(!$loop->first)
                                    <div class="col-12 mb-3 hr_row"><hr></div>
                                @endif
                                <div class="col-12">
                                    <label class="label_title question_number m-0">
                                        <span>Texto {{ $loop->index + 1 }}</span>
                                        <a href="#" id="find_words_perc_delimiter_{{$loop->index}}" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                                            <% %>
                                        </a>
                                    </label>
                                    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                        *Insira dentro de <% %> as palavras diferentes/incorretas.
                                    </p>
                                </div>
                                <div class="col col-wrap d-flex mb-3 align-items-center">
                                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);width: -webkit-fill-available;">
                                        <textarea class="form-control" name="differences_find_words_textarea_{{$loop->index}}" id="differences_find_words_textarea_{{$loop->index}}" cols="30" rows="5">{{ $question_item->text_1 }}</textarea>
                                    </div>

                                    <div class="d-block float-right text-center ml-auto">
                                        <a href="#" id="differences_find_words_file_button_{{$loop->index}}" class="btn search-btn button-wrap comment_submit button-wrap-2 ml-auto mt-1 mb-1" 
                                            style="float: none; padding: 16px 20px; margin-left: 15px; display: {{$question_item->question_item_media ? 'none' : 'inline-block'}};">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                            Associar Media
                                        </a>

                                        @if($question_item->question_item_media)
                                            <input type="text" name="differences_find_words_file_input_{{$loop->index}}" id="differences_find_words_file_input_{{$loop->index}}" hidden
                                                value="from_storage_{{ $question_item->id }}">
                                            @if(explode('/', $question_item->question_item_media->media_type)[0] == 'audio')
                                                <?php $preview_image_src = "/assets/backoffice_assets/icons/Soundclip_Icon.svg"; ?>
                                            @elseif(explode('/', $question_item->question_item_media->media_type)[0] == 'video')
                                                <?php $preview_image_src = "/assets/backoffice_assets/icons/Video_Icon.svg"; ?>
                                            @else
                                                <?php $preview_image_src = '/webapp-macau-storage/questions/'.$question->id.'/question_item/'.$question_item->id.'/'.$question_item->question_item_media->media_url; ?>
                                            @endif
                                            <a class="btn btn-theme remove_button associate_media_preview button-wrap button-wrap-2 ml-auto mt-1 mb-1"
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

                                        <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap; height: fit-content;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                            Remover
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="label_title question_number m-0">
                                    <span>Texto 1</span>
                                    <a href="#" id="find_words_perc_delimiter_0" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                                        <% %>
                                    </a>
                                </label>
                                <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                    *Insira dentro de <% %> as palavras diferentes/incorretas.
                                </p>
                            </div>
                            <div class="col col-wrap d-flex mb-3 align-items-center">
                                <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);width: -webkit-fill-available;">
                                    <textarea class="form-control" name="differences_find_words_textarea_0" id="differences_find_words_textarea_0" cols="30" rows="5"></textarea>
                                </div>
                                <div class="d-block float-right text-center ml-auto">
                                    <a href="#" id="differences_find_words_file_button_0" class="btn search-btn button-wrap comment_submit button-wrap-2 ml-auto mt-1 mb-1" style="float: none; padding: 16px 20px; margin-left: 15px;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                        Associar Media
                                    </a>
                                    
                                    <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap; height: fit-content;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                        Remover
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    

                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                            <a href="#" class="btn search-btn comment_submit m-3 button_add_differences_find_words" style="font-size: 21px; float: none;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                                Adicionar Alínea
                            </a>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>

{{-- CLONES --}}

<div class="add_differences_clone" hidden>
    <div class="col-12 mb-3 hr_row"><hr></div>
    @if (isset($question->id) && $question->question_subtype_id == 11)
        @foreach ($question->question_items as $question_item)
            @if($loop->last)
                <div class="row_to_remove row mb-3 ">
                    <div class="col-12">
                        <label class="label_title mb-0 text_number">
                            <span>Texto {{ $loop->index + 1 }}</span>
                        </label>
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *Insira o texto com as diferenças a apresentar ao aluno.
                        </p>
                    </div>
                    <div class="col col-wrap d-flex mb-3 align-items-center">
                        <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);width: -webkit-fill-available;">
                            <textarea class="form-control" name="differences_text_{{$loop->index}}" id="differences_text_{{$loop->index}}" cols="30" rows="5" placeholder=""></textarea>
                        </div>
                        <div class="d-block float-right text-center ml-auto">
                            <a href="#" id="differences_file_button_{{$loop->index}}" class="btn search-btn button-wrap comment_submit button-wrap-2 ml-auto mt-1 mb-1" style="float: none; padding: 16px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                Associar Media
                            </a>
                            <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row remove_fill_option mt-1 mb-1" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                Remover
                            </a>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="label_title mb-0 solution_number">
                            <span>Solução {{ $loop->index + 1 }}</span>
                        </label>
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *Insira o texto correto, para termos de correção.
                        </p>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                        <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                            <textarea class="form-control" name="differences_solution_{{$loop->index}}" id="differences_solution_{{$loop->index}}" cols="30" rows="5" placeholder=""></textarea>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <div class="row_to_remove row mb-3 ">
            <div class="col-12">
                <label class="label_title mb-0 text_number">
                    <span>Texto 1</span>
                </label>
                <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                    *Insira o texto com as diferenças a apresentar ao aluno.
                </p>
            </div>
            <div class="col col-wrap d-flex mb-3 align-items-center">
                <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);width: -webkit-fill-available;">
                    <textarea class="form-control" name="differences_text_0" id="differences_text_0" cols="30" rows="5" placeholder=""></textarea>
                </div>
                <div class="d-block float-right text-center ml-auto">
                    <a href="#" id="differences_file_button_0" class="btn search-btn button-wrap comment_submit button-wrap-2 ml-auto mt-1 mb-1" style="float: none; padding: 16px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Associar Media
                    </a>
                    <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row remove_fill_option mt-1 mb-1" style="float: none; padding: 16px 20px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Remover
                    </a>
                </div>
            </div>
            <div class="col-12">
                <label class="label_title mb-0 solution_number">
                    <span>Solução 1</span>
                </label>
                <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                    *Insira o texto correto, para termos de correção.
                </p>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                    <textarea class="form-control" name="differences_solution_0" id="differences_solution_0" cols="30" rows="5" placeholder=""></textarea>
                </div>
            </div>
        </div>
    @endif
    
</div>

<div class="add_differences_find_words_clone" hidden>
    <div class="col-12 mb-3 hr_row"><hr></div>
    @if (isset($question->id) && $question->question_subtype_id == 19)
        @foreach ($question->question_items as $question_item)
            @if($loop->last)
                <div class="row_to_remove row mb-3 ">
                    <div class="col-12">
                        <label class="label_title question_number m-0">
                            <span>Texto {{$loop->index + 1}}</span>
                            <a href="#" id="find_words_perc_delimiter_{{$loop->index}}" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                                <% %>
                            </a>
                        </label>
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *Insira dentro de <% %> as palavras diferentes/incorretas.
                        </p>
                    </div>
                    <div class="col col-wrap d-flex mb-3 align-items-center">
                        <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);width: -webkit-fill-available;">
                            <textarea class="form-control" name="differences_find_words_textarea_{{$loop->index}}" id="differences_find_words_textarea_{{$loop->index}}" cols="30" rows="5"></textarea>
                        </div>
                        <div class="d-block float-right text-center ml-auto">
                            <a href="#" id="differences_find_words_file_button_{{$loop->index}}" class="btn search-btn button-wrap comment_submit button-wrap-2 ml-auto mt-1 mb-1" style="float: none; padding: 16px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                Associar Media
                            </a>
                            
                            <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap; height: fit-content;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                Remover
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <div class="row_to_remove row mb-3 ">
            <div class="col-12">
                <label class="label_title question_number m-0">
                    <span>Texto 1</span>
                    <a href="#" id="find_words_perc_delimiter_0" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                        <% %>
                    </a>
                </label>
                <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                    *Insira dentro de <% %> as palavras diferentes/incorretas.
                </p>
            </div>
            <div class="d-block float-right text-center ml-auto">
                <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);width: -webkit-fill-available;">
                    <textarea class="form-control" name="differences_find_words_textarea_0" id="differences_find_words_textarea_0" cols="30" rows="5"></textarea>
                </div>
                <div class="d-block float-right text-center ml-auto">
                    <a href="#" id="differences_find_words_file_button_0" class="btn search-btn button-wrap comment_submit button-wrap-2 ml-auto mt-1 mb-1" style="float: none; padding: 16px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Associar Media
                    </a>
                    <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap; height: fit-content;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Remover
                    </a>
                </div>
            </div>
        </div>
    @endif
    
</div>