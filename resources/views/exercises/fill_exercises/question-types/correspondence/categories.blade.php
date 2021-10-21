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
    {{-- FRASES --}}
    <div class="col-sm-12 col-md-6 col-lg-6">

        <div class="row">
        
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <label class="label_title d-block mb-1" style="font-size: 30px;">
                    Frases </label>
                </div>
            </div>

            @foreach ($question->question_items as $item)
                @for ($i = 0; $i < $item->options_number; $i++)

                    <?php $option = "options_".($i+1); ?>
                    <?php $shuffle_categories_options[] = $item->$option; ?>

                @endfor
                @foreach (explode('|', $item->options_answered) as $answer)
                    <?php $all_options_answered[] = $answer; ?>
                @endforeach
            @endforeach

            @if($exame_review)
                @foreach (array_diff($shuffle_categories_options, $all_options_answered) as $unanswered_answer)
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">

                            <div class="drag_and_drop_hole origin_hole drop">
                                <div class="drag_and_drop_item p-2 correspondence_items">
                                    {{ $unanswered_answer }}
                                </div>
                            </div>
                                
                        </div>
                    </div>
                @endforeach
                @for ($i = 0; $i < (sizeof($shuffle_categories_options) - sizeof(array_diff($shuffle_categories_options, $all_options_answered))); $i++)
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">

                            <div class="drag_and_drop_hole origin_hole drop">

                            </div>
                                
                        </div>
                    </div>
                @endfor
                
            @else
                <?php shuffle($shuffle_categories_options); ?>

                @foreach($shuffle_categories_options as $shuffled_option)

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="drag_and_drop_hole origin_hole drop">
                                <div class="drag_and_drop_item p-2 correspondence_items">
                                    {{ $shuffled_option }}
                                    <input type="hidden" name="" value="{{ $shuffled_option }}">
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            @endif
        
        </div>

    </div>

    {{-- CATEGORIAS --}}
    <div class="col-sm-12 col-md-6 col-lg-6">

        <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group mb-0">
                    <label class="label_title d-block mb-1" style="font-size: 30px;">
                    Categorias </label>
                </div>
            </div>

            @foreach ($question->question_items as $item)
                
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group mb-0 mt-3 align-items-center d-inline-flex">
                        <label class="label_title mb-0 d-block">
                            {{ $item->text_1 }} </label>
                        @if($item->question_item_media)
                            @if(explode('/', $item->question_item_media->media_type)[0] == 'audio')
                                <audio controls class="ml-3 align-self-center" style="max-width: 300px;">
                                    <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                                </audio>
                            @endif
                        @endif
                    </div>
                </div>

                <?php
                    $categories_options_correct_array = [];
                    for ($i=0; $i < $item->options_number; $i++) { 
                        $option = 'options_'.($i+1);
                        $categories_options_correct_array[] = $item->$option;
                    }
                ?>

                @for ($i = 0; $i < $item->options_number; $i++)
                    <?php $option = 'options_'.($i+1); ?>
                    @if($exame_review)
                        {{-- @foreach (explode('|', $item->options_answered) as $answer) --}}
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group d-flex align-items-center">
                                    <div class="drag_and_drop_hole drop mt-3">
                                        @if(explode('|', $item->options_answered)[$i] == '')

                                        @else
                                            <div class="drag_and_drop_item p-2 correspondence_items">
                                                {{ explode('|', $item->options_answered)[$i] }}
                                            </div>
                                        @endif
                                    </div>
                                    @if(in_array(explode('|', $item->options_answered)[$i], $categories_options_correct_array))
                                        <input id="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom correct_answer_checkbox_input" name="" type="checkbox" checked disabled>
                                        <label for="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label correct_answer_checkbox_label d-inline-block mt-3"></label>
                                    @else
                                        <input id="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom wrong_answer_checkbox_input" name="" type="checkbox" checked disabled>
                                        <label for="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label wrong_answer_checkbox_label d-inline-block mt-3"></label>
                                    @endif
                                </div>
                            </div>
                        {{-- @endforeach --}}
                    @else
                        <input type="hidden" name="{{$question->id}}_correspondence_categories[{{ $item->id }}][]" class="correspondence_d_and_d" data-item-id="">

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="drag_and_drop_hole drop mt-3">

                                </div>
                            </div>
                        </div>
                    @endif

                @endfor

            @endforeach
        
        </div>

    </div>

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
                <div class="form-group mb-0 mt-3 align-items-center d-inline-flex">
                    <label class="label_title mb-0 d-block">
                        {{ $item->text_1 }} </label>
                    @if($item->question_item_media)
                        @if(explode('/', $item->question_item_media->media_type)[0] == 'audio')
                            <audio controls class="ml-3 align-self-center" style="max-width: 300px;">
                                <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                            </audio>
                        @endif
                    @endif
                </div>
            </div>

            @for ($i = 0; $i < $item->options_number; $i++)
                <?php $option = 'options_'.($i+1); ?>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <div class="drag_and_drop_hole drop mt-3">
                            <div class="drag_and_drop_item p-2 correspondence_items">
                                {{ $item->$option }}
                            </div>
                        </div>
                    </div>
                </div>

            @endfor

        @endforeach

    </div>

@endif