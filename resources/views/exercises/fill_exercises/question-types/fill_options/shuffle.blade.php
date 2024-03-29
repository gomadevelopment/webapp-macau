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

{{-- Palavras --}}
<div class="row mb-4">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <label class="label_title d-block mb-1" style="font-size: 30px;">
            Palavras </label>
        </div>
    </div>

    @foreach ($question->question_items as $item)

        @foreach (getInbetweenStrings($item->text_1) as $word)
            <?php $all_possible_shuffled_options[] = $word; ?>
        @endforeach
        @foreach (explode('|', $item->options_answered) as $answer)
            <?php $all_shuffled_options_answered[] = $answer; ?>
        @endforeach

    @endforeach

    @if($exame_review)
        @foreach (array_diff($all_possible_shuffled_options, $all_shuffled_options_answered) as $unanswered_answer)
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                <div class="form-group">
                    <div class="drag_and_drop_hole origin_hole word_hole drop">
                        <div class="drag_and_drop_item word_item p-2 fill_options_shuffle_items" >
                            {{ $unanswered_answer }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @for ($i = 0; $i < (sizeof($all_possible_shuffled_options) - sizeof(array_diff($all_possible_shuffled_options, $all_shuffled_options_answered))); $i++)
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                <div class="form-group">
                    <div class="drag_and_drop_hole origin_hole word_hole drop">

                    </div>
                </div>
            </div>
        @endfor
    @else
        @foreach ($question->question_items->shuffle() as $item)
            <?php $shuffled_words = getInbetweenStrings($item->text_1); ?>
            <?php shuffle($shuffled_words); ?>

            @foreach ($shuffled_words as $word)

                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                    <div class="form-group">
                        <div class="drag_and_drop_hole origin_hole word_hole drop">
                            <div class="drag_and_drop_item word_item p-2 fill_options_shuffle_items" >
                                {{ $word }}
                                <input type="hidden" name="" value="{{ $word }}">
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        @endforeach
    @endif

</div>

{{-- Frases --}}
<div class="row">
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
                    @if(explode('/', $item->question_item_media->media_type)[0] == 'audio')
                        <audio controls class="mt-2" style="max-width: 300px;">
                            <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                        </audio>
                    @elseif(explode('/', $item->question_item_media->media_type)[0] == 'video')
                        <video controls class="mt-2" style="max-width: 300px;">
                            <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                        </video>
                    @else
                        <img class="mt-2" src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" 
                        alt="" class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px;max-width: 300px;">
                    @endif
                @endif

                @if($exame_review)
                    <label class="label_title m-0 d-block align-self-center">
                        <?php $asd = explode('|', $item->options_answered); ?>

                        @for ($i = 0; $i < sizeof(getStringInArray($item->text_1)); $i++)
                            {{ getStringInArray($item->text_1)[$i] }}

                            @if($i < (sizeof(getStringInArray($item->text_1)) - 1))
                            <div class="d-inline-block">
                                <div class="drag_and_drop_hole fill_hole word_hole drop mt-2 mb-2 ml-2">
                                    @if(isset(explode('|', $item->options_answered)[$i]) && explode('|', $item->options_answered)[$i] != '')
                                        <div class="drag_and_drop_item word_item p-2 fill_options_shuffle_items" >
                                            {{ explode('|', $item->options_answered)[$i] }}
                                        </div>
                                    @endif
                                </div>
                                @if(getInbetweenStrings($item->text_1)[$i] == explode('|', $item->options_answered)[$i])
                                    <input id="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom correct_answer_checkbox_input" name="" type="checkbox" checked disabled>
                                    <label for="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label correct_answer_checkbox_label d-inline-block mr-2"></label>
                                @else
                                    <input id="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom wrong_answer_checkbox_input" name="" type="checkbox" checked disabled>
                                    <label for="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label wrong_answer_checkbox_label d-inline-block mr-2"></label>
                                @endif
                            </div>
                            @endif

                        @endfor

                    </label>
                @else
                    <label class="label_title m-0 d-block align-self-center">

                        @foreach (getStringInArray($item->text_1) as $sub_string)

                            {{ $sub_string }}

                            @if(!$loop->last)
                                <input type="hidden" name="{{$question->id}}_fill_options_shuffle[{{ $item->id }}][]" class="fill_options_d_and_d" data-item-id="">
                                <div class="drag_and_drop_hole fill_hole word_hole drop m-2">

                                </div>
                            @endif

                        @endforeach

                    </label>
                @endif
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
                <div class="form-group mb-0">
                    @if($item->question_item_media)
                        @if(explode('/', $item->question_item_media->media_type)[0] == 'audio')
                            <audio controls class="mt-2" style="max-width: 300px;">
                                <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                            </audio>
                        @elseif(explode('/', $item->question_item_media->media_type)[0] == 'video')
                            <video controls class="mt-2" style="max-width: 300px;">
                                <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                            </video>
                        @else
                            <img class="mt-2" src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" 
                            alt="" class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px;max-width: 300px;">
                        @endif
                    @endif

                    <label class="label_title m-0 d-block align-self-center">

                        @for ($i = 0; $i < sizeof(getStringInArray($item->text_1)); $i++)
                            {{ getStringInArray($item->text_1)[$i] }}

                            @if($i < (sizeof(getStringInArray($item->text_1)) - 1))
                                <div class="drag_and_drop_hole fill_hole word_hole drop m-2">
                                    <div class="drag_and_drop_item word_item p-2 fill_options_shuffle_items" >
                                        {{ getInbetweenStrings($item->text_1)[$i] }}
                                    </div>
                                </div>
                            @endif

                        @endfor

                    </label>
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