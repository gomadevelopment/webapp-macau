@if (session('success'))
    <div class="global-alert alert alert-success" role="alert">
        {{session('success')}}
    </div>
@endif
@if (session('error'))
    <div class="global-alert alert alert-danger" role="alert">
        {{session('error')}}
    </div>
@endif

@if (session('ErrorException'))
    <div class="global-alert alert alert-danger" role="alert">
        {{session('ErrorException')}}
    </div>
@endif

<div class="alert alert-success successMsg global-alert" style="display:none;" role="alert">

</div>

<div class="alert alert-danger errorMsg global-alert" style="display:none;" role="alert">

</div>

<div class="row">
    @if ($exercises->isEmpty())
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="shop_grid">
                <div class="shop_grid_caption">
                    <h4 class="sg_rate_title" style="font-size: 20px;">
                        Não foram encontrados exercícios com os filtros aplicados.
                    </h4>
                </div>
            </div>
        </div>
    @else

        @foreach ($exercises as $exercise)

            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="shop_grid_caption card-body m-0 mb-4 pb-2">
                    {{-- Like buttons heart/heart_filled --}}
                    <img class="heart_icon" src="{{asset('/assets/backoffice_assets/icons/Heart.svg', config()->get('app.https'))}}?v=2.4"  style="top: 20px; right: 20px; display: {{ $exercise->is_exercise_favorite ? 'none;' : 'block;' }}"
                        alt="" data-exercise-id="{{ $exercise->id }}">
                    <img class="heart_filled_icon" src="{{asset('/assets/backoffice_assets/icons/Heart_filled.svg', config()->get('app.https'))}}?v=2.4"  style="top: 20px; right: 20px; display: {{ $exercise->is_exercise_favorite ? 'block;' : 'none;' }}"
                        alt="" style="display: none;" data-exercise-id="{{ $exercise->id }}">
                    <p class="exercise_level not_published_exercise">{{ $exercise->published ? '' : 'Exercício não publicado.' }}</p>
                    <h4 class="sg_rate_title">{{ $exercise->title }}</h4>
                    <div class="d-flex float-left flex-column">
                        <p class="exercise_author">
                            <strong>Professor:</strong> 
                            <a href="/perfil/{{ $exercise->user->id }}" class="professor_link">
                                {{ $exercise->user->username }} 
                                <img src="{{asset('/assets/backoffice_assets/icons/eye_outline.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin: 0 0 2px 3px;">
                            </a> 
                        </p>
                        <p class="exercise_level" style="float: left; margin-right: 20px;">
                            <strong>Nível:</strong> {{ $exercise->level->name }} &nbsp;&nbsp;&nbsp;
                            @if(auth()->user()->isProfessor() && auth()->user()->isActive() && $exercise->evaluation_median != 'no_exames_yet')
                                <strong>Média de Avaliação:</strong> {{ $exercise->evaluation_median }}%
                            @endif
                        </p>
                    </div>
                    @if(auth()->user()->isProfessor() && auth()->user()->isActive())
                        <div class="d-block float-right mt-3">
                            @if (auth()->user()->id == $exercise->user->id)
                                <a href="/exercicios/editar/{{ $exercise->id }}" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Pencil.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                    Editar
                                </a>
                            @else
                                <a href="/exercicios/detalhe/{{ $exercise->id }}" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Eye.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                    Visualizar
                                </a>
                            @endif
                            @if(auth()->user()->id == $exercise->user->id)
                                <a href="#" class="btn btn-theme remove_button remove_exercise" 
                                style="float: none; padding: 14px 20px; margin-left: 15px;" data-exercise-id="{{ $exercise->id }}">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px;">
                                    Remover
                                </a>
                            @endif
                            @if($exercise->can_clone)
                                <a href="#" class="btn btn-theme clone_button" style="float: none; padding: 12px 20px; margin-left: 15px;" data-exercise-id="{{ $exercise->id }}">
                                    <img src="{{asset('/assets/backoffice_assets/icons/clone.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                    Clonar
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="d-block float-right mt-3">
                            <a href="/exercicios/realizar/{{ $exercise->id }}" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;"
                                {{ auth()->user()->hasExerciseInProgress($exercise->id) == 'no_exame_started' ? '' : 'hidden' }}>
                                <img src="{{asset('/assets/backoffice_assets/icons/play.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Iniciar Exercício
                            </a>
                            <a href="/exercicios/realizar/{{ $exercise->id }}" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;"
                                {{ auth()->user()->hasExerciseInProgress($exercise->id) != 'no_exame_started' && auth()->user()->hasExerciseInProgress($exercise->id) != 'has_exame_finished' ? '' : 'hidden' }}>
                                <img src="{{asset('/assets/backoffice_assets/icons/play.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Retomar Exercício
                            </a>
                            <a href="/exercicios/realizar/{{ $exercise->id }}" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;"
                                {{ auth()->user()->hasExerciseInProgress($exercise->id) == 'has_exame_finished' ? '' : 'hidden' }}>
                                <img src="{{asset('/assets/backoffice_assets/icons/Eye.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Rever Exercício
                            </a>
                            <a href="#" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_white.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Notificar Professor
                            </a>
                        </div>
                    @endif
                    
                    @if($exercise->introduction || $exercise->exercise_tags->count())
                        <hr style="margin-top: 6rem;">
                    @endif

                    @if($exercise->introduction)
                        <h4 class="sg_rate_title">Resumo</h4>

                        <div class="article_description" style="margin-top: 15px;">
                            {!! $exercise->introduction !!}
                        </div>
                    @endif
                    
                    @foreach ($exercise->exercise_tags as $tag)
                        <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                            <p>{{ $tag->name }}</p>
                        </div>
                    @endforeach

                    @if($exercise->only_my_students)
                        <div class="available_tooltip_text">
                            <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg', config()->get('app.https'))}}?v=2.4" data-toggle="tooltip" 
                                title="Apenas disponível para alunos do professor autor deste exercício." 
                                alt="" style="margin-bottom: 3px; margin-right: 5px;"> 
                            Disponível só para os meus Alunos
                        </div>
                    @endif
                        
                </div>
                
            </div>
        @endforeach
    
    @endif
    
</div>

<!-- Row -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        
        <!-- Pagination -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                {{ $exercises->appends($inputs)->links('layouts.pagination-macau') }}
                
            </div>
        </div>
        
    </div>
</div>
<!-- /Row -->
