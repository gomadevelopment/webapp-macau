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
    <?php $has_medias = false; ?>
    @foreach ($question->question_items as $item)
        @if($item->question_item_media)
            <?php $has_medias = true; ?>
            @break
        @endif
    @endforeach

    @foreach ($question->question_items as $item)
        <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
            <div class="form-group" style="text-align: -webkit-center;">

                @if($has_medias)
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
                @endif

                <label class="label_title mt-1 mb-1 d-block">
                    Questão {{ $loop->index + 1 }}
                </label>
                <p class="exercise_author">
                    {{ $item->text_1 }}
                </p>

                <div class="mt-3">

                    <select name="{{$question->id}}_multiple_choice_questions[{{$item->id}}]" id="m_c_questions_select_question_item_{{$item->id}}" {{ $exame_review ? 'disabled' : '' }}>
                        {{-- <option value="0">Seleccione a opção correta...</option> --}}
                        <option></option>
                        @for ($i = 0; $i < $item->options_number; $i++)
                            <?php $option = "options_".($i+1); ?>

                            <option value="{{ $i + 1 }}" {{ $exame_review && $item->options_answered == ($i + 1) ? 'selected' : '' }}>{{ $item->$option }}</option>

                        @endfor
                    </select>

                </div>
                @if($exame_review)
                    @if(in_array($item->options_answered, explode('|', $item->options_correct)))
                        {{-- CORRETO --}}
                        <input id="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom correct_answer_checkbox_input" name="" type="checkbox" checked disabled>
                        <label for="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label correct_answer_checkbox_label d-inline-block mb-0 mt-3"></label>
                    @else
                        {{-- ERRADO --}}
                        <input id="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom wrong_answer_checkbox_input" name="" type="checkbox" checked disabled>
                        <label for="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label wrong_answer_checkbox_label d-inline-block mb-0 mt-3"></label>
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

            <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
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

                    <label class="label_title mt-3 mb-1 d-block">
                        Questão {{ $loop->index + 1 }}
                    </label>
                    <p class="exercise_author">
                        {{ $item->text_1 }}
                    </p>

                    <div class="mt-3">

                        <select name="" id="exame_review_m_c_questions_select_question_item_{{$item->id}}" disabled>
                            {{-- <option value="0">Seleccione a opção correta...</option> --}}
                            <option></option>
                            @for ($i = 0; $i < $item->options_number; $i++)
                                <?php $option = "options_".($i+1); ?>

                                <option value="{{ $i + 1 }}" {{ in_array(($i + 1), explode('|', $item->options_correct)) ? 'selected' : '' }} >{{ $item->$option }}</option>

                            @endfor
                        </select>

                    </div>
                </div>
            </div>

        @endforeach

    </div>
    
@endif