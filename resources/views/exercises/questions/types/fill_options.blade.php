<div class="custom-tab customize-tab tabs_creative to_choose fill_options">
    <ul class="nav nav-tabs p-0 b-0 m-auto with-border" id="fill_options_tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ (isset($question->id) && $question->question_subtype_id == 5) 
                            || !isset($question->id)
                            || ($question->question_subtype_id != 6
                            && $question->question_subtype_id != 18) ? 'active' : '' }}" 
                id="fill_options-shuffle-tab" data-toggle="tab" href="#fill_options-shuffle" role="tab" aria-controls="fill_options-shuffle" 
                aria-selected="{{ (isset($question->id) && $question->question_subtype_id == 5) || !isset($question->id) ? 'true' : 'false' }}">
                Mistura
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (isset($question->id) && $question->question_subtype_id == 6) ? 'active' : '' }}" 
                id="fill_options-text_words-tab" data-toggle="tab" href="#fill_options-text_words" role="tab" aria-controls="fill_options-text_words" 
                aria-selected="{{ (isset($question->id) && $question->question_subtype_id == 6) ? 'true' : 'false' }}">
                Palavras em texto
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (isset($question->id) && $question->question_subtype_id == 18) ? 'active' : '' }}" 
                id="fill_options-writing-tab" data-toggle="tab" href="#fill_options-writing" role="tab" aria-controls="fill_options-writing" 
                aria-selected="{{ (isset($question->id) && $question->question_subtype_id == 18) ? 'true' : 'false' }}">
                Escrever
            </a>
        </li>
    </ul>

    <div class="tab-content mt-4" id="fill_options_tabs_content">

        <div class="tab-pane fade {{ (isset($question->id) && $question->question_subtype_id == 5) 
                            || !isset($question->id)
                            || ($question->question_subtype_id != 6
                            && $question->question_subtype_id != 18) ? 'show active' : '' }}" id="fill_options-shuffle" role="tabpanel" aria-labelledby="fill_options-shuffle-tab">
            
            <div class="form-group">

                <form id="form-fill_options-shuffle" class="question-form" action=""  enctype="multipart/form-data">
                    @csrf
                    @if (isset($question->id) && $question->question_subtype_id == 5)
                        <div class="row mb-3">
                            @foreach ($question->question_items as $question_item)
                                @if(!$loop->first)
                                    <div class="col-12 mb-3 hr_row"><hr></div>
                                @endif
                                <div class="col-12">
                                    <label class="label_title question_number m-0">
                                        <span>Questão {{ $loop->index + 1 }}</span>
                                        <a href="#" id="fill_perc_delimiter_{{$loop->index}}" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                                            <% %>
                                        </a>
                                    </label>
                                    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                        *Insira dentro de <% %> os termos no local para preenchimento.
                                    </p>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                                        <textarea class="form-control" name="fill_textarea_{{$loop->index}}" id="fill_textarea_{{$loop->index}}" cols="30" rows="3" placeholder="Questão...">{{ $question_item->text_1 }}</textarea>
                                    </div>
                                    
                                    <div class="d-block float-right mt-3">
                                        <a href="#" id="fill_associate_media_file_button_{{$loop->index}}" class="btn search-btn button-wrap comment_submit" 
                                            style="float: none; padding: 16px 20px; margin-left: 15px; display: {{$question_item->question_item_media ? 'none' : 'inline-block'}};">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                            Associar Media
                                        </a>
                                        @if($question_item->question_item_media)
                                            <input type="text" name="fill_associate_media_file_input_{{$loop->index}}" id="fill_associate_media_file_input_{{$loop->index}}" hidden
                                                value="from_storage_{{ $question_item->id }}">
                                            <a href="#" class="btn btn-theme remove_button associate_media_preview button-wrap">
                                                <img src="{{ '/webapp-macau-storage/questions/'.$question->id.'/question_item/'.$question_item->id.'/'.$question_item->question_item_media->media_url }}" 
                                                title="{{ $question_item->question_item_media->media_url }}" class="associate_media_thumbnail_img mr-2">
                                                <span class="associate_media_thumbnail_title">{{ $question_item->question_item_media->media_url }}</span>
                                                <img class="associate_media_thumbnail_remove" id="corr_image_file_remove_{{$loop->index}}" src="/assets/backoffice_assets/icons/Cross.svg">
                                            </a>
                                        @endif
                                        <input type="hidden" name="existent_question_item_id_{{ $loop->index }}" value="{{ $question_item->id }}">
                                        <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row remove_fill_option" style="float: none; padding: 16px 20px; white-space: nowrap;">
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
                                    <span>Questão 1</span>
                                    <a href="#" id="fill_perc_delimiter_0" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                                        <% %>
                                    </a>
                                </label>
                                <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                    *Insira dentro de <% %> os termos no local para preenchimento.
                                </p>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                                    <textarea class="form-control" name="fill_textarea_0" id="fill_textarea_0" cols="30" rows="3" placeholder="Questão..."></textarea>
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
                    @endif
                    

                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                            <a href="#" class="btn search-btn comment_submit m-3 button_add_fill" style="font-size: 21px; float: none;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                                Adicionar Alínea
                            </a>
                        </div>
                    </div>

                </form>

            </div>

        </div>

        <div class="tab-pane fade {{ (isset($question->id) && $question->question_subtype_id == 6) ? 'show active' : '' }}" id="fill_options-text_words" role="tabpanel" aria-labelledby="fill_options-text_words-tab">
            
            <div class="form-group">

                <form id="form-fill_options-text_words" class="question-form" action=""  enctype="multipart/form-data">
                    @csrf
                    @if (isset($question->id) && $question->question_subtype_id == 6)
                        @foreach ($question->question_items as $question_item)
                            @if (!$loop->first)
                                <div class="col-12 mb-3 hr_row" style="display: contents;"><hr></div>
                            @endif
                            <div>
                                {{-- Categories ROW --}}
                                <div class="row_to_remove row mb-0 align-items-center questions_row">
                                    <div class="col-12">
                                        <label class="label_title question_number m-0">
                                            <span>Frase {{ $loop->index + 1 }}</span>
                                            <a href="#" id="text_word_perc_delimiter_0" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                                                <% %>
                                            </a>
                                        </label>
                                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                            *Escolha as possíveis opções em cada espaço possível <% %>.
                                        </p>
                                    </div>
                                    <div class="col col-wrap d-flex mb-3 align-items-center">
                                        <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01); width: -webkit-fill-available !important;">
                                            <textarea class="form-control" name="fill_text_word_{{$loop->index}}" id="fill_text_word_{{$loop->index}}" cols="30" rows="3" placeholder="Frase...">{{$question_item->text_1}}</textarea>
                                        </div>
                                        <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap; height: fit-content;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                            Remover
                                        </a>
                                    </div>
                                </div>
                                {{-- Answers ROW --}}
                                <div class="row mb-3 pl-3 align-items-center select2_with_search" id="selects_row_text_words_{{$loop->index}}">
                                    @for ($i = 0; $i < $question_item->options_number; $i++)
                                        <?php $option = "options_".($i+1); ?>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-1 d-flex">
                                            <p class="exercise_level align-self-center m-0">{{$i+1}}ª&nbsp;&nbsp;</p>
                                            <select name="select_text_word_{{$loop->index}}_option_{{$i}}[]" id="select_text_word_{{$loop->index}}_option_{{$i}}" class="form-control select_vowels_class" multiple>
                                                @foreach (explode('|', $question_item->$option) as $select_option)
                                                    <option value="{{$select_option}}" selected>{{$select_option}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div>
                            {{-- Categories ROW --}}
                            <div class="row_to_remove row mb-0 align-items-center questions_row">
                                <div class="col-12">
                                    <label class="label_title question_number m-0">
                                        <span>Frase 1</span>
                                        <a href="#" id="text_word_perc_delimiter_0" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                                            <% %>
                                        </a>
                                    </label>
                                    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                        *Escolha as possíveis opções em cada espaço possível <% %>.
                                    </p>
                                </div>
                                <div class="col col-wrap d-flex mb-3 align-items-center">
                                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01); width: -webkit-fill-available !important;">
                                        <textarea class="form-control" name="fill_text_word_0" id="fill_text_word_0" cols="30" rows="3" placeholder="Frase..."></textarea>
                                    </div>
                                    <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap; height: fit-content;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                        Remover
                                    </a>
                                </div>
                            </div>
                            {{-- Answers ROW --}}
                            <div class="row mb-3 pl-3 align-items-center select2_with_search" id="selects_row_text_words_0">
                            </div>
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                            <a href="#" class="btn search-btn comment_submit m-3 button_add_fill_text_words" style="font-size: 21px; float: none;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                                Adicionar Alínea
                            </a>
                        </div>
                    </div>

                </form>

            </div>

        </div>

        <div class="tab-pane fade {{ (isset($question->id) && $question->question_subtype_id == 18) ? 'show active' : '' }}" id="fill_options-writing" role="tabpanel" aria-labelledby="fill_options-writing-tab">
            
            <div class="form-group">

                <form id="form-fill_options-writing" class="question-form" action=""  enctype="multipart/form-data">
                    @csrf
                    @if (isset($question->id) && $question->question_subtype_id == 18)
                        <div class="row mb-3">
                            @foreach ($question->question_items as $question_item)
                                @if(!$loop->first)
                                    <div class="col-12 mb-3 hr_row"><hr></div>
                                @endif
                                <div class="col-12">
                                    <label class="label_title question_number m-0">
                                        <span>Frase {{ $loop->index + 1 }}</span>
                                        <a href="#" id="fill_options_writing_perc_delimiter_{{$loop->index}}" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                                            <% %>
                                        </a>
                                    </label>
                                    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                        *Insira dentro de <% %> os termos no local para preenchimento.
                                    </p>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                                        <textarea class="form-control" name="fill_options_writing_textarea_{{$loop->index}}" id="fill_options_writing_textarea_{{$loop->index}}" cols="30" rows="3" placeholder="Frase...">{{ $question_item->text_1 }}</textarea>
                                    </div>
                                    
                                    <div class="d-block float-right mt-3">
                                        <a href="#" id="fill_options_writing_associate_media_file_button_{{$loop->index}}" class="btn search-btn button-wrap comment_submit" 
                                            style="float: none; padding: 16px 20px; margin-left: 15px; display: {{$question_item->question_item_media ? 'none' : 'inline-block'}};">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                            Associar Media
                                        </a>
                                        @if($question_item->question_item_media)
                                            <input type="text" name="fill_options_writing_associate_media_file_input_{{$loop->index}}" id="fill_options_writing_associate_media_file_input_{{$loop->index}}" hidden
                                                value="from_storage_{{ $question_item->id }}">
                                            <a href="#" class="btn btn-theme remove_button associate_media_preview button-wrap">
                                                <img src="{{ '/webapp-macau-storage/questions/'.$question->id.'/question_item/'.$question_item->id.'/'.$question_item->question_item_media->media_url }}" 
                                                title="{{ $question_item->question_item_media->media_url }}" class="associate_media_thumbnail_img mr-2">
                                                <span class="associate_media_thumbnail_title">{{ $question_item->question_item_media->media_url }}</span>
                                                <img class="associate_media_thumbnail_remove" id="corr_image_file_remove_{{$loop->index}}" src="/assets/backoffice_assets/icons/Cross.svg">
                                            </a>
                                        @endif
                                        <input type="hidden" name="existent_question_item_id_{{ $loop->index }}" value="{{ $question_item->id }}">
                                        <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row remove_fill_option" style="float: none; padding: 16px 20px; white-space: nowrap;">
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
                                    <span>Frase 1</span>
                                    <a href="#" id="fill_options_writing_perc_delimiter_0" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                                        <% %>
                                    </a>
                                </label>
                                <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                    *Insira dentro de <% %> os termos no local para preenchimento.
                                </p>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                                    <textarea class="form-control" name="fill_options_writing_textarea_0" id="fill_options_writing_textarea_0" cols="30" rows="3" placeholder="Frase..."></textarea>
                                </div>
                                
                                <div class="d-block float-right mt-3">
                                    <a href="#" id="fill_options_writing_associate_media_file_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; margin-left: 15px;">
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
                    @endif
                    

                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                            <a href="#" class="btn search-btn comment_submit m-3 button_add_fill_options_writing" style="font-size: 21px; float: none;">
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

<div class="add_fill_clone" hidden>
    <div class="col-12 mb-3 hr_row"><hr></div>
    @if (isset($question->id) && $question->question_subtype_id == 5)
        @foreach ($question->question_items as $question_item)
            @if($loop->last)
                <div class="col-12">
                    <label class="label_title question_number m-0">
                        <span>Questão {{$loop->index + 1}}</span>
                        <a href="#" id="fill_perc_delimiter_{{$loop->index}}" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                            <% %>
                        </a>
                    </label>
                    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                        *Insira dentro de <% %> os termos no local para preenchimento.
                    </p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                        <textarea class="form-control" name="fill_textarea_{{$loop->index}}" id="fill_textarea_{{$loop->index}}" cols="30" rows="3" placeholder=""></textarea>
                    </div>
                    
                    <div class="d-block float-right mt-3">
                        <a href="#" id="fill_associate_media_file_button_{{$loop->index}}" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; margin-left: 15px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Associar Media
                        </a>
                        <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row remove_fill_option" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <div class="col-12">
            <label class="label_title question_number m-0">
                <span>Questão 1</span>
                <a href="#" id="fill_perc_delimiter_0" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                    <% %>
                </a>
            </label>
            <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                *Insira dentro de <% %> os termos no local para preenchimento.
            </p>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
            <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                <textarea class="form-control" name="fill_textarea_0" id="fill_textarea_0" cols="30" rows="3" placeholder=""></textarea>
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
    @endif
    
</div>

<div class="add_fill_text_words_clone" hidden>
    <div>
        <div class="col-12 mb-3 hr_row" style="display: contents;"><hr></div>
        @if (isset($question->id) && $question->question_subtype_id == 6)
            @foreach ($question->question_items as $question_item)
                @if($loop->last)
                    {{-- Categories ROW --}}
                    <div class="row_to_remove row mb-0 align-items-center questions_row">
                        <div class="col-12">
                                <label class="label_title question_number m-0">
                                <span>Frase {{ $loop->index + 1 }}</span>
                                <a href="#" id="text_word_perc_delimiter_{{$loop->index}}" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                                    <% %>
                                </a>
                            </label>
                            <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                *Escolha as possíveis opções em cada espaço possível <% %>.
                            </p>
                        </div>
                        <div class="col col-wrap d-flex mb-3 align-items-center">
                            <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01); width: -webkit-fill-available !important;">
                                <textarea class="form-control" name="fill_text_word_{{$loop->index}}" id="fill_text_word_{{$loop->index}}" cols="30" rows="3" placeholder="Texto..."></textarea>
                            </div>
                            <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap; height: fit-content;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                Remover
                            </a>
                        </div>
                    </div>
                    {{-- Answers ROW --}}
                    <div class="row mb-3 pl-3 align-items-center select2_with_search" id="selects_row_text_words_{{$loop->index}}">
                    </div>
                @endif
            @endforeach
        @else
            {{-- Categories ROW --}}
            <div class="row_to_remove row mb-0 align-items-center questions_row">
                <div class="col-12">
                        <label class="label_title question_number m-0">
                        <span>Frase 1</span>
                        <a href="#" id="text_word_perc_delimiter_0" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                            <% %>
                        </a>
                    </label>
                    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                        *Escolha as possíveis opções em cada espaço possível <% %>.
                    </p>
                </div>
                <div class="col col-wrap d-flex mb-3 align-items-center">
                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01); width: -webkit-fill-available !important;">
                        <textarea class="form-control" name="fill_text_word_0" id="fill_text_word_0" cols="30" rows="3" placeholder="Texto..."></textarea>
                    </div>
                    <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap; height: fit-content;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Remover
                    </a>
                </div>
            </div>
            {{-- Answers ROW --}}
            <div class="row mb-3 pl-3 align-items-center select2_with_search" id="selects_row_text_words_0">
            </div>
        @endif
        
    </div>
</div>

<div class="add_fill_options_writing_clone" hidden>
    <div class="col-12 mb-3 hr_row"><hr></div>
    @if (isset($question->id) && $question->question_subtype_id == 18)
        @foreach ($question->question_items as $question_item)
            @if($loop->last)
                <div class="col-12">
                    <label class="label_title question_number m-0">
                        <span>Frase {{$loop->index + 1}}</span>
                        <a href="#" id="fill_options_writing_perc_delimiter_{{$loop->index}}" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                            <% %>
                        </a>
                    </label>
                    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                        *Insira dentro de <% %> os termos no local para preenchimento.
                    </p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                        <textarea class="form-control" name="fill_options_writing_textarea_{{$loop->index}}" id="fill_options_writing_textarea_{{$loop->index}}" cols="30" rows="3" placeholder=""></textarea>
                    </div>
                    
                    <div class="d-block float-right mt-3">
                        <a href="#" id="fill_options_writing_associate_media_file_button_{{$loop->index}}" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; margin-left: 15px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Associar Media
                        </a>
                        <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row remove_fill_option" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <div class="col-12">
            <label class="label_title question_number m-0">
                <span>Frase 1</span>
                <a href="#" id="fill_options_writing_perc_delimiter_0" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                    <% %>
                </a>
            </label>
            <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                *Insira dentro de <% %> os termos no local para preenchimento.
            </p>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
            <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                <textarea class="form-control" name="fill_options_writing_textarea_0" id="fill_options_writing_textarea_0" cols="30" rows="3" placeholder=""></textarea>
            </div>
            
            <div class="d-block float-right mt-3">
                <a href="#" id="fill_options_writing_associate_media_file_button_0" class="btn search-btn button-wrap comment_submit" style="float: none; padding: 16px 20px; margin-left: 15px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                    Associar Media
                </a>
                <a href="#" class="btn btn-theme button-wrap-2 remove_button remove_row remove_fill_option" style="float: none; padding: 16px 20px; white-space: nowrap;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                    Remover
                </a>
            </div>
        </div>
    @endif
    
</div>