<div class="row mb-4">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group" style="text-align: -webkit-center;">
            <label class="label_title mt-3 mb-1 d-block" style="font-size:30px;">
                Diferenças
            </label>
        </div>
    </div>
    
    @foreach ($question->question_items as $item)
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group d-flex" style="text-align: -webkit-center;">

                <div class="w-100">

                    <textarea class="form-control" name="{{$question->id}}_differences[{{$item->id}}]" id="" cols="30" rows="5" {{ $exame_review ? 'readonly' : '' }}>{{ $exame_review ? $item->options_answered : $item->text_1 }}</textarea>

                </div>

                @if($exame_review)
                    @if($item->text_2 == $item->options_answered)
                        <input id="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom correct_answer_checkbox_input" name="" type="checkbox" checked>
                        <label for="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label correct_answer_checkbox_label d-inline-block align-self-center"></label>
                    @else
                        <input id="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom wrong_answer_checkbox_input" name="" type="checkbox" checked>
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
                <div class="form-group d-flex" style="text-align: -webkit-center;">

                    <div class="w-100">

                        <textarea class="form-control" name="" id="" cols="30" rows="5" readonly>{{ $item->text_2 }}</textarea>

                    </div>
                </div>
            </div>

        @endforeach

    </div>
    
@endif