<div class="form-group to_choose information">

    <form id="form-information" class="question-form" action=""  enctype="multipart/form-data">
        @csrf

        <label class="label_title mb-3" style="font-size: 30px;">
            Texto Informativo </label>
        <div class="row">
            <div class="col-12">
                <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01); width: -webkit-fill-available !important;">
                    <textarea class="form-control" name="info_text" id="info_text" cols="30" rows="10">{!! isset($question) && $question->question_type->id == 1 ? $question->question_items->first()->text_1 : '' !!}</textarea>
                </div>
            </div>
        </div>

    </form>

</div>