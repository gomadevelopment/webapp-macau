<div class="form-group to_choose vowels">

    <form id="form-vowels" class="question-form" action=""  enctype="multipart/form-data">
        @csrf

        <label class="label_title mb-3" style="font-size: 30px;">
            Palavras <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
        <div class="row">
            <div class="col-12 mb-2">
                <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                    *Escolha as possíveis vogais a serem apresentadas para cada palavra.
                </p>
            </div>
            <div class="col-12 mb-2 possible_words_change_font select2_with_search">
                <?php $possible_vowels_default = isset($question->id) && $question->question_subtype_id == 17 
                                                    ? explode('|', $question->question_items->first()->text_2)
                                                    : []; ?>
                <?php $default_vowels = ['/a/', '/ɐ/', '/e/', '/ǝ/', '/i/', '/ᴉ/']; ?>
                <select name="possible_vowels[]" id="possible_vowels" class="form-control" aria-placeholder="Possíveis Vogais" multiple>
                    <option value="/a/" {{ in_array('/a/', $possible_vowels_default) ? 'selected' : '' }}>/a/</option>
                    <option value="/ɐ/" {{ in_array('/ɐ/', $possible_vowels_default) ? 'selected' : '' }}>/ɐ/</option>
                    <option value="/e/" {{ in_array('/e/', $possible_vowels_default) ? 'selected' : '' }}>/e/</option>
                    <option value="/ǝ/" {{ in_array('/ǝ/', $possible_vowels_default) ? 'selected' : '' }}>/ǝ/</option>
                    <option value="/i/" {{ in_array('/i/', $possible_vowels_default) ? 'selected' : '' }}>/i/</option>
                    <option value="/ᴉ/" {{ in_array('/ᴉ/', $possible_vowels_default) ? 'selected' : '' }}>/ᴉ/</option>
                    @foreach ($possible_vowels_default as $non_default_vowel)
                        @if(!in_array($non_default_vowel, $default_vowels))
                            <option value="{{$non_default_vowel}}" {{ in_array($non_default_vowel, $possible_vowels_default) ? 'selected' : '' }}>
                                {{$non_default_vowel}}
                            </option>
                        @endif                   
                    @endforeach
                </select>
            </div>
        </div>
        {{-- Categories ROW --}}
        @if (isset($question->id) && $question->question_subtype_id == 17)
            @foreach ($question->question_items as $question_item)
                @if (!$loop->first)
                    <div class="col-12 hr_row"><hr></div>
                @endif
                <div>
                    <div class="row_to_remove pl-3 row mb-0 align-items-center questions_row">
                        <div class="col-12">
                            <label class="label_title question_number">
                                <span>Palavra {{ $loop->index + 1 }}</span>
                                <a href="#" id="vow_word_perc_delimiter_{{$loop->index}}" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                                    <% %>
                                </a>
                            </label>
                        </div>
                        <div class="col col-wrap d-flex mb-3">
                            <input name="vowels_word_{{$loop->index}}" id="vowels_word_{{$loop->index}}" 
                            value="{{ $question_item->text_1 }}"
                            type="text" class="form-control" placeholder="Palavra...">
                            <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                Remover
                            </a>
                        </div>
                    </div>
                    {{-- Answers ROW --}}
                    <div class="row mb-3 pl-3 align-items-center" id="selects_row_word_{{$loop->index}}">
                        @for ($i = 0; $i < $question_item->options_number; $i++)
                            <?php $option = "options_".($i+1); ?>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 mb-1 d-flex">
                                <p class="exercise_level align-self-center m-0">{{$i+1}}ª&nbsp;&nbsp;</p>
                                <select name="select_word_{{$loop->index}}_vowel_{{$i}}" id="select_word_{{$loop->index}}_vowel_{{$i}}" class="form-control select_vowels_class">
                                    @foreach (explode('|', $question_item->text_2) as $select_option)
                                        <option value="{{$select_option}}" {{ $select_option == $question_item->$option ? 'selected' : '' }}>
                                            {{$select_option}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endfor
                    </div>
                </div>
            @endforeach
        @else
            <div class="row_to_remove pl-3 row mb-0 align-items-center questions_row">
                <div class="col-12">
                    <label class="label_title question_number">
                        <span>Palavra 1</span>
                        <a href="#" id="vow_word_perc_delimiter_0" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                            <% %>
                        </a>
                    </label>
                </div>
                <div class="col col-wrap d-flex mb-3">
                    <input name="vowels_word_0" id="vowels_word_0" type="text" class="form-control" placeholder="Palavra...">
                    <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Remover
                    </a>
                </div>
            </div>
            {{-- Answers ROW --}}
            <div class="row mb-3 pl-3 align-items-center" id="selects_row_word_0">
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <a href="#" class="btn search-btn comment_submit m-3 button_add_vowels" style="font-size: 21px; float: none;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                    Adicionar Alínea
                </a>
            </div>
        </div>

    </form>

</div>

{{-- CLONES --}}

<div class="add_vowels_clone" hidden>
    <div>
        <div class="col-12 hr_row"><hr></div>
        @if (isset($question->id) && $question->question_subtype_id == 17)
            @foreach ($question->question_items as $question_item)
                @if($loop->last)
                    {{-- Categories ROW --}}
                    <div class="row_to_remove pl-3 row mb-0 align-items-center questions_row">
                        <div class="col-12">
                            <label class="label_title question_number">
                                <span>Palavra {{ $loop->index + 1 }}</span>
                                <a href="#" id="vow_word_perc_delimiter_{{$loop->index}}" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                                    <% %>
                                </a>
                            </label>
                        </div>
                        <div class="col col-wrap d-flex mb-3">
                            <input name="vowels_word_{{$loop->index}}" id="vowels_word_{{$loop->index}}" type="text" class="form-control" placeholder="Palavra...">
                            <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                Remover
                            </a>
                        </div>
                    </div>
                    {{-- Answers ROW --}}
                    <div class="row mb-3 pl-3 align-items-center" id="selects_row_word_{{$loop->index}}">
                    </div>
                @endif
            @endforeach
        @else
            {{-- Categories ROW --}}
            <div class="row_to_remove pl-3 row mb-0 align-items-center questions_row">
                <div class="col-12">
                    <label class="label_title question_number">
                        <span>Palavra 1</span>
                        <a href="#" id="vow_word_perc_delimiter_0" class="btn search-btn ml-1 comment_submit" style="float: none;padding: 8px 10px; white-space: nowrap;">
                            <% %>
                        </a>
                    </label>
                </div>
                <div class="col col-wrap d-flex mb-3">
                    <input name="vowels_word_0" id="vowels_word_0" type="text" class="form-control" placeholder="Palavra...">
                    <a href="#" class="btn btn-theme button-wrap remove_button remove_row remove_entire_question" style="float: none; padding: 16px 20px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Remover
                    </a>
                </div>
            </div>
            {{-- Answers ROW --}}
            <div class="row mb-3 pl-3 align-items-center" id="selects_row_word_0">
            </div>
        @endif
        
    </div>
</div>