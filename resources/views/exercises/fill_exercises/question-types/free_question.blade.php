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

    @foreach ($question->question_items as $item)
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group" style="text-align: -webkit-center;">
                <label class="label_title mt-1 mb-1 d-block" style="font-size:30px;">
                    Questão {{ $loop->index + 1 }}
                </label>
                <label class="label_title mt-3 mb-1 d-block">
                    {{ $item->text_1 }}
                </label>

                <div class="mt-3">

                    <textarea class="form-control" name="{{$question->id}}_free_question[{{$item->id}}]" id="" cols="30" rows="5"></textarea>

                </div>
            </div>
        </div>

    @endforeach
</div>

@if ($exame_review && $exame_correction)

    <hr class="mt-4 mb-4">

    <div class="row mb-4">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <label class="label_title d-block" style="font-size: 30px;">
                Correção </label>

                <p class="exercise_author d-block">
                    <strong>Pontuação desta questão:</strong> 
                    <input type="number" class="form-control d-inline-block ml-2 mr-2" style="width: 75px;" name="free_question_correction_scores[{{$question->id}}]" id="free_question_correction_scores_{{$question->id}}" min="0" max="{{ $question->avaliation_score }}"> 
                    (escolha uma pontuação de <strong>0</strong> a <strong>{{ $question->avaliation_score }}</strong> pontos).
                </p>

            </div>
        </div>

    </div>
    
@endif