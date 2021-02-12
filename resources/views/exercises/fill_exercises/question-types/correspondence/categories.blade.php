{{-- Frases --}}
<div class="row mt-5">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <label class="label_title d-block mb-1" style="font-size: 30px;">
            Frases </label>
        </div>
    </div>

    @foreach ($question->question_items->shuffle() as $item)
        <?php $highest_options_number = isset($highest_options_number) && $highest_options_number > $item->options_number ? $highest_options_number : $item->options_number; ?>
        
        @for ($i = 0; $i < $item->options_number; $i++)

            <?php $option = "options_".($i+1); ?>
            <?php $shuffle_categories_options[] = $item->$option; ?>

        @endfor

        <?php shuffle($shuffle_categories_options); ?>

        @foreach($shuffle_categories_options as $shuffled_option)

            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                    <div class="drag_and_drop_hole origin_hole drop">
                        <div class="drag_and_drop_item p-2 correspondence_items">
                            {{ $shuffled_option }}
                            <input type="hidden" name="" value="{{ $shuffled_option }}">
                        </div>
                    </div>
                        
                </div>
            </div>

        @endforeach

        <?php $shuffle_categories_options = []; ?>
        
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

    @foreach ($question->question_items as $item)
        
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group mb-0 mt-3">
                <label class="label_title mb-0 d-block">
                    {{ $item->text_1 }} </label>
            </div>
        </div>

        @for ($i = 0; $i < $item->options_number; $i++)
        
            <input type="hidden" name="{{$question->id}}_correspondence_categories[{{ $item->id }}][]" class="correspondence_d_and_d" data-item-id="">

            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                    <div class="drag_and_drop_hole drop mt-3">

                    </div>
                </div>
            </div>

        @endfor

    @endforeach

</div>