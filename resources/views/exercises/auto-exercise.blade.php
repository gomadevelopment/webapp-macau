@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}?v=1.2">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}?v=1.2">

@stop

@section('content')

    <section class="page-title articles">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    
                    <div class="wrap">
                        <h1 class="title">Auto Exercício - Fronteira da Palavra ou Preenchimento de Espaços</h1>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0">
        <div class="container">

            <!-- Row -->
            <div class="row">
                
                <div class="col-12">
                    
                    <div class="shop_grid_caption card-body text-left m-0 mb-4">

                        <div class="form-group">

                            <label class="sg_rate_title split_words_textarea_label" style="display: none;">Separe as palavras</label>
                            <textarea class="form-control mb-2" name="" id="split_words_textarea" cols="30" rows="5" style="display: none;"></textarea>

                            <label class="sg_rate_title fill_spaces_label" style="display: none;">Preencha os espaços em branco com as palavras em falta</label>
                            <label class="label_title m-0 align-self-center fill_spaces p-2 mt-3 mb-3" style="font-size: 20px; border-radius: 5px; border: 2px solid #e6ebf1; display: none;">

                            </label>

                            <label class="sg_rate_title pasted_text_solution_label" style="display: none;">Solução</label>
                            <label class="sg_rate_title pasted_text_original_label">Texto Original</label>
                            <textarea class="form-control mb-2" name="" id="pasted_text" cols="30" rows="5" placeholder="Escreva ou cole aqui o seu texto..."></textarea>
                            <span class="error-block-span pink pasted_text"></span>
                            <span class="success-block-span pasted_text"></span>

                            <br>

                            <button type="button" id="generate_auto_exercise" class="btn search-btn comment_submit float-none mt-2 mr-3">
                                Gerar Exercício
                            </button>

                            <button type="button" id="submit_auto_exercise" class="btn search-btn comment_submit float-none mt-2 mr-3" style="display: none;">
                                Submeter
                            </button>

                            <button type="button" id="start_again_auto_exercise" class="btn search-btn comment_submit float-none mt-2">
                                Começar de novo
                            </button>

                        </div>

                    </div>

                </div>
            
            </div>
            <!-- Row -->
            
        </div>
    </section>

@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https')) }}?v=1.2"></script>
    {{-- <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https')) }}?v=1.2"></script> --}}
    <script src="{{asset('/assets/js/webapp-macau-custom-js/exercises.js', config()->get('app.https')) }}?v=1.2"></script>

    <script>

        $(function(){

            /* Find any element which has a 'data-onload' function and load that to simulate an onload. */
            $('[data-onload]').each(function(){
                eval($(this).data('onload'));
            });

            $('span.pasted_text').hide();

            var exercise_types = [
                'split_words',
                'fill_spaces'
            ];

            var which_exercise = exercise_types[Math.floor(Math.random()*exercise_types.length)];

            var words_selected = [];
            var words_inputed = [];

            // Generate Auto Exercicse
            $(document).on('click', '#generate_auto_exercise', function(e){
                e.preventDefault();

                var pasted_text = $('#pasted_text').val();

                if(pasted_text == '' || pasted_text.split(" ").length < 3){
                    $('span.pasted_text.pink').text('Por favor, escreva ou cole um texto válido com mais de duas palavras.').show();
                    return false;
                }

                $('span.pasted_text').hide();

                $('.pasted_text_original_label').hide();
                $('#pasted_text').hide();

                if(which_exercise == 'split_words'){
                    $('.split_words_textarea_label').show();
                    $('#split_words_textarea').text(pasted_text.replace(/\s/g, "")).val(pasted_text.replace(/\s/g, "")).show();
                }
                else if(which_exercise == 'fill_spaces'){

                    var words = pasted_text.split(" ");

                    var randWords = [],
                        lt = words.length;
                    // ("nº de palavras" / "(nº palavras / 5 +1)")
                    var loop_rang = Math.floor(Math.round(Math.log(lt) / Math.log(2)) + (lt / 50) - 1);

                    var indexes_used = [];
                    for (var i = 0; i < loop_rang; i++){

                        var new_index = Math.floor(Math.random() * (lt));
                        // console.log(new_index, words[new_index]);
                        if(indexes_used.includes(new_index)){
                            i--;
                        }
                        else{
                            words_selected.push(words[new_index]);
                            words[new_index] = '<input type="text" name="words_inputed[]" id="" ';
                            words[new_index] += 'class="form-control d-inline-flex mt-1 mb-1 words_inputed_class" ';
                            words[new_index] += 'style="vertical-align: middle; height: auto; padding: 5px 10px;" ';
                            words[new_index] += 'onkeypress="this.style.width = (this.value.length + 4) + '+'\'ch\''+';" ';
                            words[new_index] += 'data-onload="this.style.width = (this.value.length + 4) + '+'\'ch\''+';">';
                            indexes_used.push(new_index);
                        }
                    }

                    $('.fill_spaces').html(words.join(" ")).addClass('d-block').show();

                    $('[data-onload]').each(function(){
                        eval($(this).data('onload'));
                    });

                    $('.fill_spaces_label').addClass('d-block').show();
                }

                $(this).hide();
                $('#submit_auto_exercise').show();
            });

            // Start Again Auto Exercicse
            $(document).on('click', '#start_again_auto_exercise', function(e){
                e.preventDefault();

                console.log(which_exercise);

                if(!$('.split_words_textarea_label').is(':disabled')){
                    $('#pasted_text').attr('disabled', false).attr('value', '').val('').text('').show();
                    $('#split_words_textarea').attr('disabled', false).attr('value', '').val('').text('').hide();
                }
                else{
                    $('#pasted_text').attr('disabled', false).attr('value', '').val('').text('');
                    $('#split_words_textarea').attr('disabled', false).attr('value', '').val('').text('').hide();
                }

                $('span.pasted_text').hide();

                $('.pasted_text_original_label').show();
                $('.pasted_text_solution_label').hide();
                $('.split_words_textarea_label').hide();

                $('.fill_spaces').removeClass('d-block').hide();
                $('.fill_spaces_label').removeClass('d-block').hide();

                $('#submit_auto_exercise').hide();
                $('#generate_auto_exercise').show();

                which_exercise = exercise_types[Math.floor(Math.random()*exercise_types.length)];
                words_selected = [];
                words_inputed = [];
            });

            // Submit Auto Exercicse
            $(document).on('click', '#submit_auto_exercise', function(e){
                e.preventDefault();
                var pasted_text = $('#pasted_text').val();

                if(which_exercise == 'split_words'){
                    var student_input = $('#split_words_textarea').val();

                    if(pasted_text == student_input){
                        $('span.pasted_text:not(.pink)').text('Acertou em todas as palavras. Parabéns!').show();
                    }
                    else{
                        $('span.pasted_text.pink').text('Os textos não coincidem. Tente de novo!').show();
                    }

                    $('#split_words_textarea').attr('disabled', true).show();
                }
                else if(which_exercise == 'fill_spaces'){
                    
                    $('.words_inputed_class').each(function(index, element){
                        words_inputed.push($(element).val());
                        $(element).attr('disabled', true);
                    });

                    if(JSON.stringify(words_selected) == JSON.stringify(words_inputed)){
                        $('span.pasted_text:not(.pink)').text('Acertou em todas as palavras. Parabéns!').show();
                    }
                    else{
                        $('span.pasted_text.pink').text('Os textos não coincidem. Tente de novo!').show();
                    }
                }

                $('#pasted_text').attr('disabled', true).show();
                $('.pasted_text_solution_label').show();

                $('#submit_auto_exercise').hide();
                $('#generate_auto_exercise').hide();
            });

        });
    </script>

@stop