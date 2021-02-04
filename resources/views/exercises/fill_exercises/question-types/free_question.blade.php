<div class="row mb-4">

    @foreach ($question->question_items as $item)
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group" style="text-align: -webkit-center;">
                <label class="label_title mt-3 mb-1 d-block" style="font-size:30px;">
                    Questão {{ $loop->index + 1 }}
                </label>
                <label class="label_title mt-3 mb-1 d-block">
                    {{ $item->text_1 }}
                </label>

                <div class="mt-3">

                    <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>

                </div>
            </div>
        </div>

    @endforeach
</div>