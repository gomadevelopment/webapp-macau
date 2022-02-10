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
                Descubra as Palavras Incorretas
            </label>
        </div>
    </div>
    
    @foreach ($question->question_items as $item)
        <input type="text" class="word_input" name="{{$question->id}}_differences_find_words[{{$item->id}}][]" id=""hidden>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group d-flex flex-wrap mb-0" style="text-align: -webkit-center;">

                 @if($item->question_item_media)
                    @if(explode('/', $item->question_item_media->media_type)[0] == 'audio')
                        <audio controls class="" style="max-width: 300px;">
                            <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                        </audio>
                    @endif
                @endif

                <div class="w-100 exercise_question_description question_info_text_type d-flex flex-wrap mt-2" style="border: 1px solid #ececec; border-radius: 5px; padding: 10px;">

                    @foreach (splitSentenceIntoWords($item->text_2) as $word)
                        @if($word == '' || $word == ' ')
                            &nbsp;
                        @else
                            @if($exame_review)
                                <button type="button" class="btn word_button inactive {{ correctOrWrong($word, $item) }}">
                                    {{$word}}
                                </button>
                            @else
                                <button type="button" class="btn word_button">
                                    {{$word}}
                                </button>
                                <input type="text" class="word_input" name="{{$question->id}}_differences_find_words[{{$item->id}}][]" id="" value="{{$word}}" hidden disabled>
                            @endif
                            
                        @endif
                    @endforeach

                </div>
            </div>
        </div>

        @if(!$loop->last)
            <div class="col-sm-12 col-md-12 col-lg-12">
                <hr>
            </div>
        @endif

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
                <div class="form-group d-flex flex-wrap mb-0" style="text-align: -webkit-center;">

                    @if($item->question_item_media)
                        @if(explode('/', $item->question_item_media->media_type)[0] == 'audio')
                            <audio controls class="" style="max-width: 300px;">
                                <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                            </audio>
                        @endif
                    @endif

                    <div class="w-100 exercise_question_description question_info_text_type d-flex flex-wrap mt-2" style="border: 1px solid #ececec; border-radius: 5px; padding: 10px;">

                        @foreach (splitSentenceIntoWords($item->text_2) as $word)
                            @if($word == '' || $word == ' ')
                                &nbsp;
                            @else
                                <button type="button" class="btn word_button inactive {{ in_array($word, explode(', ', $item->options_correct)) ? 'correct' : '' }}">
                                    {{$word}}
                                </button>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>

            @if(!$loop->last)
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <hr>
                </div>
            @endif

        @endforeach

    </div>
    
@endif