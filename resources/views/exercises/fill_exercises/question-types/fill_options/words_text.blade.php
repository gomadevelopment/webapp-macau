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
        <div class="form-group">
            <label class="label_title d-block mb-1" style="font-size: 30px;">
            Frases </label>
        </div>
    </div>

    @foreach ($question->question_items as $item)

        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group d-inline-flex w-100 mb-0">
                @if($item->question_item_media)
                    @if(explode('/', $item->question_item_media->media_type)[0] == 'audio')
                        <audio controls class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;">
                            <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                        </audio>
                    @elseif(explode('/', $item->question_item_media->media_type)[0] == 'video')
                        <video controls class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;">
                            <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                        </video>
                    @else
                        <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" alt=""
                        class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;">
                    @endif
                    {{-- <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" 
                        alt="" class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;"> --}}
                @endif
                
                <label class="label_title m-0 align-items-center w-100">
                    - &nbsp;
                    @for ($i = 0; $i < $item->options_number; $i++)
                        {{ getStringWithSelects($item->text_1)[$i] }}
                        <?php $option = "options_".($i+1); ?>
                        <?php $shuffled_select_options = explode('|', $item->$option); ?>
                        <?php shuffle($shuffled_select_options); ?>
                            <div class="drag_and_drop_hole fill_hole word_hole w-100 mt-1 mb-1 ml-2 {{ $exame_review ? '' : 'mr-2' }} border-0">
                                <select name="{{$question->id}}_fill_options_words[{{$item->id}}][]" id="word_select_question_item_{{$item->id}}_option_{{$i+1}}" class="form-control" {{ $exame_review ? 'disabled' : '' }}>
                                    <option></option>
                                    @foreach ($shuffled_select_options as $select_option)
                                        <option value="{{$select_option}}" 
                                        {{ $exame_review && $select_option == explode('|', $item->options_answered)[$i] ? 'selected' : '' }}>
                                            {{$select_option}}
                                        </option>
                                    @endforeach
                                </select>
                                @if($exame_review)
                                    @if(explode('|', $item->$option)[0] == explode('|', $item->options_answered)[$i])
                                        <input id="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom correct_answer_checkbox_input" name="" type="checkbox" checked disabled>
                                        <label for="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label correct_answer_checkbox_label d-inline-block"></label>
                                    @else
                                        <input id="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom wrong_answer_checkbox_input" name="" type="checkbox" checked disabled>
                                        <label for="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label wrong_answer_checkbox_label d-inline-block"></label>
                                    @endif
                                @endif
                            </div>
                        @if($i == ($item->options_number - 1))
                            {{ getStringWithSelects($item->text_1)[$i+1] }}
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
                <div class="form-group d-inline-flex w-100 mb-0">
                    
                    @if($item->question_item_media)
                        @if(explode('/', $item->question_item_media->media_type)[0] == 'audio')
                            <audio controls class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;">
                                <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                            </audio>
                        @elseif(explode('/', $item->question_item_media->media_type)[0] == 'video')
                            <video controls class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;">
                                <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                            </video>
                        @else
                            <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" alt=""
                            class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;">
                        @endif
                        {{-- <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" 
                            alt="" class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;"> --}}
                    @endif

                    <label class="label_title m-0 d-block align-self-center">
                        - &nbsp;
                        @for ($i = 0; $i < $item->options_number; $i++)
                            {{ getStringWithSelects($item->text_1)[$i] }}
                            <?php $option = "options_".($i+1); ?>
                            <?php $shuffled_select_options = explode('|', $item->$option); ?>
                            <?php shuffle($shuffled_select_options); ?>
                            <div class="drag_and_drop_hole fill_hole word_hole mt-1 mb-1 ml-2 mr-2 border-0">
                                <select name="" id="exame_review_word_select_question_item_{{$item->id}}_option_{{$i+1}}" class="form-control" disabled>
                                    <option></option>
                                    @foreach ($shuffled_select_options as $select_option)
                                        <option value="{{$select_option}}" {{ explode('|', $item->$option)[0] == $select_option ? 'selected' : '' }}>{{$select_option}}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if($i == ($item->options_number - 1))
                                {{ getStringWithSelects($item->text_1)[$i+1] }}
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