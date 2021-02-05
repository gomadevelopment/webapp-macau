{{-- Frases --}}
<div class="row mt-5">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <label class="label_title d-block mb-1" style="font-size: 30px;">
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

{{-- Campos --}}
<div class="row mt-3">

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group mb-0">
            <label class="label_title d-block mb-1" style="font-size: 30px;">
            Categorias </label>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group mb-0 mt-3">
            <label class="label_title mb-0 d-block">
                Verdadeiro </label>
        </div>
    </div>

    @foreach ($question->question_items as $item)

        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <div class="drag_and_drop_hole drop mt-3">

                </div>
            </div>
        </div>

    @endforeach

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group mb-0 mt-3">
            <label class="label_title mb-0 d-block">
                Falso </label>
        </div>
    </div>

    @foreach ($question->question_items as $item)

        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <div class="drag_and_drop_hole drop mt-3">

                </div>
            </div>
        </div>

    @endforeach

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group mb-0 mt-3">
            <label class="label_title mb-0 d-block">
                Não dito </label>
        </div>
    </div>

    @foreach ($question->question_items as $item)

        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <div class="drag_and_drop_hole drop mt-3">

                </div>
            </div>
        </div>

    @endforeach

</div>