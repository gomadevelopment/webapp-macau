<div class="row mb-4">

    @foreach ($question->question_items as $item)
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group" style="text-align: -webkit-center;">
                <label class="label_title mt-3 mb-1 d-block" style="font-size:30px;">
                    Conjunto de Palavras/Excertos {{ $loop->index + 1 }}
                </label>

                @for ($i = 0; $i < $item->options_number; $i++)
                    <?php $option = "options_".($i+1); ?>
                    <?php $shuffled_array[] = $item->$option; ?>
                @endfor

                <?php shuffle($shuffled_array); ?>

                <label class="label_title mt-3 mb-1 d-block word_preview" style="border-radius: 5px; border: 2px solid #e6ebf1; padding: 10px; width: fit-content;">
                    
                    @foreach ($shuffled_array as $shuffled_option)
                        {{ $shuffled_option }} &nbsp;
                    @endforeach

                </label>

                <ul id="assortment_words_table_question_item_{{ $item->id }}" class="assortment_tables" cellspacing="0" cellpadding="2">

                    @foreach ($shuffled_array as $shuffled_option)

                        <li>
                            <img src="{{asset('/assets/backoffice_assets/icons/Drag_black.svg')}}" alt="">
                            <span>{{ $shuffled_option }}</span>
                        </li>

                    @endforeach

                    <?php $shuffled_array = []; ?>

                </ul>

            </div>
        </div>

    @endforeach

</div>