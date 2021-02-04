<div class="row mb-4">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group" style="text-align: -webkit-center;">
            <label class="label_title mt-3 mb-1 d-block" style="font-size:30px;">
                Textos
            </label>
        </div>
    </div>
    
    @foreach ($question->question_items as $item)
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group" style="text-align: -webkit-center;">

                <div class="mt-3">

                    <textarea class="form-control" name="" id="" cols="30" rows="5">{{ $item->text_1 }}</textarea>

                </div>
            </div>
        </div>

    @endforeach
</div>