<div class="row">

    @foreach ($student_done_exames as $exame)

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

        <div class="col-lg-12 col-md-12 col-sm-12">
                
            <div class="shop_grid_caption card-body m-0 mb-4">
                <h4 class="sg_rate_title">{{ $exame->title }}</h4>
                <div class="d-flex float-left">
                    <p class="exercise_level" style="float: left; margin-right: 20px;">
                        <strong>Nível:</strong> {{ $exame->level->name }}
                    </p>
                    <p class="exercise_level" style="float: left; margin-right: 20px;">
                        @if($exame->finish_date)
                            <strong>&nbsp;&nbsp;&nbsp;Data de Conclusão:</strong> {{ date('d/m/Y', strtotime($exame->finish_date)) }}
                        @endif
                    </p>
                    <p class="exercise_level" style="float: left; margin-right: 20px;">
                        <strong>Avaliação:&nbsp;</strong> <strong class="{{ $score_perc_class }}"> {{ $score_perc }}%</strong>
                    </p>
                </div>
                    
            </div>
            
        </div>

    @endforeach

    @if(!$student_done_exames->count())
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="shop_grid">
                <div class="shop_grid_caption">
                    <h4 class="sg_rate_title" style="font-size: 20px;">
                        Não foram encontrados exercícios concluídos.
                    </h4>
                </div>
            </div>
        </div>
    @endif

    {{-- <div class="col-lg-12 col-md-12 col-sm-12">
                
        <div class="shop_grid_caption card-body m-0 mb-4">
            <h4 class="sg_rate_title">Da Áustria para Macau</h4>
            <div class="d-flex float-left">
                <p class="exercise_level" style="float: left; margin-right: 20px;">
                    <strong>Nível:</strong> A1
                </p>
                <p class="exercise_level" style="float: left; margin-right: 20px;">
                    <strong>Data de Conclusão:</strong> 24/10/2020
                </p>
                <p class="exercise_level" style="float: left; margin-right: 20px;">
                    <strong>Avaliação:</strong> <strong class="exercise_complete"> 100%</strong>
                </p>
            </div>
            @if(auth()->user()->isProfessor() && auth()->user()->isActive())
                <div class="d-block float-right mt-3">
                    <a href="#" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Eye.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Visualizar
                    </a>
                    <a href="#" class="btn btn-theme remove_button" style="float: none; padding: 14px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 5px;">
                        Remover
                    </a>
                    <a href="#" class="btn btn-theme clone_button" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/clone.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Clonar
                    </a>
                </div>
            @else
                <div class="d-block float-right mt-3">
                    <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Iniciar Exercício
                    </a>
                    <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Retomar
                    </a>
                    <a href="#" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_white.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Notificar Professor
                    </a>
                </div>
            @endif
                
        </div>
        
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
                
        <div class="shop_grid_caption card-body m-0 mb-4">
            <h4 class="sg_rate_title">Da Áustria para Macau</h4>
            <div class="d-flex float-left">
                <p class="exercise_level" style="float: left; margin-right: 20px;">
                    <strong>Nível:</strong> A1
                </p>
                <p class="exercise_level" style="float: left; margin-right: 20px;">
                    <strong>Data de Conclusão:</strong> 24/10/2020
                </p>
                <p class="exercise_level" style="float: left; margin-right: 20px;">
                    <strong>Avaliação:</strong> <strong class="exercise_complete"> 100%</strong>
                </p>
            </div>
            @if(auth()->user()->isProfessor() && auth()->user()->isActive())
                <div class="d-block float-right mt-3">
                    <a href="#" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Eye.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Visualizar
                    </a>
                    <a href="#" class="btn btn-theme remove_button" style="float: none; padding: 14px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 5px;">
                        Remover
                    </a>
                    <a href="#" class="btn btn-theme clone_button" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/clone.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Clonar
                    </a>
                </div>
            @else
                <div class="d-block float-right mt-3">
                    <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Iniciar Exercício
                    </a>
                    <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Retomar
                    </a>
                    <a href="#" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_white.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Notificar Professor
                    </a>
                </div>
            @endif
                
        </div>
        
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
                
        <div class="shop_grid_caption card-body m-0 mb-4">
            <h4 class="sg_rate_title">Da Áustria para Macau</h4>
            <div class="d-flex float-left">
                <p class="exercise_level" style="float: left; margin-right: 20px;">
                    <strong>Nível:</strong> A1
                </p>
                <p class="exercise_level" style="float: left; margin-right: 20px;">
                    <strong>Data de Conclusão:</strong> 24/10/2020
                </p>
                <p class="exercise_level" style="float: left; margin-right: 20px;">
                    <strong>Avaliação:</strong> <strong class="exercise_complete"> 100%</strong>
                </p>
            </div>
            @if(auth()->user()->isProfessor() && auth()->user()->isActive())
                <div class="d-block float-right mt-3">
                    <a href="#" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Eye.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Visualizar
                    </a>
                    <a href="#" class="btn btn-theme remove_button" style="float: none; padding: 14px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 5px;">
                        Remover
                    </a>
                    <a href="#" class="btn btn-theme clone_button" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/clone.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Clonar
                    </a>
                </div>
            @else
                <div class="d-block float-right mt-3">
                    <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Iniciar Exercício
                    </a>
                    <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Retomar
                    </a>
                    <a href="#" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_white.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Notificar Professor
                    </a>
                </div>
            @endif
                
        </div>
        
    </div> --}}
</div>

<!-- Row -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        
        <!-- Pagination -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                {{ $student_done_exames->links('layouts.pagination-macau') }}
                
            </div>
        </div>
        
    </div>
</div>
<!-- /Row -->