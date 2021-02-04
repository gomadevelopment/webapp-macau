<div class="row mb-5">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card-body">

            <div class="row mb-4">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="label_title mb-4 d-block">
                            Informação</label>
                        <div class="d-flex float-left flex-column">
                            <p class="exercise_level m-0">
                                <strong>Programa:</strong> Sociedade Civil
                            </p>
                            <p class="exercise_level m-0">
                                <strong>Canal:</strong> RTP
                            </p>
                            <p class="exercise_level m-0">
                                <strong>Duração:</strong> 1 hora e 42 minutos
                            </p>
                            <p class="exercise_level m-0">
                                <strong>Tempo para conclusão:</strong> 
                                <span class="conclusion_time_convertion">
                                    @if($exercise->has_time)
                                        @if(intdiv($exercise->time, 60) != 0)
                                            {{ intdiv($exercise->time, 60) > 1 ? intdiv($exercise->time, 60) . ' horas' : intdiv($exercise->time, 60) . ' hora' }} {{ ($exercise->time % 60) == 0 ? '' : ' e ' . ($exercise->time % 60) . ' minutos' }}
                                        @endif
                                    @else
                                        (Sem tempo limite)
                                    @endif
                                    {{-- {{ $exercise->has_time ? intdiv($exercise->time, 60) != 0 ? intdiv($exercise->time, 60).'h:'. ($exercise->time % 60) : '(Sem tempo limite)' }} --}}
                                </span>
                            </p>
                            <p class="exercise_level m-0 mb-4">
                                <strong>Pode interromper?</strong> {{ $exercise->has_interruption ? 'Sim' : 'Não' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="label_title mb-4 d-block">
                            Resumo</label>
                        <div class="d-flex float-left flex-column shop_grid_caption ml-0">
                            <div class="article_description m-0 mb-4" style="line-height: 25px;">
                                {!! $exercise->introduction !!}
                            </div>
                        </div>
                        <label class="label_title mb-4 d-block">
                            Tags</label>
                        @foreach ($exercise->exercise_tags as $tag)
                            <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                <p>{{ $tag->name }}</p>
                            </div>
                        @endforeach
                        {{-- <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                            <p>Gramática</p>
                        </div>
                        <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                            <p>Experiência</p>
                        </div>
                        <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                            <p>Verbos</p>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="d-block text-center mt-4 mb-4">
                <a href="#pre-listening" class="btn search-btn comment_submit start_exercise m-2" style="float: none; padding: 12px 20px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin: 0 5px 2px 0;">
                    Iniciar Exercício
                </a>
                <a href="#" class="btn btn-theme remove_button m-2" style="float: none; padding: 14px 20px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/eye_outline.svg')}}" alt="" style="margin: 0 5px 2px 0;">
                    Ver Enunciado
                </a>
            </div>

        </div>
    </div>
</div>