

<div class="row mb-4">

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group" style="text-align: -webkit-center;">
            <label class="label_title mt-3 mb-1 d-block" style="font-size:30px;">
                Verdadeiro ou Falso
            </label>
        </div>
    </div>

    @foreach ($question->question_items as $item)
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group" style="text-align: -webkit-center;">

                <div id="" class="true_or_false_table" cellspacing="0" cellpadding="2">

                        @if($item->question_item_media)
                            <img src="{{ '/webapp-macau-storage/student_exames/'.$exame->student_id.'/exame/'.$exame->id.'/questions/'.$question->id.'/question_item/'.$item->id.'/'.$item->question_item_media->media_url }}" alt="" class="true_or_false_image">
                        @else

                        @endif
                        <p class="d-flex align-items-center mb-0 mr-3">{{ $item->text_1 }}</p>
                        
                        <select class="form-control" name="{{$question->id}}_true_or_false[{{$item->id}}]" id="true_or_false_select_question_item_{{$item->id}}">
                            <option value="true">Verdadeiro</option>
                            <option value="false">Falso</option>
                            <option value="not_said">Não dito</option>
                        </select>

                </div>

            </div>
        </div>
    @endforeach

</div>