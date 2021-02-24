<div class="row mt-3">

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <label class="label_title d-block mb-1" style="font-size: 30px;">
            Frases </label>
        </div>
    </div>

    <?php 

        function get_delimiters($str){
            $matches = array();
            $regex = "/<%\s*([A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_]*)\s*%>/";
            preg_match_all($regex, $str, $matches);
            return $matches[1];
        }

        function getStringWithSelects($string){
            $matches = array();
            $regex = "/<%\s*%>/";
            $string_array = preg_split($regex, $string);
            return $string_array;
        }
    
    ?>

    @foreach ($question->question_items as $item)

        <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
            <div class="form-group d-inline-flex w-100">
                @if($item->question_item_media)
                    <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" 
                        alt="" class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;">
                @endif
                <label class="label_title m-0 align-items-center w-100">
                    - &nbsp;
                    @for ($i = 0; $i < $item->options_number; $i++)
                        {{ getStringWithSelects($item->text_1)[$i] }}
                        <?php $option = "options_".($i+1); ?>
                        <?php $shuffled_select_options = explode('|', $item->$option); ?>
                        <?php shuffle($shuffled_select_options); ?>
                        <div class="drag_and_drop_hole fill_hole word_hole w-100 mt-2 mb-2 ml-2 {{ $exame_review ? '' : 'mr-2' }} border-0">
                            <select name="{{$question->id}}_fill_options_words[{{$item->id}}][]" id="word_select_question_item_{{$item->id}}_option_{{$i+1}}" class="form-control" {{ $exame_review ? 'disabled' : '' }}>
                                @foreach ($shuffled_select_options as $select_option)
                                    <option value="{{$select_option}}" 
                                    {{ $exame_review && $select_option == explode(', ', $item->options_answered)[$i] ? 'selected' : '' }}>
                                        {{$select_option}}
                                    </option>
                                @endforeach
                            </select>
                            @if($exame_review)
                                @if(explode('|', $item->$option)[0] == explode(', ', $item->options_answered)[$i])
                                    <input id="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom correct_answer_checkbox_input" name="" type="checkbox" checked>
                                    <label for="correct_answer_question_item_id_{{ $item->id }}" class="checkbox-custom-label correct_answer_checkbox_label d-inline-block"></label>
                                @else
                                    <input id="wrong_answer_question_item_id_{{ $item->id }}" class="checkbox-custom wrong_answer_checkbox_input" name="" type="checkbox" checked>
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

            <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                <div class="form-group d-inline-flex">
                    @if($item->question_item_media)
                        <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" 
                            alt="" class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;">
                    @endif
                    <label class="label_title m-0 d-block align-self-center">
                        - &nbsp;
                        @for ($i = 0; $i < $item->options_number; $i++)
                            {{ getStringWithSelects($item->text_1)[$i] }}
                            <?php $option = "options_".($i+1); ?>
                            <?php $shuffled_select_options = explode('|', $item->$option); ?>
                            <?php shuffle($shuffled_select_options); ?>
                            <div class="drag_and_drop_hole fill_hole word_hole m-2 border-0">
                                <select name="" id="exame_review_word_select_question_item_{{$item->id}}_option_{{$i+1}}" class="form-control" disabled>
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
            
        @endforeach

    </div>
    
@endif