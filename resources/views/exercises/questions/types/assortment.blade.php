<div class="custom-tab customize-tab tabs_creative to_choose assortment">
    <ul class="nav nav-tabs p-0 b-0 m-auto with-border" id="assortment_tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ (isset($question->id) && $question->question_subtype_id == 14) 
                        || !isset($question->id)
                        || ($question->question_subtype_id != 15
                        && $question->question_subtype_id != 16) ? 'active' : '' }}" 
                id="assort-sentences-tab" data-toggle="tab" href="#assort-sentences" role="tab" aria-controls="assort-sentences" 
                aria-selected="{{ (isset($question->id) && $question->question_subtype_id == 14) || !isset($question->id) ? 'true' : 'false' }}">
                Frases
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (isset($question->id) && $question->question_subtype_id == 15) ? 'active' : '' }}" 
                id="assort-words-tab" data-toggle="tab" href="#assort-words" role="tab" aria-controls="assort-words" 
                aria-selected="{{ (isset($question->id) && $question->question_subtype_id == 15) ? 'true' : 'false' }}">
                Palavras / Excertos
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (isset($question->id) && $question->question_subtype_id == 16) ? 'active' : '' }}" 
            id="assort-assort_images-tab" data-toggle="tab" href="#assort-assort_images" role="tab" aria-controls="assort-assort_images" 
            aria-selected="{{ (isset($question->id) && $question->question_subtype_id == 16) ? 'true' : 'false' }}">
            Imagens
        </a>
        </li>
    </ul>

    <div class="tab-content mt-4" id="assortment_tabs_content">

        <div class="tab-pane fade {{ (isset($question->id) && $question->question_subtype_id == 14) 
                            || !isset($question->id)
                            || ($question->question_subtype_id != 15
                            && $question->question_subtype_id != 16) ? 'show active' : '' }}" id="assort-sentences" role="tabpanel" aria-labelledby="assort-sentences-tab">

            <div class="form-group">

                <form id="form-assort-sentences" class="question-form" action=""  enctype="multipart/form-data">
                    @csrf

                    @if (isset($question->id) && $question->question_subtype_id == 14)
                        @foreach ($question->question_items as $question_item)
                            @if (!$loop->first)
                                <div class="mt-4 mb-3 hr_row"><hr></div>
                            @endif
                            {{-- QUESTIONS --}}
                            <div class="row_to_remove row">
                                <div class="col col-wrap d-flex m-0 align-items-center">
                                    <label class="label_title m-0 sentence_number">
                                        <span>Conjunto de Frases {{ $loop->index + 1 }}</span>
                                    </label>
                                    <a href="#" class="btn btn-theme remove_button remove_row remove_entire_question ml-auto" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                        Remover
                                    </a>
                                </div>
                                <div class="col-12">
                                    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                        *Construa conjuntos de frases de forma ordenada/correta.
                                    </p>
                                </div>
                                <input name="assort_sentences_question_{{$loop->index}}" id="assort_sentences_question_{{$loop->index}}" type="text" class="form-control" placeholder="Frase..." hidden>
                            </div>
                            {{-- SOLUTIONS --}}
                            <div class="row mt-1 mb-3 align-items-center">
                                @for ($i = 0; $i < $question_item->options_number; $i++)
                                    @if($i != 0)
                                        <div class="col-12 empty_col"></div>
                                    @endif
                                    <div class="row_to_remove col col-wrap d-flex mb-3">
                                        <?php $option = "options_".($i+1); ?>

                                        <input name="assort_sentences_sentence_{{$i}}_question_{{$loop->index}}" id="assort_sentences_sentence_{{$i}}_question_{{$loop->index}}" 
                                        value="{{ $question_item->$option }}"
                                        type="text" class="form-control" placeholder="Resposta...">
                                        <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                            Remover
                                        </a>
                                    </div>
                                    @if(($i + 1) == $question_item->options_number)
                                        <div class="col-12">
                                            <a href="#" id="add_assort_sentences_question_{{$loop->index}}_sentence_{{ ($i+1) }}" class="btn search-btn comment_submit button_add_assort_sentences_solution question_0 solution_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                                                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                                                Adicionar
                                            </a>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        @endforeach
                    @else
                        {{-- QUESTIONS --}}
                        <div class="row_to_remove row">
                            <div class="col col-wrap d-flex m-0 align-items-center">
                                <label class="label_title m-0 sentence_number">
                                    <span>Conjunto de Frases 1</span>
                                </label>
                                <a href="#" class="btn btn-theme remove_button remove_row remove_entire_question ml-auto" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                    Remover
                                </a>
                            </div>
                            <div class="col-12">
                                <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                    *Construa conjuntos de frases de forma ordenada/correta.
                                </p>
                            </div>
                            <input name="assort_sentences_question_0" id="assort_sentences_question_0" type="text" class="form-control" placeholder="Frase..." hidden>
                        </div>
                        {{-- SOLUTIONS --}}
                        <div class="row mt-1 mb-3 align-items-center">
                            <div class="row_to_remove col col-wrap d-flex mb-3">
                                <input name="assort_sentences_sentence_0_question_0" id="assort_sentences_sentence_0_question_0" type="text" class="form-control" placeholder="Resposta...">
                                <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                    Remover
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="#" id="add_assort_sentences_question_0_sentence_1" class="btn search-btn comment_submit button_add_assort_sentences_solution question_0 solution_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                                    Adicionar
                                </a>
                            </div>
                        </div>
                    @endif
                    
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                            <a href="#" class="btn search-btn comment_submit m-3 button_add_assort_sentence" style="font-size: 21px; float: none;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                                Adicionar Alínea
                            </a>
                        </div>
                    </div>

                </form>

            </div>

        </div>

        <div class="tab-pane fade {{ (isset($question->id) && $question->question_subtype_id == 15) ? 'show active' : '' }}" id="assort-words" role="tabpanel" aria-labelledby="assort-words-tab">

            <div class="form-group">

                <form id="form-assort-words" class="question-form" action=""  enctype="multipart/form-data">
                    @csrf

                    @if (isset($question->id) && $question->question_subtype_id == 15)
                        @foreach ($question->question_items as $question_item)
                            @if (!$loop->first)
                                <div class="mt-4 mb-3 hr_row"><hr></div>
                            @endif
                            {{-- QUESTIONS --}}
                            <div class="row_to_remove row">
                                <div class="col col-wrap d-flex m-0 align-items-center">
                                    <label class="label_title m-0 sentence_number">
                                        <span>Frase {{ $loop->index + 1 }}</span>
                                    </label>
                                    <a href="#" id="assort_words_media_button_{{$loop->index}}" class="btn search-btn comment_submit ml-auto" 
                                        style="float: none; padding: 16px 20px; white-space: nowrap; display: {{$question_item->question_item_media ? 'none' : 'block'}};">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                        Associar Media
                                    </a>
                                    @if($question_item->question_item_media)
                                        <input type="text" name="assort_words_media_file_input_{{$loop->index}}" id="assort_words_media_file_input_{{$loop->index}}" hidden
                                            value="from_storage_{{ $question_item->id }}">
                                        @if(explode('/', $question_item->question_item_media->media_type)[0] == 'audio')
                                            <?php $preview_image_src = "/assets/backoffice_assets/icons/Soundclip_Icon.svg"; ?>
                                        @elseif(explode('/', $question_item->question_item_media->media_type)[0] == 'video')
                                            <?php $preview_image_src = "/assets/backoffice_assets/icons/Video_Icon.svg"; ?>
                                        @else
                                            <?php $preview_image_src = '/webapp-macau-storage/questions/'.$question->id.'/question_item/'.$question_item->id.'/'.$question_item->question_item_media->media_url; ?>
                                        @endif
                                        <a href="#" class="btn btn-theme remove_button associate_media_preview ml-auto">
                                            <img src="{{ $preview_image_src }}" 
                                            title="{{ $question_item->question_item_media->media_url }}" class="associate_media_thumbnail_img mr-2">
                                            <span class="associate_media_thumbnail_title">{{ $question_item->question_item_media->media_url }}</span>
                                            <img class="associate_media_thumbnail_remove" src="/assets/backoffice_assets/icons/Cross.svg">
                                        </a>
                                    @endif
                                    <input type="hidden" name="existent_question_item_id_{{ $loop->index }}" value="{{ $question_item->id }}">
                                    <a href="#" class="btn btn-theme remove_button remove_row remove_entire_question ml-2" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                        Remover
                                    </a>
                                </div>
                                <div class="col-12">
                                    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                        *Construa a frase separada em palavras/excertos de forma ordenada/correta.
                                    </p>
                                </div>
                                <input name="assort_words_question_{{$loop->index}}" id="assort_words_question_{{$loop->index}}" type="text" class="form-control" placeholder="Frase..." hidden>
                            </div>
                            {{-- SOLUTIONS --}}
                            <div class="row mt-1 mb-3 align-items-center">
                                @for ($i = 0; $i < $question_item->options_number; $i++)
                                    @if($i != 0)
                                        <div class="col-12 empty_col"></div>
                                    @endif
                                    <div class="row_to_remove col col-wrap d-flex mb-3">
                                        <?php $option = "options_".($i+1); ?>
                                        <input name="assort_words_solution_{{$i}}_question_{{$loop->index}}" id="assort_words_solution_{{$i}}_question_{{$loop->index}}" 
                                        value="{{ $question_item->$option }}"
                                        type="text" class="form-control" placeholder="Resposta...">
                                        <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                            Remover
                                        </a>
                                    </div>
                                    @if(($i + 1) == $question_item->options_number)
                                        <div class="col-12">
                                            <a href="#" id="add_assort_words_question_{{$loop->index}}_solution_{{ ($i + 1) }}" class="btn search-btn comment_submit button_add_assort_words_solution question_0 solution_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                                                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                                                Adicionar
                                            </a>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        @endforeach
                    @else
                        {{-- QUESTIONS --}}
                        <div class="row_to_remove row">
                            <div class="col col-wrap d-flex m-0 align-items-center">
                                <label class="label_title m-0 sentence_number">
                                    <span>Frase 1</span>
                                </label>
                                <a href="#" id="assort_words_media_button_0" class="btn search-btn comment_submit ml-auto" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                    Associar Media
                                </a>
                                <a href="#" class="btn btn-theme remove_button remove_row remove_entire_question ml-2" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                    Remover
                                </a>
                            </div>
                            <div class="col-12">
                                <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                    *Construa a frase separada em palavras/excertos de forma ordenada/correta.
                                </p>
                            </div>
                            <input name="assort_words_question_0" id="assort_words_question_0" type="text" class="form-control" placeholder="Frase..." hidden>
                        </div>
                        {{-- SOLUTIONS --}}
                        <div class="row mt-1 mb-3 align-items-center">
                            <div class="row_to_remove col col-wrap d-flex mb-3">
                                <input name="assort_words_solution_0_question_0" id="assort_words_solution_0_question_0" type="text" class="form-control" placeholder="Resposta...">
                                <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                    Remover
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="#" id="add_assort_words_question_0_solution_1" class="btn search-btn comment_submit button_add_assort_words_solution question_0 solution_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                                    Adicionar
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                            <a href="#" class="btn search-btn comment_submit m-3 button_add_assort_words" style="font-size: 21px; float: none;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                                Adicionar Alínea
                            </a>
                        </div>
                    </div>

                </form>

            </div>

        </div>

        <div class="tab-pane fade {{ (isset($question->id) && $question->question_subtype_id == 16) ? 'show active' : '' }}" id="assort-assort_images" role="tabpanel" aria-labelledby="assort-assort_images-tab">
            
            <div class="form-group">

                <form id="form-assort-assort_images" class="question-form" action=""  enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row mb-3 align-items-center">
                        <div class="col-12">
                            <label class="label_title m-0 sentence_number">
                                <span>Frases</span>
                            </label>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                                *Insira imagens com descrição de forma ordenada/correta.
                            </p>
                        </div>
                        @if (isset($question->id) && $question->question_subtype_id == 16)
                            @foreach ($question->question_items as $question_item)
                                @if (!$loop->first)
                                    <div class="col-12 mb-3 empty_col"></div>
                                @endif
                                <div class="row_to_remove col col-wrap d-flex mb-3">
                                    <input name="assort_image_input_{{$loop->index}}" id="assort_image_input_{{$loop->index}}" 
                                    value="{{ $question_item->text_1 }}"
                                    type="text" class="form-control" placeholder="Descrição do Media">
                                    <a href="#" id="assort_image_media_button_{{$loop->index}}" class="btn search-btn comment_submit button-wrap" 
                                        style="float: none; padding: 16px 20px; white-space: nowrap; display: {{$question_item->question_item_media ? 'none' : 'block'}};">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                        Associar Media
                                    </a>
                                    @if($question_item->question_item_media)
                                        <input type="text" name="assort_image_media_file_input_{{$loop->index}}" id="assort_image_media_file_input_{{$loop->index}}" hidden
                                            value="from_storage_{{ $question_item->id }}">
                                        @if(explode('/', $question_item->question_item_media->media_type)[0] == 'audio')
                                            <?php $preview_image_src = "/assets/backoffice_assets/icons/Soundclip_Icon.svg"; ?>
                                        @elseif(explode('/', $question_item->question_item_media->media_type)[0] == 'video')
                                            <?php $preview_image_src = "/assets/backoffice_assets/icons/Video_Icon.svg"; ?>
                                        @else
                                            <?php $preview_image_src = '/webapp-macau-storage/questions/'.$question->id.'/question_item/'.$question_item->id.'/'.$question_item->question_item_media->media_url; ?>
                                        @endif
                                        <a href="#" class="btn btn-theme remove_button associate_media_preview button-wrap">
                                            <img src="{{ $preview_image_src }}" 
                                            title="{{ $question_item->question_item_media->media_url }}" class="associate_media_thumbnail_img mr-2">
                                            <span class="associate_media_thumbnail_title">{{ $question_item->question_item_media->media_url }}</span>
                                            <img class="associate_media_thumbnail_remove" src="/assets/backoffice_assets/icons/Cross.svg">
                                        </a>
                                    @endif
                                    <input type="hidden" name="existent_question_item_id_{{ $loop->index }}" value="{{ $question_item->id }}">
                                    <a href="#" class="btn btn-theme remove_button remove_row button-wrap-2" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                        Remover
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="row_to_remove col col-wrap d-flex mb-3">
                                <input name="assort_image_input_0" id="assort_image_input_0" type="text" class="form-control" placeholder="Descrição do Media">
                                <a href="#" id="assort_image_media_button_0" class="btn search-btn comment_submit button-wrap" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                    Associar Media
                                </a>
                                <a href="#" class="btn btn-theme remove_button remove_row button-wrap-2" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                    Remover
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                            <a href="#" class="btn search-btn comment_submit m-3 button_add_assort_assort_images" style="font-size: 21px; float: none;">
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

<div class="add_assort_sentences_clone" hidden>
    <div class="mt-4 mb-3 hr_row"><hr></div>
    @if (isset($question->id) && $question->question_subtype_id == 14)
        @foreach ($question->question_items as $question_item)
            @if ($loop->last)
                {{-- QUESTIONS --}}
                <div class="row_to_remove row">
                    <div class="col col-wrap d-flex m-0 align-items-center">
                        <label class="label_title m-0 sentence_number">
                        <span>Conjunto de Frases {{ $loop->index + 1 }}</span>
                        </label>
                        <a href="#" class="btn btn-theme remove_button remove_row remove_entire_question ml-auto" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                    <div class="col-12">
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *Construa conjuntos de frases de forma ordenada/correta.
                        </p>
                    </div>
                    <input name="assort_sentences_question_{{$loop->index}}" id="assort_sentences_question_{{$loop->index}}" type="text" class="form-control" placeholder="Frase..." hidden>
                </div>
                {{-- SOLUTIONS --}}
                <div class="row mt-1 mb-3 align-items-center">
                    <div class="row_to_remove col col-wrap d-flex mb-3">
                        <input name="assort_sentences_sentence_0_question_{{$loop->index}}" id="assort_sentences_sentence_0_question_{{$loop->index}}" type="text" class="form-control" placeholder="Resposta...">
                        <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="#" id="add_assort_sentences_question_{{$loop->index}}_sentence_1" class="btn search-btn comment_submit button_add_assort_sentences_solution question_0 solution_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        {{-- QUESTIONS --}}
        <div class="row_to_remove row">
            <div class="col col-wrap d-flex m-0 align-items-center">
                <label class="label_title m-0 sentence_number">
                    <span>Conjunto de Frases 1</span>
                </label>
                <a href="#" class="btn btn-theme remove_button remove_row remove_entire_question ml-auto" style="float: none; padding: 16px 20px; white-space: nowrap;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                    Remover
                </a>
            </div>
            <div class="col-12">
                <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                    *Construa conjuntos de frases de forma ordenada/correta.
                </p>
            </div>
            <input name="assort_sentences_question_0" id="assort_sentences_question_0" type="text" class="form-control" placeholder="Frase..." hidden>
        </div>
        {{-- SOLUTIONS --}}
        <div class="row mt-1 mb-3 align-items-center">
            <div class="row_to_remove col col-wrap d-flex mb-3">
                <input name="assort_sentences_sentence_0_question_0" id="assort_sentences_sentence_0_question_0" type="text" class="form-control" placeholder="Resposta...">
                <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                    Remover
                </a>
            </div>
            <div class="col-12">
                <a href="#" id="add_assort_sentences_question_0_sentence_1" class="btn search-btn comment_submit button_add_assort_sentences_solution question_0 solution_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                    Adicionar
                </a>
            </div>
        </div>
    @endif
</div>

<div class="add_assort_sentences_sentence_clone" hidden>
    <div class="col-12 empty_col"></div>
    @if (isset($question->id) && $question->question_subtype_id == 14)
        @foreach ($question->question_items as $question_item)
            @if ($loop->last)
                @for ($i = 0; $i < $question_item->options_number; $i++)
                    @if(($i + 1) == $question_item->options_number)
                        <?php $option = "options_".($i+1); ?>
                        <div class="row_to_remove col col-wrap d-flex mb-3">
                            <input name="assort_sentences_sentence_{{$i}}_question_{{$loop->index}}" id="assort_sentences_sentence_{{$i}}_question_{{$loop->index}}" type="text" class="form-control" placeholder="Resposta...">
                            <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                Remover
                            </a>
                        </div>
                    @endif
                @endfor
            @endif
        @endforeach
    @else
        <div class="row_to_remove col col-wrap d-flex mb-3">
            <input name="assort_sentences_sentence_0_question_0" id="assort_sentences_sentence_0_question_0" type="text" class="form-control" placeholder="Resposta...">
            <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
    @endif
</div>

<div class="add_assort_words_clone" hidden>
    <div class="mt-4 mb-3 hr_row"><hr></div>
    @if (isset($question->id) && $question->question_subtype_id == 15)
        @foreach ($question->question_items as $question_item)
            @if ($loop->last)
                {{-- QUESTIONS --}}
                <div class="row_to_remove row">
                    <div class="col col-wrap d-flex m-0 align-items-center">
                        <label class="label_title m-0 sentence_number">
                            <span>Frase 1</span>
                        </label>
                        {{-- AQUI --}}
                        <a href="#" id="assort_words_media_button_{{$loop->index}}" class="btn search-btn comment_submit ml-auto" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Associar Media
                        </a>
                        <a href="#" class="btn btn-theme remove_button remove_row remove_entire_question ml-2" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                    <div class="col-12">
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *Construa a frase separada em palavras/excertos de forma ordenada/correta.
                        </p>
                    </div>
                    <input name="assort_words_question_{{$loop->index}}" id="assort_words_question_{{$loop->index}}" type="text" class="form-control" placeholder="Frase..." hidden>
                </div>
                {{-- SOLUTIONS --}}
                <div class="row mt-1 mb-3 align-items-center">
                    <div class="row_to_remove col col-wrap d-flex mb-3">
                        <input name="assort_words_solution_0_question_{{$loop->index}}" id="assort_words_solution_0_question_{{$loop->index}}" type="text" class="form-control" placeholder="Resposta...">
                        <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="#" id="add_assort_words_question_{{$loop->index}}_solution_1" class="btn search-btn comment_submit button_add_assort_words_solution question_{{$loop->index}} solution_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                            Adicionar
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        {{-- QUESTIONS --}}
        <div class="row_to_remove row">
            <div class="col col-wrap d-flex m-0 align-items-center">
                <label class="label_title m-0 sentence_number">
                    <span>Frase 1</span>
                </label>
                {{-- AQUI --}}
                <a href="#" id="assort_words_media_button_0" class="btn search-btn comment_submit ml-auto" style="float: none; padding: 16px 20px; white-space: nowrap;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                    Associar Media
                </a>
                <a href="#" class="btn btn-theme remove_button remove_row remove_entire_question ml-2" style="float: none; padding: 16px 20px; white-space: nowrap;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                    Remover
                </a>
            </div>
            <div class="col-12">
                <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                    *Construa a frase separada em palavras/excertos de forma ordenada/correta.
                </p>
            </div>
            <input name="assort_words_question_0" id="assort_words_question_0" type="text" class="form-control" placeholder="Frase..." hidden>
        </div>
        {{-- SOLUTIONS --}}
        <div class="row mt-1 mb-3 align-items-center">
            <div class="row_to_remove col col-wrap d-flex mb-3">
                <input name="assort_words_solution_0_question_0" id="assort_words_solution_0_question_0" type="text" class="form-control" placeholder="Resposta...">
                <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                    Remover
                </a>
            </div>
            <div class="col-12">
                <a href="#" id="add_assort_words_question_0_solution_1" class="btn search-btn comment_submit button_add_assort_words_solution question_0 solution_0" style="padding: 12px 14px; float: right; white-space: nowrap;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                    Adicionar
                </a>
            </div>
        </div>
    @endif
</div>

<div class="add_assort_words_solution_clone" hidden>
    <div class="col-12 empty_col"></div>
    @if (isset($question->id) && $question->question_subtype_id == 15)
        @foreach ($question->question_items as $question_item)
            @if ($loop->last)
                @for ($i = 0; $i < $question_item->options_number; $i++)
                    @if(($i + 1) == $question_item->options_number)
                        <?php $option = "options_".($i+1); ?>
                        <div class="row_to_remove col col-wrap d-flex mb-3">
                        <input name="assort_words_solution_{{$i}}_question_{{$loop->index}}" id="assort_words_solution_{{$i}}_question_{{$loop->index}}" type="text" class="form-control" placeholder="Resposta...">
                            <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                Remover
                            </a>
                        </div>
                    @endif
                @endfor
            @endif
        @endforeach
    @else
        <div class="row_to_remove col col-wrap d-flex mb-3">
            <input name="assort_words_solution_0_question_0" id="assort_words_solution_0_question_0" type="text" class="form-control" placeholder="Resposta...">
            <a href="#" class="btn btn-theme button-wrap remove_button remove_row" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
    @endif
</div>


<div class="add_assort_assort_images_clone" hidden>
    <div class="col-12 mb-3 empty_col"></div>
    @if (isset($question->id) && $question->question_subtype_id == 16)
        @foreach ($question->question_items as $question_item)
            @if($loop->last)
                <div class="row_to_remove col col-wrap d-flex mb-3">
                    <input name="assort_image_input_{{$loop->index}}" id="assort_image_input_{{$loop->index}}" type="text" class="form-control" placeholder="Descrição do Media">
                    <a href="#" id="assort_image_media_button_{{$loop->index}}" class="btn search-btn comment_submit button-wrap" style="float: none; padding: 16px 20px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Associar Media
                    </a>
                    <a href="#" class="btn btn-theme remove_button remove_row button-wrap-2" style="float: none; padding: 16px 20px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Remover
                    </a>
                </div>
            @endif
        @endforeach
    @else
        <div class="row_to_remove col col-wrap d-flex mb-3">
            <input name="assort_image_input_0" id="assort_image_input_0" type="text" class="form-control" placeholder="Descrição do Media">
            <a href="#" id="assort_image_media_button_0" class="btn search-btn comment_submit button-wrap" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Associar Media
            </a>
            <a href="#" class="btn btn-theme remove_button remove_row button-wrap-2" style="float: none; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
    @endif
</div>