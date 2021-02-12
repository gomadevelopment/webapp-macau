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
            <div class="form-group d-inline-flex">
                @if($item->question_item_media)
                    <img src="{{ '/webapp-macau-storage/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" 
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
                            <select name="{{$question->id}}_fill_options_words[{{$item->id}}][]" id="word_select_question_item_{{$item->id}}_option_{{$i+1}}" class="form-control">
                                @foreach ($shuffled_select_options as $select_option)
                                    <option value="{{$select_option}}">{{$select_option}}</option>
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