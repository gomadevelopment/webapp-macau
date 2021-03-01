<div class="row mb-5">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card-body">

            <?php
                if($exame_review){
                    $exercise_sum_score_points = $exame->questions->sum('avaliation_score');
                    $exercise_student_score = $exame->questions->sum('classification');
                    $score_percentage = $exercise_sum_score_points == 0 ? 0 : round(($exercise_student_score / $exercise_sum_score_points) * 100);
                    $score_label = 'Nota: ';
                    $score_percentage_class = '';
                    if($score_percentage < 33.3){
                        $score_percentage_class = 'low_score';
                    }
                    else if($score_percentage >= 33.3 && $score_percentage < 66.6){
                        $score_percentage_class = 'med_score';
                    }
                    else{
                        $score_percentage_class = 'high_score';
                    }

                    foreach($exame->questions as $question){
                        if($question->teacher_correction){
                            $score_label = 'Nota Provisória: ';
                            $score_percentage_class = 'exercise_awaiting';
                            break;
                        }
                    }
                }
            ?>

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label class="label_title d-block text-center mt-5" style="font-size: 37px;">
                            Obrigado pela participação! </label>
                    </div>
                                    
                    <div class="d-flex flex-column">
                        <p class="exercise_author text-center mt-3" style="font-size: 22px;">
                        <strong style="font-size: 22px;">Data de Conclusão:&nbsp;</strong> <span id="conclusion_date_label"> {{ $exame_review ? date('d/m/Y', strtotime($exame->created_at)) : '' }}</span>
                        </p>
                        <p class="exercise_author text-center mt-3">
                            <strong id="score_label" style="font-size: 30px;">{{ $exame_review ? $score_label : '' }}</strong>
                            &nbsp;
                            <strong id="score_percentage" class="{{ $exame_review ? $score_percentage_class : '' }}" style="font-size: 27px; line-height: 67.2px; border-radius: 5px; padding: 10px 20px 8px 20px;">
                                {{ $exame_review ? $score_percentage . '%' : '' }}
                            </strong>
                        </p>
                    </div>
                </div>
            </div>

            <div class="d-block text-center mt-4 mb-4">
                <a href="/exercicios" class="btn btn-theme remove_button m-2" style="float: none; padding: 15px 25px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/icon_View_Exercises.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                    Ver Exercícios
                </a>
                <a href="/sala_de_aula" class="btn search-btn comment_submit m-2" style="float: none; padding: 15px 25px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Book.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                    Sala de Aula
                </a>
                @if(!$exame_review)
                    <a href="/exercicios/realizar/{{ $exercise->id }}" class="btn search-btn comment_submit m-2" style="float: none; padding: 15px 25px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Eye.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Rever Exercício
                    </a>
                @endif
            </div>

            @if($exame->audio_transcript)
                <div class="row">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label class="label_title mb-3 d-block text-center">
                                Transcrição Áudio</label>
                            <div class="d-flex float-left flex-column shop_grid_caption ml-0">
                                <div class="article_description m-0 mb-1" style="line-height: 25px; -webkit-line-clamp: unset;">
                                    {!! $exame->audio_transcript !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

        </div>
    </div>
</div>