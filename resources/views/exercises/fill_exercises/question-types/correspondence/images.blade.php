<div class="row mb-4">

    @foreach ($question->question_items->shuffle() as $item)
        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="form-group" style="text-align: -webkit-center;">
                <div class="drag_and_drop_image text-center">
                    @if($item->question_item_media)
                        <img src="{{ '/webapp-macau-storage/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" alt="">
                    @else

                    @endif
                    </div>
                <div class="drag_and_drop_hole drop mt-3">

                </div>
            </div>
        </div>

    @endforeach
</div>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <label class="label_title d-block" style="font-size: 30px;">
            Frases </label>
        </div>
    </div>

    @foreach ($question->question_items->shuffle() as $item)

        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">

                <div class="drag_and_drop_hole origin_hole drop">

                    <div class="drag_and_drop_item p-2">
                        {{ $item->text_1 }}
                    </div>

                </div>
                    
            </div>
        </div>

    @endforeach
</div>

{{-- <ul id="list">
    <li>Item A</li>
    <li>Item B</li>
    <li>Item C</li>
    <li>Item D</li>
    <li>Item E</li>
</ul>
<p id="msg"></p> --}}