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

                @foreach ($question->question_items->shuffle() as $item)

                    <li>
                        <img src="{{asset('/assets/backoffice_assets/icons/Drag_black.svg')}}" alt="">
                        @if($item->question_item_media)
                            <img src="{{ '/webapp-macau-storage/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" alt="" class="assort_image">
                        @else

                        @endif
                        <span class="d-flex align-items-center">{{ $item->text_1 }}</span>
                        <input type="hidden" name="{{$question->id}}_assortment_images[]" value="{{ $item->id }}" class="assortment_d_and_d" data-item-id="">
                    </li>

                @endforeach

            </ul>

        </div>
    </div>

</div>