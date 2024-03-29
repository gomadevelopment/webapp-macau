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
                    Conjunto de Frases {{ $loop->index + 1 }}
                </label>

                @for ($i = 0; $i < $item->options_number; $i++)
                    <?php $option = "options_".($i+1); ?>
                    <?php $shuffled_array[] = $item->$option; ?>
                @endfor

                <?php shuffle($shuffled_array); ?>


                <ul id="assortment_sentences_table_question_item_{{ $item->id }}" class="assortment_tables" cellspacing="0" cellpadding="2">

                    @if(!$exame_review)
                        @foreach ($shuffled_array as $shuffled_option)

                            <li>
                                <img src="{{asset('/assets/backoffice_assets/icons/Drag_black.svg', config()->get('app.https'))}}?v=2.4" alt="" class="mr-3">
                                <span>
                                    {{ $shuffled_option }}
                                </span>
                                <input type="hidden" name="{{$question->id}}_assortment_sentences[{{ $item->id }}][]" value="{{$shuffled_option}}" class="assortment_d_and_d" data-item-id="">
                            </li>

                        @endforeach

                        <?php $shuffled_array = []; ?>
                    @else
                        @foreach (explode('|', $item->options_answered) as $answer)
                            <?php $option = 'options_'.($loop->index+1); ?>
                            <li>
                                <img src="{{asset('/assets/backoffice_assets/icons/Drag_black.svg', config()->get('app.https'))}}?v=2.4" alt="" class="mr-3">
                                <span>
                                    {{ $answer }}
                                </span>
                                @if($answer == $item->$option)
                                    <input id="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom correct_answer_checkbox_input" name="" type="checkbox" checked disabled>
                                    <label for="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label correct_answer_checkbox_label d-inline-block align-self-center"></label>
                                @else
                                    <input id="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom wrong_answer_checkbox_input" name="" type="checkbox" checked disabled>
                                    <label for="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label wrong_answer_checkbox_label d-inline-block align-self-center"></label>
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>

            </div>
        </div>

    @endforeach

</div>

{{-- SOLUTIONS --}}

@if (($exame_review && ($question->classification != $question->avaliation_score)) || ($exame_review && $question->classification == 0 && $question->avaliation_score == 0))

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
                <div class="form-group" style="text-align: -webkit-center;">
                    <label class="label_title mt-3 mb-1 d-block" style="font-size:30px;">
                        Conjunto de Frases {{ $loop->index + 1 }}
                    </label>

                    <ul id="exame_review_assortment_sentences_table_question_item_{{ $item->id }}" class="assortment_tables" cellspacing="0" cellpadding="2">

                        @for ($i = 0; $i < $item->options_number; $i++)
                            <?php $option = 'options_'.($i+1); ?>
                            <li style="cursor: default;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Drag_black.svg', config()->get('app.https'))}}?v=2.4" alt="" class="mr-3">
                                <span>
                                    {{ $item->$option }}
                                </span>
                            </li>

                        @endfor

                    </ul>

                </div>
            </div>

        @endforeach

    </div>
    
@endif
