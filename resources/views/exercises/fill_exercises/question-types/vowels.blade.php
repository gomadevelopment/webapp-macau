@if($exame_review)
    <?php
        $quotation_class = '';
        if($question->avaliation_score != 0){
            if((int)$question->classification == $question->avaliation_score){
                $quotation_class = 'high_quotation_score';
            }
            else if((int)$question->classification > ($question->avaliation_score / 2)){
                $quotation_class = 'med_quotation_score';
            }
            else{
                $quotation_class = 'low_quotation_score';
            }
        }
        else{
            $quotation_class = 'low_quotation_score';
        }
    ?>

    <div class="d-flex float-left flex-column mb-3 w-100">
        <p class="exercise_author quotation_label">
        <strong>Cotação:</strong> 
        Obteve 
        <strong class="{{ $quotation_class }}">{{ (int)$question->classification }}</strong> 
        de 
        <strong class="{{ $quotation_class == 'high_quotation_score' ? 'high_quotation_score' : 'total_quotation_score' }}">{{ $question->avaliation_score }}</strong> 
        pontos nesta questão.
        </p>
    </div>
@endif

{{-- Frases --}}
<div class="row mb-4">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <label class="label_title d-block mb-1" style="font-size: 30px;">
            Palavras </label>
        </div>
    </div>

    {{-- UNIQUE VOWELS --}}
    <?php $unique_vowels = getUniqueVowels($question->question_items); ?>

    {{-- SOLUTION VOWELS --}}
    <?php
        if($exame_review){
            $vowels_solutions = [];
            foreach ($unique_vowels as $vowel) {
                foreach ($question->question_items as $item) {
                    for ($i=0; $i < $item->options_number ; $i++) { 
                        $option = 'options_'.($i+1);
                        if($vowel == $item->$option){
                            $vowels_solutions[$vowel][] = getVowelsUnderlined($item->text_1, $i);
                        }
                    }
                }
            }
        }
    ?>
    {{-- ANSWERED VOWELS --}}
    <?php
        if($exame_review){
            $answered_vowels = [];
            foreach($vowels_solutions as $key => $value){
                $answered_vowels[$key] = [];
            }
            foreach ($unique_vowels as $vowel) {
                foreach ($question->question_items as $item) {
                    $options_answered = explode('|', $item->options_answered);
                    for ($i=0; $i < sizeof($options_answered) ; $i++) { 
                        $option = 'options_'.($i+1);
                        if($options_answered[$i] == $vowel){
                            $answered_vowels[$vowel][] = getVowelsUnderlined($item->text_1, $i);
                        }
                    }
                }
            }
            foreach ($unique_vowels as $vowel) {
                if(sizeof($answered_vowels[$vowel]) < sizeof($vowels_solutions[$vowel])){
                    $sizeof_diff = sizeof($vowels_solutions[$vowel]) - sizeof($answered_vowels[$vowel]);
                    for($i = 0; $i < $sizeof_diff; $i++){
                        $answered_vowels[$vowel][] = null;
                    }
                }
            }
        }
        // dd($answered_vowels, $vowels_solutions);
    ?>
    
    {{-- Tr<%a%>b<%a%>lh<%a%>r --}}
    @foreach ($question->question_items as $item)

        <div class="col-sm-12 col-md-3 col-lg-3">
            <div class="row">
                @if($item->question_item_media)
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            @if(explode('/', $item->question_item_media->media_type)[0] == 'audio')
                                <audio id="player_{{$item->id}}" controls controlslist="nodownload" style="width: -webkit-fill-available;">
                                    <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                                </audio>
                                {{-- <div>
                                    <button onclick="document.getElementById('player_{{$item->id}}').play()">Play</button>
                                    <button onclick="document.getElementById('player_{{$item->id}}').pause()">Pause</button>
                                    <button onclick="document.getElementById('player_{{$item->id}}').muted=!document.getElementById('player').muted">Mute/ Unmute</button>
                                </div> --}}
                            @endif
                        </div>
                    </div>
                @else
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                        </div>
                    </div>
                @endif
                @for ($i = 0; $i < skipFun($item->text_1); $i++)

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <div class="drag_and_drop_hole origin_hole drop">
                                {{-- {!! getVowelsUnderlined($item->text_1) !!} --}}
                                @if($exame_review)
                                    <?php
                                        $merged_answered_vowels = array();
                                        foreach ($answered_vowels as $answered_vowels_sub_arrays){
                                            $merged_answered_vowels = array_merge($merged_answered_vowels, $answered_vowels_sub_arrays);
                                        }
                                    ?>
                                    @if(!in_array(getVowelsUnderlined($item->text_1, $i), $merged_answered_vowels))
                                        <div class="drag_and_drop_item p-2 vowels_items">
                                            {!! getVowelsUnderlined($item->text_1, $i) !!}
                                        </div>
                                    @endif
                                @else
                                    <div class="drag_and_drop_item p-2 vowels_items">
                                        {!! getVowelsUnderlined($item->text_1, $i) !!}
                                        <input type="hidden" name="" value="{{ $item->id . ',' . $i }}">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                @endfor
            </div>
        </div>

    @endforeach

</div>

{{-- Campos --}}
<div class="row">

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group mb-0">
            <label class="label_title d-block mb-1" style="font-size: 30px;">
            Vogais </label>
        </div>
    </div>

    @if($exame_review)
        
        @foreach ($unique_vowels as $vowel)

            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group mb-0 mt-3 d-flex align-items-center">
                    <label class="label_title mb-0 d-block" style="font-family: sans-serif !important;">
                        {{ $vowel }} </label>
                    @if(file_exists(public_path('/assets/backoffice_assets/audios/' . $vowel . '.m4a')))
                        <audio id="{{$vowel}}" controlslist="nodownload">
                            <source src="{{ '/assets/backoffice_assets/audios/' . $vowel . '.m4a' }}" type="">
                        </audio>
                        <div> 
                            <button type="button" class="btn search-btn comment_submit m-2" 
                                onclick="document.getElementById('{{$vowel}}').play()" 
                                style="padding: 4px 16px 4px 5px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Play_circle.svg')}}" alt="" style="width: 150%;">
                            </button> 
                        </div>
                    @endif
                </div>
            </div>

            @foreach($answered_vowels[$vowel] as $answered_vowel)

                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="form-group d-flex align-items-center">
                        <div class="drag_and_drop_hole drop mt-3">
                            @if($answered_vowel != null)
                                <div class="drag_and_drop_item p-2 vowels_items">
                                    {!! $answered_vowel !!}
                                </div>
                            @endif
                        </div>
                        @if(in_array($answered_vowel, $vowels_solutions[$vowel]))
                            <input id="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom correct_answer_checkbox_input" name="" type="checkbox" checked disabled>
                            <label for="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label correct_answer_checkbox_label d-inline-block mt-3"></label>
                        @else
                            <input id="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom wrong_answer_checkbox_input" name="" type="checkbox" checked disabled>
                            <label for="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label wrong_answer_checkbox_label d-inline-block mt-3"></label>
                        @endif
                    </div>
                </div>

            @endforeach

        @endforeach
    @else
        @foreach ($unique_vowels as $vowel)

            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group mb-0 mt-3 d-flex align-items-center">
                    <label class="label_title mb-0 mt-0 mr-2 d-block" style="font-family: sans-serif !important;">
                        {{ $vowel }} </label>
                    @if(file_exists(public_path('/assets/backoffice_assets/audios/' . $vowel . '.m4a')))
                        <audio id="{{$vowel}}" controlslist="nodownload">
                            <source src="{{ '/assets/backoffice_assets/audios/' . $vowel . '.m4a' }}" type="">
                        </audio>
                        <div> 
                            <button type="button" class="btn search-btn comment_submit m-2" 
                                onclick="document.getElementById('{{$vowel}}').play()" 
                                style="padding: 4px 16px 4px 5px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Play_circle.svg')}}" alt="" style="width: 150%;">
                            </button> 
                        </div>
                    @endif
                    {{-- <audio id="" controls controlslist="nodownload">
                        <source src="{{ '/assets/backoffice_assets/audios/' . $vowel . '.m4a' }}" type="">
                    </audio> --}}
                </div>
            </div>

            @for ($i = 0; $i < getNumberOfVowels($question->question_items, $vowel); $i++)

                <input type="hidden" name="{{$question->id}}_vowels[{{ $vowel }}][]" class="vowels_d_and_d" data-item-id="">

                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="form-group">
                        <div class="drag_and_drop_hole drop mt-3">

                        </div>
                    </div>
                </div>

            @endfor

        @endforeach
    @endif

</div>

{{-- SOLUTIONS --}}

@if ($exame_review && ($question->classification != $question->avaliation_score))

    <hr class="mt-4 mb-4">

    <div class="row mb-4">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <label class="label_title d-block" style="font-size: 30px;">
                Soluções </label>
            </div>
        </div>

        @foreach ($unique_vowels as $vowel)

            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group mb-0 mt-3 d-flex align-items-center">
                    <label class="label_title mb-0 mt-0 mr-3 d-block d-flex align-items-center" style="font-family: sans-serif !important;">
                        {{ $vowel }} </label>
                    @if(file_exists(public_path('/assets/backoffice_assets/audios/' . $vowel . '.m4a')))
                        <audio id="{{$vowel}}" controlslist="nodownload">
                            <source src="{{ '/assets/backoffice_assets/audios/' . $vowel . '.m4a' }}" type="">
                        </audio>
                        <div> 
                            <button type="button" class="btn search-btn comment_submit m-2" 
                                onclick="document.getElementById('{{$vowel}}').play()" 
                                style="padding: 4px 16px 4px 5px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Play_circle.svg')}}" alt="" style="width: 150%;">
                            </button> 
                        </div>
                    @endif
                </div>
            </div>

            @foreach($vowels_solutions[$vowel] as $solution_vowel)

                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="form-group">
                        <div class="drag_and_drop_hole drop mt-3">
                            <div class="drag_and_drop_item p-2 vowels_items">
                                {!! $solution_vowel !!}
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        @endforeach

    </div>
    
@endif