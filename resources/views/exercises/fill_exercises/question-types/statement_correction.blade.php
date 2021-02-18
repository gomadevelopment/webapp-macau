<div class="row mb-4">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group" style="text-align: -webkit-center;">
            <label class="label_title mt-3 mb-1 d-block" style="font-size:30px;">
                Afirmações
            </label>
        </div>
    </div>
    
    @foreach ($question->question_items as $item)
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group" style="text-align: -webkit-center;">

                <input class="form-control" type="text" name="{{$question->id}}_statement_correction[{{$item->id}}]" id="" value="{{ $item->text_1 }}">

            </div>
        </div>

    @endforeach
</div>