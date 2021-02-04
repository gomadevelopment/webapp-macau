{{-- Frases --}}
<div class="row mt-5">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <label class="label_title d-block" style="font-size: 30px;">
            Frases </label>
        </div>
    </div>

    @foreach ($question->question_items->shuffle() as $item)
        <?php $highest_options_number = isset($highest_options_number) && $highest_options_number > $item->options_number ? $highest_options_number : $item->options_number; ?>
        @for ($i = 0; $i < $item->options_number; $i++)

            <?php $option = "options_".($i+1); ?>

            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                    <div class="drag_and_drop_hole origin_hole drop">
                        <div class="drag_and_drop_item p-2">
                            {{ $item->$option }}
                        </div>
                    </div>
                        
                </div>
            </div>

        @endfor
        
    @endforeach

</div>

{{-- Campos --}}
<div class="row mt-3">

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group mb-0">
            <label class="label_title d-block mb-4" style="font-size: 30px;">
            Categorias </label>
        </div>
    </div>

    @foreach ($question->question_items as $item)
        
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group mb-0 mt-3">
                <label class="label_title mb-0 d-block">
                    {{ $item->text_1 }} </label>
            </div>
        </div>

        @for ($i = 0; $i < $highest_options_number; $i++)

            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                    <div class="drag_and_drop_hole drop mt-3">

                    </div>
                </div>
            </div>

        @endfor

    @endforeach

</div>