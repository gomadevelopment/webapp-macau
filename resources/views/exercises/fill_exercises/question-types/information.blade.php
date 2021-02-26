<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <label class="label_title d-block" style="font-size: 30px;">
            Texto Informativo </label>
        </div>
    </div>

    @foreach ($question->question_items as $item)

        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">

                <div class="exercise_question_description question_info_text_type">
                    {!! $item->text_1 !!}
                </div>

            </div>
        </div>

    @endforeach
</div>