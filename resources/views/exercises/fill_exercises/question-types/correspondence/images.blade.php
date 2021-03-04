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
            <label class="label_title d-block" style="font-size: 30px;">
            Frases </label>
        </div>
    </div>

    @foreach ($question->question_items->shuffle() as $item)

        <div class="col-sm-12 col-md-3 col-lg-3">
            <div class="form-group">

                @if($exame_review)
                    @if(!in_array($item->id, $question->question_items->pluck('options_answered')->toArray()))
                        <div class="drag_and_drop_hole origin_hole drop">
                            <div class="drag_and_drop_item p-2 correspondence_items">
                                {{ $item->text_1 }}
                            </div>
                        </div>
                    @else
                        <div class="drag_and_drop_hole origin_hole drop">
                            
                        </div>
                    @endif
                @else
                    <div class="drag_and_drop_hole origin_hole drop">
                        <div class="drag_and_drop_item p-2 correspondence_items">
                            {{ $item->text_1 }}
                            <input type="hidden" name="" value="{{ $item->id }}">
                        </div>
                    </div>
                @endif

            </div>
        </div>

    @endforeach
</div>

<div class="row">

    @foreach ($question->question_items as $item)
        <div class="col-sm-12 col-md-3 col-lg-3">
            <div class="form-group" style="text-align: -webkit-center;">
                
                <div class="drag_and_drop_image text-center">
                    @if($item->question_item_media)
                            @if(explode('/', $item->question_item_media->media_type)[0] == 'audio')
                                <audio controls>
                                    <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                                </audio>
                            @elseif(explode('/', $item->question_item_media->media_type)[0] == 'video')
                                <video controls>
                                    <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                                </video>
                            @else
                                <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" alt="">
                            @endif
                    @else
                        <img src="{{ asset('/assets/backoffice_assets/images/Placeholder.png') }}" alt="">
                    @endif
                </div>

                <input type="hidden" name="{{$question->id}}_correspondence_images[{{ $item->question_item_media->id }}]" class="correspondence_d_and_d" data-item-id="">
                
                @if($exame_review)
                    
                    @foreach ($question->question_items as $item_to_match)
                        @if($item->options_answered == '')
                            <div class="drag_and_drop_hole drop mt-3">

                            </div>
                            <input id="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom wrong_answer_checkbox_input" name="" type="checkbox" checked disabled>
                            <label for="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label wrong_answer_checkbox_label d-inline-block mb-0 mt-3"></label>
                            @break
                        @endif
                        @if($item->options_answered == $item_to_match->id)
                            <div class="drag_and_drop_hole drop mt-3">
                                <div class="drag_and_drop_item p-2 correspondence_items">
                                    {{ $item_to_match->text_1 }}
                                </div>
                            </div>
                            @if($item->id == $item->options_answered)
                                {{-- CORRETO --}}
                                <input id="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom correct_answer_checkbox_input" name="" type="checkbox" checked disabled>
                                <label for="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label correct_answer_checkbox_label d-inline-block mb-0 mt-3"></label>
                            @else
                                {{-- ERRADO --}}
                                <input id="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom wrong_answer_checkbox_input" name="" type="checkbox" checked disabled>
                                <label for="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label wrong_answer_checkbox_label d-inline-block mb-0 mt-3"></label>
                            @endif
                        {{-- @break --}}
                        @endif
                        
                    @endforeach

                @else
                    <div class="drag_and_drop_hole drop mt-3">

                    </div>
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
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="form-group" style="text-align: -webkit-center;">
                    
                    <div class="drag_and_drop_image text-center">
                        @if($item->question_item_media)
                                @if(explode('/', $item->question_item_media->media_type)[0] == 'audio')
                                    <audio controls>
                                        <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                                    </audio>
                                @elseif(explode('/', $item->question_item_media->media_type)[0] == 'video')
                                    <video controls>
                                        <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                                    </video>
                                @else
                                    <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" alt="">
                                @endif
                        @else
                            <img src="{{ asset('/assets/backoffice_assets/images/Placeholder.png') }}" alt="">
                        @endif
                    </div>
                    
                    <div class="drag_and_drop_hole drop mt-3">
                        <div class="drag_and_drop_item p-2 correspondence_items">
                            {{ $item->text_1 }}
                        </div>
                    </div>

                </div>
            </div>

        @endforeach

    </div>

@endif