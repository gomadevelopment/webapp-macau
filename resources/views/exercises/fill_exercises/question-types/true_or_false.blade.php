

<div class="row mb-4">

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group" style="text-align: -webkit-center;">
            <label class="label_title mt-3 mb-1 d-block" style="font-size:30px;">
                Verdadeiro ou Falso
            </label>
        </div>
    </div>

    <?php $has_not_saids = false; ?>

    @foreach ($question->question_items as $item)
        @if ($item->options_correct == "not_said")
            <?php $has_not_saids = true; ?>
            @break
        @endif
    @endforeach

    @foreach ($question->question_items as $item)
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group" style="text-align: -webkit-center;">

                <div id="" class="true_or_false_table" cellspacing="0" cellpadding="2">

                    @if($item->question_item_media)
                        <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" alt="" class="true_or_false_image">
                    @endif
                    
                    <p class="d-flex align-items-center mb-0 mr-3" style="{{ !$item->question_item_media ? 'width: 268% !important;' : '' }}">
                        {{ $item->text_1 }}
                    </p>
                    
                    <select class="form-control" name="{{$question->id}}_true_or_false[{{$item->id}}]" id="true_or_false_select_question_item_{{$item->id}}" {{ $exame_review ? 'disabled' : '' }}>
                        <option></option>
                        <option value="true" {{ $exame_review && $item->options_answered == "true" ? 'selected' : '' }}>Verdadeiro</option>
                        <option value="false" {{ $exame_review && $item->options_answered == "false" ? 'selected' : '' }}>Falso</option>
                        @if($has_not_saids)
                            <option value="not_said" {{ $exame_review && $item->options_answered == "not_said" ? 'selected' : '' }}>Não dito</option>
                        @endif
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

                    <div id="" class="true_or_false_table" cellspacing="0" cellpadding="2">

                        @if($item->question_item_media)
                            <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" alt="" class="true_or_false_image">
                        @endif
                        
                        <p class="d-flex align-items-center mb-0 mr-3" style="{{ !$item->question_item_media ? 'width: 268% !important;' : '' }}">
                            {{ $item->text_1 }}
                        </p>
                        
                        <select class="form-control" name="" id="exame_review_true_or_false_select_question_item_{{$item->id}}" disabled>
                            <option></option>
                            <option value="true" {{ $item->options_correct == "true" ? 'selected' : '' }}>Verdadeiro</option>
                            <option value="false" {{ $item->options_correct == "false" ? 'selected' : '' }}>Falso</option>
                            <option value="not_said" {{ $item->options_correct == "not_said" ? 'selected' : '' }}>Não dito</option>
                        </select>

                    </div>

                </div>
            </div>
        @endforeach

    </div>
    
@endif