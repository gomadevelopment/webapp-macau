<div class="row">

    <?php $students_with_exames_evaluated = false; ?>

    @foreach ($students_exames_evaluated as $student)
        @if(!$student->exames_evaluated->count())
            <?php $students_with_exames_evaluated = $students_with_exames_evaluated ? true : false; ?>
            @continue
        @else
            <?php $students_with_exames_evaluated = true; ?>

            <div class="col-lg-12 col-md-12 col-sm-12">
                
                <div class="shop_grid_caption card-body m-0 mb-4">
                    <div class="form-group d-flex flex-wrap justify-content-center m-0">
                        <img src="{{ $student->avatar_url ? '/webapp-macau-storage/avatars/'.$student->id.'/'.$student->avatar_url : 'https://via.placeholder.com/500x500'}}" alt="" class="colleagues_round_avatar mr-3" style="max-width: 80px;">
                        <h4 class="sg_rate_title align-self-center m-0">
                            {{ $student->first_name && $student->last_name ? $student->first_name . ' ' . $student->last_name : $student->username }}
                            <div class="d-flex flex-row">
                                <p class="exercise_author align-self-center class_label">
                                    <strong>Turma:</strong> {{ $student->student_class_user->student_class->name }}
                                    &nbsp;&nbsp;&nbsp;
                                </p>
                                <p class="exercise_author align-self-center">
                                    <strong>Exercícios:</strong> {{ $student->exames_evaluated->count() }}
                                </p>
                            </div>
                        </h4>
                        <br>
                        <a href="#collapse_student_{{ $student->id }}_exames_evaluated" class="ml-auto align-self-center expand_accordion collapsed"  data-toggle="collapse" data-parent="#accordion">
                            <span>Expandir</span>
                            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_black.svg')}}" class="expand_chevron" alt="">
                            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_up_pink.svg')}}" class="collapse_chevron" alt="">
                        </a>
                    </div>

                    <div id="collapse_student_{{ $student->id }}_exames_evaluated" class="collapse" data-parent="#accordion">

                        @foreach ($student->exames_evaluated as $exame)

                            <?php
                                $exercise_sum_score_points = $exame->questions->sum('avaliation_score');
                                $exercise_student_score = $exame->questions->sum('classification');
                                $score_perc = $exercise_sum_score_points == 0 ? 0 : round(($exercise_student_score / $exercise_sum_score_points) * 100);

                                $score_perc_class = '';
                                if($score_perc < 33.3){
                                    $score_perc_class = 'low_score';
                                }
                                else if($score_perc >= 33.3 && $score_perc < 66.6){
                                    $score_perc_class = 'med_score';
                                }
                                else{
                                    $score_perc_class = 'high_score';
                                }
                            ?>

                            <div class="mt-4" style="display: flow-root;">
                                <h4 class="sg_rate_title">{{ $exame->title }}</h4>
                                <div class="d-flex float-left flex-column">
                                    <p class="exercise_author">
                                        <strong>Nível:</strong> {{ $exame->level->name }}
                                        @if($exame->finish_date)
                                            <strong>&nbsp;&nbsp;&nbsp;Data de Conclusão:</strong> {{ date('d/m/Y', strtotime($exame->finish_date)) }}
                                        @endif
                                    </p>
                                    <p class="exercise_level" style="float: left; margin-right: 20px;">
                                        <strong>Avaliação:</strong> <strong class="{{ $score_perc_class }}"> {{ $score_perc }}%</strong>
                                    </p>
                                </div>
                            </div>

                            @if(!$loop->last)
                                <hr>
                            @endif
                            
                        @endforeach
                            
                    </div>
                        
                </div>
                
            </div>
        @endif
    @endforeach
    
    @if(!$students_with_exames_evaluated)
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="shop_grid">
                <div class="shop_grid_caption">
                    <h4 class="sg_rate_title" style="font-size: 20px;">
                        Não foram encontrados alunos com exercícios avaliados.
                    </h4>
                </div>
            </div>
        </div>
    @endif
    
</div>

<!-- Row -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        
        <!-- Pagination -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                {{ $students_exames_evaluated->links('layouts.pagination-macau') }}
                
            </div>
        </div>
        
    </div>
</div>
<!-- /Row -->