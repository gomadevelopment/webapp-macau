<div class="row mb-5">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card-body">

            <div class="row">

                <div class="col-sm-6 col-md-6 col-lg-6">

                    <div class="row mb-4">
                        <div class="col-sm-12 col-md-12 col-lg-12">
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
                                    <p class="exercise_level m-0">
                                        <strong>Duração:</strong> {{ $exame->duration }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <hr>
                        </div>
                        
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label class="label_title mb-3 d-block" style="font-size: 26px;">
                                    Instruções</label>
                                <div class="d-flex float-left flex-column">
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
                        
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <hr>
                        </div>
                        
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                    
                                <div class="d-flex float-left flex-column shop_grid_caption ml-0">
                                    <div class="article_description m-0 mb-2" style="line-height: 25px; -webkit-line-clamp: unset;margin-right: auto !important;">
                                        @if($exame->statement)
                                            <a href="#" data-toggle="modal" data-target="#statement_modal" class="info_statement mt-2 btn search-btn comment_submit">
                                                Enunciado
                                            </a>
                                        @else
                                            (Sem Enunciado)
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>

                <div class="col-sm-6 col-md-6 col-lg-6">

                    <div class="row mb-4" style="border: 1px solid gray;">

                        @if($exame->exercise->presentation_image)
                            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                <img src="{{ '/webapp-macau-storage/exercises/' . $exame->exercise->id . '/presentation_image/' . $exame->exercise->presentation_image }}" alt="" style="max-width: 400px;">
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <hr>
                            </div>
                        @endif

                        @if($exame->introduction)
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="d-flex float-left flex-column shop_grid_caption ml-0 align-items-center">
                                        <div class="article_description m-0 text-center" style="line-height: 25px;  -webkit-line-clamp: unset;">
                                            {!! $exame->introduction !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <hr>
                            </div>
                        @endif

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <div class="d-flex float-left flex-column shop_grid_caption ml-0">
                                    <div class="article_description m-0 mb-4" style="line-height: 25px; -webkit-line-clamp: unset;">
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
                    <img src="{{asset('/assets/backoffice_assets/icons/play.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin: 0 5px 2px 0;">
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
                        <img src="{{asset('/assets/backoffice_assets/icons/play.svg', config()->get('app.https'))}}?v=2.4" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Prosseguir
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
