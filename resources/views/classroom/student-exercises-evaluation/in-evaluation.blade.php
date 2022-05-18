<div class="row">

    @foreach ($student_in_evaluation_exames as $exame)

        <?php
            $exercise_sum_score_points = $exame->questions->sum('avaliation_score');
            $exercise_student_score = $exame->questions->sum('classification');
            $score_perc = $exercise_sum_score_points == 0 ? 0 : round(($exercise_student_score / $exercise_sum_score_points) * 100);
        ?>
        
        <div class="col-lg-12 col-md-12 col-sm-12">
                
            <div class="shop_grid_caption card-body m-0 mb-4">
                <h4 class="sg_rate_title">{{ $exame->title }}</h4>
                <div class="d-flex float-left flex-column">
                    <p class="exercise_author">
                        <strong>Nível:</strong> {{ $exame->level->name }}
                        @if($exame->finish_date)
                            <strong>&nbsp;&nbsp;&nbsp;Data de Conclusão:</strong> {{ date('d/m/Y', strtotime($exame->finish_date)) }}
                        @endif
                    </p>
                    <p class="exercise_level m-0" style="float: left; margin-right: 20px;">
                        <strong>Avaliação Provisória:&nbsp;</strong> <strong class="exercise_awaiting"> {{ $score_perc }}% </strong>
                    </p>
                </div>
                @if(auth()->user()->studentCanRequestExameCorrection($exame->id))
                    <div class="d-block float-right mt-3">
                        <a href="/notify/exame_requires_evaluation/{{ $exame->id }}" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_white.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                            Notificar Professor
                        </a>
                    </div>
                @endif
                    
            </div>
            
        </div>

    @endforeach

    @if(!$student_in_evaluation_exames->count())
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="shop_grid">
                <div class="shop_grid_caption">
                    <h4 class="sg_rate_title" style="font-size: 20px;">
                        Não foram encontrados exercícios em avaliação.
                    </h4>
                </div>
            </div>
        </div>
    @endif

    {{-- <div class="col-lg-12 col-md-12 col-sm-12">
                
        <div class="shop_grid_caption card-body m-0 mb-4">
            <h4 class="sg_rate_title">Da Áustria para Macau</h4>
            <div class="d-flex float-left flex-column">
                <p class="exercise_author">
                    <strong>Nível:</strong> A1
                    <strong>&nbsp;&nbsp;&nbsp;Data de Conclusão:</strong> 24/10/2020
                </p>
                <p class="exercise_level m-0" style="float: left; margin-right: 20px;">
                    <strong>Avaliação Provisória:</strong> <strong class="exercise_awaiting"> 80%</strong>
                </p>
            </div>
            <div class="d-block float-right mt-3">
                <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/play.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                    Iniciar Exercício
                </a>
                <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/play.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                    Retomar
                </a>
                <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_white.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                    Notificar Professor
                </a>
            </div>
                
        </div>
        
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
                
        <div class="shop_grid_caption card-body m-0 mb-4">
            <h4 class="sg_rate_title">Da Áustria para Macau</h4>
            <div class="d-flex float-left flex-column">
                <p class="exercise_author">
                    <strong>Nível:</strong> A1
                    <strong>&nbsp;&nbsp;&nbsp;Data de Conclusão:</strong> 24/10/2020
                </p>
                <p class="exercise_level m-0" style="float: left; margin-right: 20px;">
                    <strong>Avaliação:</strong> Requer Avaliação Total pelo Professor
                </p>
            </div>
            <div class="d-block float-right mt-3">
                <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/play.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                    Iniciar Exercício
                </a>
                <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/play.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                    Retomar
                </a>
                <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_white.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                    Notificar Professor
                </a>
            </div>
                
        </div>
        
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
                
        <div class="shop_grid_caption card-body m-0 mb-4">
            <h4 class="sg_rate_title">Da Áustria para Macau</h4>
            <div class="d-flex float-left flex-column">
                <p class="exercise_author">
                    <strong>Nível:</strong> A1
                    <strong>&nbsp;&nbsp;&nbsp;Data de Conclusão:</strong> 24/10/2020
                </p>
                <p class="exercise_level m-0" style="float: left; margin-right: 20px;">
                    <strong>Avaliação Provisória:</strong> <strong class="exercise_awaiting"> 80%</strong>
                </p>
            </div>
            <div class="d-block float-right mt-3">
                <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/play.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                    Iniciar Exercício
                </a>
                <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/play.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                    Retomar
                </a>
                <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_white.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                    Notificar Professor
                </a>
            </div>
                
        </div>
        
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
                
        <div class="shop_grid_caption card-body m-0 mb-4">
            <h4 class="sg_rate_title">Da Áustria para Macau</h4>
            <div class="d-flex float-left flex-column">
                <p class="exercise_author">
                    <strong>Nível:</strong> A1
                    <strong>&nbsp;&nbsp;&nbsp;Data de Conclusão:</strong> 24/10/2020
                </p>
                <p class="exercise_level m-0" style="float: left; margin-right: 20px;">
                    <strong>Avaliação:</strong> Requer Avaliação Total pelo Professor
                </p>
            </div>
            <div class="d-block float-right mt-3">
                <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/play.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                    Iniciar Exercício
                </a>
                <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/play.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                    Retomar
                </a>
                <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_white.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                    Notificar Professor
                </a>
            </div>
                
        </div>
        
    </div> --}}
</div>

<!-- Row -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        
        <!-- Pagination -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                {{ $student_in_evaluation_exames->links('layouts.pagination-macau') }}
                
            </div>
        </div>
        
    </div>
</div>
<!-- /Row -->
