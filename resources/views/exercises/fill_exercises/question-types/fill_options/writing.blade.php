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

<?php 

    function getInbetweenStrings2($str){
        $matches = array();
        $regex = "/<%\s*([\s*A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_]*[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_])\s*%>/";
        preg_match_all($regex, $str, $matches);
        return $matches[1];
    }

    function getStringInArray2($string){
        $matches = array();
        $regex = "/<%\s*([\s*A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_]*[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_])\s*%>/";
        $string_array = preg_split($regex, $string);
        return $string_array;
    }

?>

@foreach ($question->question_items as $item)

    @foreach (getInbetweenStrings2($item->text_1) as $word)
        <?php $all_possible_shuffled_options[] = $word; ?>
    @endforeach
    @foreach (explode('|', $item->options_answered) as $answer)
        <?php $all_shuffled_options_answered[] = $answer; ?>
    @endforeach
@endforeach

{{-- Frases --}}
<div class="row mb-4">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group mb-0">
            <label class="label_title d-block mb-1" style="font-size: 30px;">
            Frases </label>
        </div>
    </div>

    @foreach ($question->question_items as $item)
        
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group mb-0">
                @if($item->question_item_media)
                    <audio controls controlslist="nodownload" class="d-block ml-auto mr-auto mt-2 mb-3 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 250px; max-height: 100px;">
                        <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                    </audio>
                    {{-- <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" 
                        alt="" class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;"> --}}
                @endif

                @if($exame_review)
                    <label class="label_title m-0 d-block align-self-center">
                        -&nbsp;

                        <?php $asd = explode('|', $item->options_answered); ?>

                        @for ($i = 0; $i < sizeof(getStringInArray2($item->text_1)); $i++)
                            {{ getStringInArray2($item->text_1)[$i] }}

                            @if($i < (sizeof(getStringInArray2($item->text_1)) - 1))

                                @if(isset(explode('|', $item->options_answered)[$i]))
                                    <input type="text" name="" id="" value="{{ explode('|', $item->options_answered)[$i] }}" disabled class="form-control d-inline-flex mt-1 mb-1" style="width: auto; vertical-align: middle;">
                                @endif

                                @if(getInbetweenStrings2($item->text_1)[$i] == explode('|', $item->options_answered)[$i])
                                    <input id="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom correct_answer_checkbox_input" name="" type="checkbox" checked disabled>
                                    <label for="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label correct_answer_checkbox_label d-inline-block"></label>
                                @else
                                    <input id="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom wrong_answer_checkbox_input" name="" type="checkbox" checked disabled>
                                    <label for="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label wrong_answer_checkbox_label d-inline-block"></label>
                                @endif
                            @endif

                        @endfor

                    </label>
                @else
                    <label class="label_title m-0 d-block align-self-center">
                        -&nbsp;
                        @foreach (getStringInArray2($item->text_1) as $sub_string)

                            {{ $sub_string }}

                            @if(!$loop->last)
                                {{-- <input type="hidden" name="{{$question->id}}_fill_options_shuffle[{{ $item->id }}][]" class="fill_options_d_and_d" data-item-id="">
                                <div class="drag_and_drop_hole fill_hole word_hole drop m-2">

                                </div> --}}
                                <input type="text" name="{{$question->id}}_fill_options_writing[{{ $item->id }}][]" id="" 
                                class="form-control d-inline-flex mt-1 mb-1" style="width: auto; vertical-align: middle;">
                            @endif

                        @endforeach

                    </label>
                @endif
            </div>
        </div>

        @if (!$loop->last)
            <div class="col-sm-12 col-md-12 col-lg-12">
                <hr>
            </div>
        @endif
        
    @endforeach

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
        
        @foreach ($question->question_items as $item)
        
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group mb-0">
                    @if($item->question_item_media)
                        <audio controls controlslist="nodownload" class="d-block ml-auto mr-auto mt-2 mb-3 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 250px; max-height: 100px;">
                            <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                        </audio>
                        {{-- <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" 
                            alt="" class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;"> --}}
                    @endif

                    <label class="label_title m-0 d-block align-self-center">
                        -&nbsp;
                        @for ($i = 0; $i < sizeof(getStringInArray2($item->text_1)); $i++)
                            {{ getStringInArray2($item->text_1)[$i] }}

                            @if($i < (sizeof(getStringInArray2($item->text_1)) - 1))
                                {{-- <div class="drag_and_drop_hole fill_hole word_hole drop m-2"> --}}
                                    {{-- <div class="drag_and_drop_item word_item p-2 fill_options_shuffle_items" > --}}
                                        {{-- {{ getInbetweenStrings2($item->text_1)[$i] }} --}}
                                        <input type="text" name="" id="" value="{{ getInbetweenStrings2($item->text_1)[$i] }}" disabled 
                                        class="form-control d-inline-flex mt-1 mb-1" style="width: auto; vertical-align: middle;">
                                    {{-- </div> --}}
                                {{-- </div> --}}
                            @endif

                        @endfor

                    </label>
                </div>
            </div>

            @if (!$loop->last)
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <hr>
                </div>
            @endif
            
        @endforeach

    </div>
    
@endif