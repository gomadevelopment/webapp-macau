<div class="row mb-4">

    @foreach ($question->question_items->shuffle() as $item)

        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="form-group" style="text-align: -webkit-center;">
                <div class="drag_and_drop_image text-center">
                    @if(!$item->question_item_media)

                    @else
                        @if(explode('/', $item->question_item_media->media_type)[0] == 'audio')
                            <audio controls>
                                <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                            </audio>
                        @elseif(explode('/', $item->question_item_media->media_type)[0] == 'video')
                            <video controls>
                                <source src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" type="{{ $item->question_item_media->media_type }}">
                            </video>
                        @else

                        @endif
                    @endif
                </div>
                <input type="hidden" name="{{$question->id}}_correspondence_audios[{{ $item->question_item_media->id }}]" class="correspondence_d_and_d" data-item-id="">
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

                    <div class="drag_and_drop_item p-2 correspondence_items">
                        {{ $item->text_1 }}
                        <input type="hidden" name="" value="{{ $item->id }}">
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