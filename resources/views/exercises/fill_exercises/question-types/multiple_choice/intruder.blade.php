<div class="row mb-4">

    @foreach ($question->question_items as $item)
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group" style="text-align: -webkit-center;">
                <label class="label_title mt-3 mb-1 d-block" style="font-size:30px;">
                    Conjunto de Palavras {{ $loop->index + 1 }}
                </label>
                <label class="label_title mt-3 mb-1 d-block" style="border-radius: 5px; border: 2px solid #e6ebf1; padding: 10px;">

                    @for ($i = 0; $i < $item->options_number; $i++)
                        <?php $option = "options_".($i+1); ?>

                        @if($i == 0)
                            {{ $item->$option }}
                        @else
                            &nbsp; - &nbsp; {{ $item->$option }}
                        @endif

                    @endfor

                </label>

            </div>
        </div>

        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="form-group d-flex" style="text-align: -webkit-center;">

                <select name="{{$question->id}}_multiple_choice_intruder[{{$item->id}}]" id="m_c_intruder_select_question_item_{{$item->id}}" {{ $exame_review ? 'disabled' : '' }}>
                    <option></option>
                    @for ($i = 0; $i < $item->options_number; $i++)
                        <?php $option = "options_".($i+1); ?>

                        <option value="{{ $i + 1 }}" {{ $exame_review && $item->options_answered == ($i + 1) ? 'selected' : '' }}>{{ $item->$option }}</option>

                    @endfor
                </select>

                @if($exame_review)
                    @if($item->options_correct == $item->options_answered)
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
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group" style="text-align: -webkit-center;">
                    <label class="label_title mt-3 mb-1 d-block" style="font-size:30px;">
                        Conjunto de Palavras {{ $loop->index + 1 }}
                    </label>
                    <label class="label_title mt-3 mb-1 d-block" style="border-radius: 5px; border: 2px solid #e6ebf1; padding: 10px;">

                        @for ($i = 0; $i < $item->options_number; $i++)
                            <?php $option = "options_".($i+1); ?>

                            @if($i == 0)
                                {{ $item->$option }}
                            @else
                                &nbsp; - &nbsp; {{ $item->$option }}
                            @endif

                        @endfor

                    </label>

                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group" style="text-align: -webkit-center;">

                    <select name="" id="exame_review_m_c_intruder_select_question_item_{{$item->id}}" disabled>
                        <option></option>
                        @for ($i = 0; $i < $item->options_number; $i++)
                            <?php $option = "options_".($i+1); ?>

                            <option value="{{ $i + 1 }}" {{ $item->options_correct == ($i + 1) ? 'selected' : '' }} >{{ $item->$option }}</option>

                        @endfor
                    </select>

                </div>
            </div>

        @endforeach

    </div>
    
@endif