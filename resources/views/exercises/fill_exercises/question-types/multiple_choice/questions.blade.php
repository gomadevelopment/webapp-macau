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
                <label class="label_title mt-3 mb-1 d-block">
                    Questão {{ $loop->index + 1 }}
                </label>
                <p class="exercise_author">
                    {{ $item->text_1 }}
                </p>

                <div class="mt-3">

                    <select name="{{$question->id}}_multiple_choice_questions[{{$item->id}}]" id="m_c_questions_select_question_item_{{$item->id}}">
                        @for ($i = 0; $i < $item->options_number; $i++)
                            <?php $option = "options_".($i+1); ?>

                            <option value="{{ $i + 1 }}">{{ $item->$option }}</option>

                        @endfor
                    </select>

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