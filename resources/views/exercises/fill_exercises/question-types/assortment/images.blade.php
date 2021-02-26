<div class="row mb-4">

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group" style="text-align: -webkit-center;">
            <label class="label_title mt-3 mb-1 d-block" style="font-size:30px;">
                Conjunto de Imagens
            </label>
        </div>
    </div>
    
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group" style="text-align: -webkit-center;">

            <ul id="assortment_images_table_question_{{ $question->id }}" class="assortment_tables" cellspacing="0" cellpadding="2">
                @if(!$exame_review)
                    @foreach ($question->question_items->shuffle() as $item)

                        <li>
                            <img src="{{asset('/assets/backoffice_assets/icons/Drag_black.svg')}}" alt="" class="mr-3">
                            @if($item->question_item_media)
                                <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" alt="" class="assort_image">
                            @else

                            @endif
                            <span class="d-flex align-items-center">{{ $item->text_1 }}</span>
                            <input type="hidden" name="{{$question->id}}_assortment_images[]" value="{{ $item->id }}" class="assortment_d_and_d" data-item-id="">
                        </li>

                    @endforeach
                @else

                    @foreach ($question->question_items as $item)
                        @foreach ($question->question_items as $item_to_match)
                            @if($item->options_answered == $item_to_match->id)
                                <li>
                                    <img src="{{asset('/assets/backoffice_assets/icons/Drag_black.svg')}}" alt="" class="mr-3">
                                    @if($item_to_match->question_item_media)
                                        <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item_to_match->id.'/'.$item_to_match->question_item_media->media_url }}" alt="" class="assort_image">
                                    @else

                                    @endif
                                    <span class="d-flex align-items-center">{{ $item_to_match->text_1 }}</span>
                                    @if($item->id == $item->options_answered)
                                        <input id="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom correct_answer_checkbox_input" name="" type="checkbox" checked disabled>
                                        <label for="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label correct_answer_checkbox_label d-inline-block align-self-center"></label>
                                    @else
                                        <input id="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom wrong_answer_checkbox_input" name="" type="checkbox" checked disabled>
                                        <label for="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label wrong_answer_checkbox_label d-inline-block align-self-center"></label>
                                    @endif
                                </li>
                            @endif

                        @endforeach
                    @endforeach

                @endif

            </ul>

        </div>
    </div>

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

        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group" style="text-align: -webkit-center;">

                <ul id="exame_review_assortment_images_table_question_{{ $question->id }}" class="assortment_tables" cellspacing="0" cellpadding="2">

                    @foreach ($question->question_items as $item)

                        <li style="cursor: default;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Drag_black.svg')}}" alt="" class="mr-3">
                            @if($item->question_item_media)
                                <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" alt="" class="assort_image">
                            @else

                            @endif
                            <span class="d-flex align-items-center">{{ $item->text_1 }}</span>
                        </li>

                    @endforeach

                </ul>

            </div>
        </div>

    </div>
    
@endif