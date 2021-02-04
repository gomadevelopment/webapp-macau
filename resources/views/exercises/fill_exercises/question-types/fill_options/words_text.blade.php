<div class="row mt-3">

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
    {{-- Eu sou a <% %>, o meu apelido é <% %> e tenho <% %> anos. <% %> --}}
        <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
            <div class="form-group d-inline-flex">
                @if($item->question_item_media)
                    <img src="{{ '/webapp-macau-storage/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" 
                        alt="" class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;">
                @endif
                <label class="label_title m-0 d-block align-self-center">

                    @for ($i = 0; $i < $item->options_number; $i++)
                        {{ getStringWithSelects($item->text_1)[$i] }}
                        <?php $option = "options_".($i+1); ?>
                        <?php $shuffled_select_options = explode('|', $item->$option); ?>
                        <?php shuffle($shuffled_select_options); ?>
                        <div class="drag_and_drop_hole fill_hole word_hole m-2 border-0">
                            <select name="word_select_question_item_{{$item->id}}_option_{{$i+1}}" id="word_select_question_item_{{$item->id}}_option_{{$i+1}}" class="form-control">
                                @foreach ($shuffled_select_options as $select_option)
                                    <option value="{{$select_option}}">{{$select_option}}</option>
                                @endforeach
                            </select>
                        </div>

                        @if($i == ($item->options_number - 1))
                            {{ getStringWithSelects($item->text_1)[$i+1] }}
                        @endif
                        
                    @endfor

                    {{-- @foreach (getStringWithSelects($item) as $sub_string)
                        {{ $sub_string }}
                        <div class="drag_and_drop_hole fill_hole word_hole m-2 border-0">
                            <select name="verbs_select_1" id="verbs_select_1" class="form-control">
                                <option value="1">ser</option>
                                <option value="2">foi</option>
                                <option value="3">é</option>
                            </select>
                        </div>
                    @endforeach
                    {!! getStringWithSelects($item) !!}
                    - E 
                    <div class="drag_and_drop_hole fill_hole word_hole m-2 border-0">
                        <select name="verbs_select_1" id="verbs_select_1" class="form-control">
                            <option value="1">ser</option>
                            <option value="2">foi</option>
                            <option value="3">é</option>
                        </select>
                    </div>
                    de onde? --}}
                </label>
            </div>
    </div>
        
    @endforeach

    {{-- <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
        <div class="form-group d-inline-flex">
            <img src="{{asset('/assets/backoffice_assets/images/pt_flag_image.png')}}" alt="" class="mr-4 mt-2 mb-2 align-self-center" style="height: fit-content;">
            <label class="label_title m-0 d-block align-self-center">
                - E 
                <div class="drag_and_drop_hole fill_hole word_hole m-2 border-0">
                    <select name="verbs_select_1" id="verbs_select_1" class="form-control">
                        <option value="1">ser</option>
                        <option value="2">foi</option>
                        <option value="3">é</option>
                    </select>
                </div>
                de onde?
            </label>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
        <div class="form-group d-inline-flex">
            <img src="{{asset('/assets/backoffice_assets/images/pt_flag_image.png')}}" alt="" class="mr-4 mt-2 mb-2 align-self-center" style="height: fit-content;">
            <label class="label_title m-0 d-block align-self-center">
                <div class="drag_and_drop_hole fill_hole word_hole m-2 border-0">
                    <select name="verbs_select_2" id="verbs_select_2" class="form-control">
                        <option value="1">Vem</option>
                        <option value="2">Foi</option>
                        <option value="3">É</option>
                    </select>
                </div>
                de onde?
            </label>
        </div>
    </div> --}}

</div>