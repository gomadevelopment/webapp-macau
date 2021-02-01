<div class="wrap mb-3">
    <h1 class="title">Exercícios promovidos pelo Utilizador</h1>
</div>
@if ($promoted_exercises->isEmpty())
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="shop_grid">
            <div class="shop_grid_caption">
                <h4 class="sg_rate_title" style="font-size: 20px;">
                    Não foram encontrados exercícios promovidos pelo professor {{ $user->username }}.
                </h4>
            </div>
        </div>
    </div>
@else
    @foreach ($promoted_exercises as $exercise)
        <div class="shop_grid_caption card-body m-0 mb-4">
            <p class="exercise_level not_published_exercise mr-0">{{ $exercise->published ? '' : 'Exercício não publicado.' }}</p>
            <h4 class="sg_rate_title">{{ $exercise->title }}</h4>
            <div class="d-flex float-left flex-column">
                @if (auth()->user()->id == $exercise->user->id)
                    <p class="exercise_author">
                        <strong>Professor:</strong> 
                        {{ $exercise->user->username }} 
                    </p>
                @else
                    <p class="exercise_author">
                        <strong>Professor:</strong> 
                        <a href="/perfil/{{ $exercise->user->id }}" class="professor_link">
                            {{ $exercise->user->username }} 
                            <img src="{{asset('/assets/backoffice_assets/icons/eye_outline.svg')}}" alt="" style="margin: 0 0 2px 3px;">
                        </a> 
                    </p>
                @endif
                <p class="exercise_level" style="float: left; margin-right: 20px;">
                    <strong>Nível:</strong> {{ $exercise->level->name }} &nbsp;&nbsp;&nbsp;
                    @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)
                        <strong>Média de Avaliação:</strong> 62%
                    @endif
                </p>
            </div>

            @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)
                <div class="d-block float-right mt-3">
                    @if (auth()->user()->id == $exercise->user->id)
                        <a href="/exercicios/editar/{{ $exercise->id }}" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Pencil.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                            Editar
                        </a>
                    @else
                        <a href="/exercicios/detalhe/{{ $exercise->id }}" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Eye.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                            Visualizar
                        </a>
                    @endif
                </div>
            @endif
            

            <hr style="margin-top: 6rem;">

            <h4 class="sg_rate_title">Resumo</h4>

            <div class="article_description" style="margin-top: 15px;">
                {!! $exercise->introduction !!}
            </div>
            @foreach ($exercise->exercise_tags as $tag)
                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                    <p>{{ $tag->name }}</p>
                </div>
            @endforeach
                
        </div>
    @endforeach
    <!-- Row Pagination -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            
            <!-- Pagination -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    {{ $promoted_exercises->appends($inputs)->links('layouts.pagination-macau') }}
                    
                </div>
            </div>
            
        </div>
    </div>
    <!-- /Row -->
@endif