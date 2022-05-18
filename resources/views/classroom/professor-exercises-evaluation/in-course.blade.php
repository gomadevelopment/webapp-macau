<div class="row">

    <?php $students_with_exames_in_course = false; ?>

    @foreach ($students_exames_in_course as $student)
        @if(!$student->exames_in_course->count())
            <?php $students_with_exames_in_course = $students_with_exames_in_course ? true : false; ?>
            @continue
        @else
            <?php $students_with_exames_in_course = true; ?>

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
                                    <strong>Exercícios:</strong> {{ $student->exames_in_course->count() }}
                                </p>
                            </div>
                        </h4>
                        <br>
                        <a href="#collapse_student_{{ $student->id }}_exames_in_course" class="ml-auto align-self-center expand_accordion collapsed"  data-toggle="collapse" data-parent="#accordion">
                            <span>Expandir</span>
                            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_black.svg', config()->get('app.https'))}}?v=2.4" class="expand_chevron" alt="">
                            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_up_pink.svg', config()->get('app.https'))}}?v=2.4" class="collapse_chevron" alt="">
                        </a>
                    </div>

                    <div id="collapse_student_{{ $student->id }}_exames_in_course" class="collapse" data-parent="#accordion">

                        @foreach ($student->exames_in_course as $exame)

                            <?php
                                $exercise_sum_score_points = $exame->questions->sum('avaliation_score');
                                $exercise_student_score = $exame->questions->sum('classification');
                                $score_perc = $exercise_sum_score_points == 0 ? 0 : round(($exercise_student_score / $exercise_sum_score_points) * 100);
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
                                    {{-- <p class="exercise_level" style="float: left; margin-right: 20px;">
                                        <strong>Avaliação Provisória:&nbsp;</strong> <strong class="exercise_awaiting"> {{ $score_perc }}%</strong>
                                    </p> --}}
                                </div>
                                {{-- <div class="d-block float-right mt-3">
                                    <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Graph_Pie.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                        Avaliar
                                    </a>
                                </div> --}}
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
    
    @if(!$students_exames_in_course->count())
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="shop_grid">
                <div class="shop_grid_caption">
                    <h4 class="sg_rate_title" style="font-size: 20px;">
                        Não foram encontrados alunos com exercícios em curso.
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

                {{ $students_exames_in_course->links('layouts.pagination-macau') }}
                
            </div>
        </div>
        
    </div>
</div>
<!-- /Row -->
