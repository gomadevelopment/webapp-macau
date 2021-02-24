<div class="row mb-4">

    @foreach ($question->question_items as $item)
        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="form-group" style="text-align: -webkit-center;">
                <div class="drag_and_drop_image text-center">
                    @if($item->question_item_media)
                        <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" alt="">
                    @else

                    @endif
                </div>
                <label class="label_title mt-3 mb-1 d-block">
                    Questão {{ $loop->index + 1 }}
                </label>
                <p class="exercise_author">
                    {{ $item->text_1 }}
                </p>

                <div class="mt-3">

                    <select name="{{$question->id}}_multiple_choice_questions[{{$item->id}}]" id="m_c_questions_select_question_item_{{$item->id}}" {{ $exame_review ? 'disabled' : '' }}>
                        @for ($i = 0; $i < $item->options_number; $i++)
                            <?php $option = "options_".($i+1); ?>

                            <option value="{{ $i + 1 }}" {{ $exame_review && $item->options_answered == ($i + 1) ? 'selected' : '' }}>{{ $item->$option }}</option>

                        @endfor
                    </select>

                </div>
                @if($exame_review)
                    @if(in_array($item->options_answered, explode(', ', $item->options_correct)))
                        {{-- CORRETO --}}
                        <input id="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom correct_answer_checkbox_input" name="" type="checkbox" checked>
                        <label for="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label correct_answer_checkbox_label d-inline-block mb-0 mt-3"></label>
                    @else
                        {{-- ERRADO --}}
                        <input id="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom wrong_answer_checkbox_input" name="" type="checkbox" checked>
                        <label for="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label wrong_answer_checkbox_label d-inline-block mb-0 mt-3"></label>
                    @endif
                @endif
            </div>
        </div>

    @endforeach
</div>

{{-- SOLUTIONS --}}

@if ($exame_review)

    <hr class="mt-4 mb-4">

    <div class="row mb-4">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <label class="label_title d-block" style="font-size: 30px;">
                Soluções </label>
            </div>
        </div>
        
        @foreach ($question->question_items as $item)

            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group" style="text-align: -webkit-center;">
                    <div class="drag_and_drop_image text-center">
                        @if($item->question_item_media)
                            <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" alt="">
                        @else

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
                            @for ($i = 0; $i < $item->options_number; $i++)
                                <?php $option = "options_".($i+1); ?>

                                <option value="{{ $i + 1 }}" {{ in_array(($i + 1), explode(', ', $item->options_correct)) ? 'selected' : '' }} >{{ $item->$option }}</option>

                            @endfor
                        </select>

                    </div>
                </div>
            </div>

        @endforeach

    </div>
    
@endif