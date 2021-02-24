{{-- Frases --}}
<div class="row mt-5">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <label class="label_title d-block mb-1" style="font-size: 30px;">
            Palavras </label>
        </div>
    </div>

    <?php
        function getVowelsUnderlined($str, $skip){
            $matches = array();
            $regex = "/<%\s*([A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_]*)\s*%>/";
            preg_match_all($regex, $str, $matches);
            $string_array = preg_split($regex, $str);
            $underlined_string = '';
            for($i = 0; $i < sizeof($string_array); $i++){
                
                if($i == (sizeof($string_array) - 1)){
                    $underlined_string .= $string_array[$i];
                }
                else if($i != (sizeof($string_array) - 1)){
                    if($skip == $i){
                        $underlined_string .= $string_array[$i] . '<u>' . $matches[1][$i] . '</u>';
                    }
                    else{
                        $underlined_string .= $string_array[$i] . $matches[1][$i];
                    }
                    continue;
                }
            }

            return $underlined_string;
        }

        function skipFun($str){
            $regex = "/<%\s*([A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_]*)\s*%>/";
            preg_match_all($regex, $str, $matches);
            return sizeof($matches[1]);
        }

    ?>
    {{-- Tr<%a%>b<%a%>lh<%a%>r --}}
    @foreach ($question->question_items as $item)

        <div class="col-sm-12 col-md-3 col-lg-3">
            <div class="row">
                @if($item->question_item_media)
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            @if(explode('/', $item->question_item_media->media_type)[0] == 'audio')
                                <audio id="player_{{$item->id}}" controls controlslist="nodownload" style="width: -webkit-fill-available;">
                                    <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                                </audio>
                                {{-- <div>
                                    <button onclick="document.getElementById('player_{{$item->id}}').play()">Play</button>
                                    <button onclick="document.getElementById('player_{{$item->id}}').pause()">Pause</button>
                                    <button onclick="document.getElementById('player_{{$item->id}}').muted=!document.getElementById('player').muted">Mute/ Unmute</button>
                                </div> --}}
                            @endif
                        </div>
                    </div>
                @else
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                        </div>
                    </div>
                @endif
                @for ($i = 0; $i < skipFun($item->text_1); $i++)

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <div class="drag_and_drop_hole origin_hole drop">
                                {{-- {!! getVowelsUnderlined($item->text_1) !!} --}}
                                <div class="drag_and_drop_item p-2 vowels_items">
                                    {!! getVowelsUnderlined($item->text_1, $i) !!}
                                    <input type="hidden" name="" value="{{ $item->id . ',' . $i }}">
                                </div>
                            </div>
                        </div>
                    </div>

                @endfor
            </div>
        </div>

    @endforeach

</div>

{{-- Campos --}}
<div class="row mt-3">

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group mb-0">
            <label class="label_title d-block mb-1" style="font-size: 30px;">
            Vogais </label>
        </div>
    </div>

    <?php
        function getUniqueVowels($question_items){
            $unique_vowels = [];
            foreach($question_items as $item){
                for ($i = 0; $i < $item->options_number; $i++){
                    $option = "options_".($i+1);
                    $unique_vowels[] = $item->$option;
                }
            }
            return array_unique($unique_vowels);
        }

        function getNumberOfVowels($question_items, $vowel){
            $all_vowels = [];
            foreach($question_items as $item){
                for ($i = 0; $i < $item->options_number; $i++){
                    $option = "options_".($i+1);
                    $all_vowels[] = $item->$option;
                }
            }
            $counts = array_count_values($all_vowels);
            return $counts[$vowel];
        }
    ?>
    
    <?php $unique_vowels = getUniqueVowels($question->question_items); ?>

    @foreach ($unique_vowels as $vowel)

        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group mb-0 mt-3">
                <label class="label_title mb-0 d-block" style="font-family: sans-serif !important;">
                    {{ $vowel }} </label>
            </div>
        </div>

        @for ($i = 0; $i < getNumberOfVowels($question->question_items, $vowel); $i++)

            <input type="hidden" name="{{$question->id}}_vowels[{{ $vowel }}][]" class="vowels_d_and_d" data-item-id="">

            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="form-group">
                    <div class="drag_and_drop_hole drop mt-3">

                    </div>
                </div>
            </div>

        @endfor

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

        @foreach ($unique_vowels as $vowel)
    
            @foreach ($question->question_items as $item)

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group mb-0 mt-3">
                        <label class="label_title mb-0 d-block" style="font-family: sans-serif !important;">
                            {{ $vowel }} </label>
                    </div>
                </div>

                @for ($i = 0; $i < getNumberOfVowels($question->question_items, $vowel); $i++)

                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-group">
                            <div class="drag_and_drop_hole drop mt-3">
                                <div class="drag_and_drop_item p-2 vowels_items">
                                    @if($vowel == $item->$option)
                                    {!! getVowelsUnderlined($item->text_1, $i) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                @endfor

            @endforeach

        @endforeach
        
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