<div class="row mb-4">

    @foreach ($question->question_items as $item)
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group" style="text-align: -webkit-center;">
                <label class="label_title mt-3 mb-1 d-block" style="font-size:30px;">
                    Conjunto de Palavras {{ $loop->index + 1 }}
                </label>
                <label class="label_title mt-3 mb-1 d-block" style="border-radius: 5px; border: 2px solid #e6ebf1; padding: 10px;">

                    @for ($i = 0; $i < $item->options_number; $i++)
                        <?php $option = "options_".($i+1); ?>

                        @if($i == 0)
                            {{ $item->$option }}
                        @else
                            &nbsp; - &nbsp; {{ $item->$option }}
                        @endif

                    @endfor

                </label>

            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group" style="text-align: -webkit-center;">

                <select name="m_c_intruder_select_question_item_{{$item->id}}" id="m_c_intruder_select_question_item_{{$item->id}}">
                    @for ($i = 0; $i < $item->options_number; $i++)
                        <?php $option = "options_".($i+1); ?>

                        <option value="{{ $option }}">{{ $item->$option }}</option>

                    @endfor
                </select>

            </div>
        </div>

    @endforeach
</div>