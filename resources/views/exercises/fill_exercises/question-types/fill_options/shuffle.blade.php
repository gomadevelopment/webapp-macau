{{-- Palavras --}}
<div class="row mt-4">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <label class="label_title d-block mb-1" style="font-size: 30px;">
            Palavras </label>
        </div>
    </div>

    <?php 

        function getInbetweenStrings($str){
            $matches = array();
            $regex = "/<%\s*([\s*A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_]*[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_])\s*%>/";
            preg_match_all($regex, $str, $matches);
            return $matches[1];
        }

        function getStringInArray($string){
            $matches = array();
            $regex = "/<%\s*([\s*A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_]*[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_])\s*%>/";
            $string_array = preg_split($regex, $string);
            return $string_array;
        }
    
    ?>

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
<div class="row mt-3">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group mb-0">
            <label class="label_title d-block mb-1" style="font-size: 30px;">
            Frases </label>
        </div>
    </div>

    @foreach ($question->question_items as $item)
        
        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
            <div class="form-group d-inline-flex">
                @if($item->question_item_media)
                    <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" 
                        alt="" class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;">
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
        
            <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                <div class="form-group d-inline-flex">
                    @if($item->question_item_media)
                        <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" 
                            alt="" class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;">
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
            
        @endforeach

    </div>
    
@endif