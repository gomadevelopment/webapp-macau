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

<div class="row mb-4">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group" style="text-align: -webkit-center;">
            <label class="label_title mt-1 mb-1 d-block" style="font-size:30px;">
                Afirmações
            </label>
        </div>
    </div>
    
    @foreach ($question->question_items as $item)
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group d-flex" style="text-align: -webkit-center;">

                <div class="w-100">

                    <textarea class="form-control" name="{{$question->id}}_statement_correction[{{$item->id}}]" id="" cols="30" rows="5" {{ $exame_review ? 'readonly' : '' }}>{{ $exame_review ? $item->options_answered : $item->text_1 }}</textarea>

                </div>

                @if($exame_review)
                    @if($item->text_2 == $item->options_answered)
                        <input id="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom correct_answer_checkbox_input" name="" type="checkbox" checked disabled>
                        <label for="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label correct_answer_checkbox_label d-inline-block align-self-center"></label>
                    @else
                        <input id="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom wrong_answer_checkbox_input" name="" type="checkbox" checked disabled>
                        <label for="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label wrong_answer_checkbox_label d-inline-block align-self-center"></label>
                    @endif
                @endif

            </div>
        </div>

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
                <div class="form-group d-flex" style="text-align: -webkit-center;">

                    <div class="w-100">

                        <textarea class="form-control" name="" id="" cols="30" rows="5" readonly>{{ $item->text_2 }}</textarea>

                    </div>

                </div>
            </div>

        @endforeach

    </div>
    
@endif