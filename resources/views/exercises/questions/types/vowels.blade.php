<div class="form-group to_choose vowels">
    <label class="label_title mb-3" style="font-size: 30px;">
        Palavras <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
    <div class="row">
        <div class="col-12 mb-2">
            <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                *Escolha as possíveis vogais a serem apresentadas para cada palavra.
            </p>
        </div>
        <div class="col-12 mb-2">
            <select name="possible_vowels" id="possible_vowels" class="form-control" aria-placeholder="Possíveis Vogais" multiple>
                <option value="1">/a/</option>
                <option value="2">/ɐ/</option>
                <option value="3">/e/</option>
                <option value="4">/ǝ/</option>
                <option value="5">/i/</option>
                <option value="6">/ᴉ/</option>
            </select>
        </div>
    </div>
    {{-- Categories ROW --}}
    <div class="row_to_remove pl-3 row mb-0 align-items-center questions_row">
        <div class="col-12">
            <label class="label_title question_number">
                <span>Palavra 1</span>
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

    <div class="row mb-3">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <a href="#" class="btn search-btn comment_submit m-3 button_add_vowels" style="font-size: 21px; float: none;">
                <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                Adicionar Alínea
            </a>
        </div>
    </div>
</div>

{{-- CLONES --}}

<div class="add_vowels_clone" hidden>
    <div>
        <div class="col-12 hr_row"><hr></div>
        {{-- Categories ROW --}}
        <div class="row_to_remove pl-3 row mb-0 align-items-center questions_row">
            <div class="col-12">
                <label class="label_title question_number">
                    <span>Palavra 1</span>
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
    </div>
</div>