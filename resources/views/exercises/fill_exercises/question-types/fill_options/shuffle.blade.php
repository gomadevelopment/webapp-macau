{{-- Palavras --}}
<div class="row mt-4">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <label class="label_title d-block" style="font-size: 30px;">
            Palavras </label>
        </div>
    </div>

    <?php 

        function getInbetweenStrings($str){
            $matches = array();
            $regex = "/<%\s*([A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_]*)\s*%>/";
            preg_match_all($regex, $str, $matches);
            return $matches[1];
        }

        function getStringInArray($string){
            $matches = array();
            $regex = "/<%\s*([A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_]*)\s*%>/";
            $string_array = preg_split($regex, $string);
            return $string_array;
        }
    
    ?>

    @foreach ($question->question_items->shuffle() as $item)

        @foreach (getInbetweenStrings($item->text_1) as $word)

            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                <div class="form-group">
                    <div class="drag_and_drop_hole origin_hole word_hole drop">
                        <div class="drag_and_drop_item word_item p-2" >
                            {{ $word }}
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    @endforeach

</div>

{{-- Frases --}}
<div class="row mt-3">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group mb-0">
            <label class="label_title d-block mb-4" style="font-size: 30px;">
            Frases </label>
        </div>
    </div>

    @foreach ($question->question_items as $item)
        
            <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                <div class="form-group d-inline-flex">
                    @if($item->question_item_media)
                        <img src="{{ '/webapp-macau-storage/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" 
                            alt="" class="mr-4 mt-2 mb-2 align-self-center" style="border-radius: 6px; min-width: 100px; max-width: 100px; height: fit-content; max-height: 100px;">
                    @endif
                    <label class="label_title m-0 d-block align-self-center">

                        @foreach (getStringInArray($item->text_1) as $sub_string)

                            {{ $sub_string }}

                            @if(!$loop->last)
                                <div class="drag_and_drop_hole fill_hole word_hole drop m-2">

                                </div>
                            @endif

                        @endforeach

                    </label>
                </div>
            </div>
        
    @endforeach

</div>