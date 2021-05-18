<div class="row mb-5">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card-body">

            <div class="row mb-4">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="label_title mb-3 d-block" style="font-size: 26px;">
                            Informação</label>
                        <div class="d-flex float-left flex-column">
                            <p class="exercise_level m-0">
                                <strong>Título:</strong> {{ $exame->title }}
                            </p>
                            <p class="exercise_level m-0">
                                <strong>Nível:</strong> {{ $exame->level->name }}
                            </p>
                            <p class="exercise_level m-0">
                                <strong>Tema:</strong> {{ $exame->category->name }}
                            </p>
                            @if($exame->exercise->exercise_tags->count())
                                <p class="exercise_level m-0">
                                    <strong>Tags:</strong>
                                    @foreach ($exame->exercise->exercise_tags as $tag)
                                        @if(!$loop->last)
                                            {{ $tag->name }}, 
                                        @else
                                            {{ $tag->name }}
                                        @endif
                                    @endforeach
                                </p>
                            @endif
                            {{-- <p class="exercise_level m-0">
                                <strong>Duração:</strong> 1 hora e 42 minutos
                            </p> --}}
                            <p class="exercise_level m-0">
                                <strong>Tempo para conclusão:</strong> 
                                <span class="conclusion_time_convertion">
                                    @if($exame->has_time)
                                        @if(intdiv($exame->time, 60) != 0)
                                            {{ intdiv($exame->time, 60) > 1 ? intdiv($exame->time, 60) . ' horas' : intdiv($exame->time, 60) . ' hora' }} {{ ($exame->time % 60) == 0 ? '' : ' e ' . ($exame->time % 60) . ' minutos' }}
                                        @else
                                            {{ $exame->time . ' minutos' }}
                                        @endif
                                    @else
                                        (Sem tempo limite)
                                    @endif
                                </span>
                            </p>
                            <p class="exercise_level m-0 mb-2">
                                <strong>Pode interromper?</strong> {{ $exame->has_interruption ? 'Sim' : 'Não' }}
                            </p>
                        </div>
                    </div>
                </div>
                @if($exame->introduction)
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="label_title mb-3 d-block" style="font-size: 26px;">
                                Resumo/Introdução</label>
                            <div class="d-flex float-left flex-column shop_grid_caption ml-0">
                                <div class="article_description m-0 mb-4" style="line-height: 25px;">
                                    {!! $exame->introduction !!}
                                </div>
                            </div>
                            {{-- @if($exame->exercise->exercise_tags->count())
                                <label class="label_title mb-3 d-block" style="font-size: 26px;">
                                    Tags</label>
                                @foreach ($exame->exercise->exercise_tags as $tag)
                                    <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                        <p>{{ $tag->name }}</p>
                                    </div>
                                @endforeach
                            @endif --}}
                        </div>
                    </div>
                @endif
                
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <hr>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label class="label_title mb-3 d-block" style="font-size: 26px;">
                            Enunciado</label>
                        <div class="d-flex float-left flex-column shop_grid_caption ml-0">
                            <div class="article_description m-0 mb-2" style="line-height: 25px;">
                                @if($exame->statement)
                                    {!! $exame->statement !!}
                                @else
                                    (Sem Enunciado)
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <hr>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label class="label_title mb-3 d-block" style="font-size: 26px;">
                            Descrição Audiovisual</label>
                        <div class="d-flex float-left flex-column shop_grid_caption ml-0">
                            <div class="article_description m-0 mb-4" style="line-height: 25px;">
                                @if($exame->audiovisual_desc)
                                    {!! $exame->audiovisual_desc !!}
                                @else
                                    (Sem Descrição Audiovisual)
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            {{-- <div class="row mb-4 mt-4">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group m-2">
                        <label class="label_title d-block text-center">
                        <u> Exercício em execução... </u> </label>
                    </div>
                </div>
            </div> --}}

            <div class="d-block text-center mt-4 mb-4">
                <a href="" class="btn search-btn comment_submit {{ $exame_review ? '' : 'start_exercise' }} m-2 d-none" style="float: none; padding: 12px 20px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin: 0 5px 2px 0;">
                    Iniciar Exercício
                </a>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    @if(!$exame_review)
                        <div class="form-group m-2">
                            <label class="label_title d-block text-center">
                            <u> Exercício em execução... </u> </label>
                        </div>
                    @endif
                    <a href="#pre-listening" class="btn search-btn comment_submit m-2 perform_exercise_nav_button" style="float: none; padding: 15px 25px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Prosseguir
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>