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
                    <div class="drag_and_drop_item p-2 true_or_false_items">
                        {{ $item->text_1 }}
                        <input type="hidden" name="" value="{{ $item->id }}">
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

    <?php $true_sentences = $false_sentences = $not_said_sentences = 0; ?>

    @foreach ($question->question_items as $item)
        <?php
            if($item->options_correct == "true"){
                $true_sentences++;
            }
            else if($item->options_correct == "false"){
                $false_sentences++;
            }
            else if($item->options_correct == "not_said"){
                $not_said_sentences++;
            }
        ?>
    @endforeach

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group mb-0 mt-3">
            <label class="label_title mb-0 d-block">
                Verdadeiro </label>
        </div>
    </div>

    @for ($i = 0; $i < $true_sentences; $i++)

        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <input type="hidden" name="{{$question->id}}_true_or_false[true][]" class="true_or_false_d_and_d" data-item-id="">
                <div class="drag_and_drop_hole drop mt-3">

                </div>
            </div>
        </div>

    @endfor

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group mb-0 mt-3">
            <label class="label_title mb-0 d-block">
                Falso </label>
        </div>
    </div>

    @for ($i = 0; $i < $false_sentences; $i++)

        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <input type="hidden" name="{{$question->id}}_true_or_false[false][]" class="true_or_false_d_and_d" data-item-id="">
                <div class="drag_and_drop_hole drop mt-3">

                </div>
            </div>
        </div>

    @endfor

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group mb-0 mt-3">
            <label class="label_title mb-0 d-block">
                Não dito </label>
        </div>
    </div>

    @for ($i = 0; $i < $not_said_sentences; $i++)

        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <input type="hidden" name="{{$question->id}}_true_or_false[not_said][]" class="true_or_false_d_and_d" data-item-id="">
                <div class="drag_and_drop_hole drop mt-3">

                </div>
            </div>
        </div>

    @endfor

</div>