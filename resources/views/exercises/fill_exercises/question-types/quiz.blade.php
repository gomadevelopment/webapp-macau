<div class="row mb-5" id="quiz-div">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card-body">

            <div class="row page-title p-0" style="margin-bottom: -15px;">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group wrap m-0">
                        <label class="label_title d-block" style="font-size: 30px;">
                            Pós-Escuta </label>
                    </div>
                    <div class="exercise_time wrap see_in_english float-right align-items-center">
                        <p class="time_label exercise_author align-self-center">
                            <strong style="font-size: 22px;">See in English</strong>
                        </p>
                        <label class="switch mb-1 ml-2">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label class="label_title mb-3 d-block">
                            Questionário </label>
                        <div class="d-flex float-left flex-column">
                            <p class="exercise_author" style="margin-bottom: -10px;">
                                <strong>Reflita sobre os exercícios</strong> que fez e pense nas <strong>estratégias que</strong>
                            </p>
                            <p class="exercise_author">
                                <strong>utilizou</strong>. Responda ao seguinte questionário:
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="mt-4 mb-4">

            <div class="row mt-5 mb-5 text-center pr-5 pl-5">
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                    <div class="time_countdown d-inline-block" style="padding: 10px 20px 6px 20px !important; font-size: 30px; border-radius: 10px;">
                        1
                    </div>
                    <div class="quiz_level_label" style="cursor: default; pointer-events: none;">
                        Concordo plenamente
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                    <div class="time_countdown d-inline-block" style="padding: 10px 20px 6px 20px !important; font-size: 30px; border-radius: 10px;">
                        2
                    </div>
                    <div class="quiz_level_label" style="cursor: default; pointer-events: none;">
                        Concordo
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                    <div class="time_countdown d-inline-block" style="padding: 10px 20px 6px 20px !important; font-size: 30px; border-radius: 10px;">
                        3
                    </div>
                    <div class="quiz_level_label" style="cursor: default; pointer-events: none;">
                        Concordo em parte
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                    <div class="time_countdown d-inline-block" style="padding: 10px 20px 6px 20px !important; font-size: 30px; border-radius: 10px;">
                        4
                    </div>
                    <div class="quiz_level_label" style="cursor: default; pointer-events: none;">
                        Discordo em parte
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                    <div class="time_countdown d-inline-block" style="padding: 10px 20px 6px 20px !important; font-size: 30px; border-radius: 10px;">
                        5
                    </div>
                    <div class="quiz_level_label" style="cursor: default; pointer-events: none;">
                        Discordo
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                    <div class="time_countdown d-inline-block" style="padding: 10px 20px 6px 20px !important; font-size: 30px; border-radius: 10px;">
                        6
                    </div>
                    <div class="quiz_level_label" style="cursor: default; pointer-events: none;">
                        Discordo completamente
                    </div>
                </div>
            </div>

            <div class="row mb-4">

                @if($exame_review)
                    @foreach($exame->inquiries as $exame_inquiry)
                        @if ($exame_inquiry->inquirie->order == 999)
                            @continue
                        @endif
                        <div class="col-sm-12 col-md-12 col-lg-12">

                            <div class="form-group quiz_question_div rb-box p-3">

                                <div class="row">
                                    <div class="col-sm-12 col-md-7 col-lg-7 align-self-center">
                                        <div class="question">
                                            <strong>Questão {{ $loop->index + 1 }}:</strong> {{ $exame_inquiry->inquirie->question }}
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-5 col-lg-5 align-self-center">
                                        <div id="rb-{{$exame_inquiry->inquirie->id}}" class="rb" data-id="{{ $exame_inquiry->inquirie->id }}">
                                            <div class="rb-tab {{ $exame_inquiry->value == 1 ? 'rb-tab-active' : '' }}" data-value="1">
                                                <div class="rb-spot" style="cursor: default; pointer-events: none;">
                                                    <span class="rb-txt pt-1">1</span>
                                                </div>
                                            </div>
                                            <div class="rb-tab {{ $exame_inquiry->value == 2 ? 'rb-tab-active' : '' }}" data-value="2">
                                                <div class="rb-spot" style="cursor: default; pointer-events: none;">
                                                    <span class="rb-txt pt-1">2</span>
                                                </div>
                                            </div>
                                            <div class="rb-tab {{ $exame_inquiry->value == 3 ? 'rb-tab-active' : '' }}" data-value="3">
                                                <div class="rb-spot" style="cursor: default; pointer-events: none;">
                                                    <span class="rb-txt pt-1">3</span>
                                                </div>
                                            </div>
                                            <div class="rb-tab {{ $exame_inquiry->value == 4 ? 'rb-tab-active' : '' }}" data-value="4">
                                                <div class="rb-spot" style="cursor: default; pointer-events: none;">
                                                    <span class="rb-txt pt-1">4</span>
                                                </div>
                                            </div>
                                            <div class="rb-tab {{ $exame_inquiry->value == 5 ? 'rb-tab-active' : '' }}" data-value="5">
                                                <div class="rb-spot" style="cursor: default; pointer-events: none;">
                                                    <span class="rb-txt pt-1">5</span>
                                                </div>
                                            </div>
                                            <div class="rb-tab {{ $exame_inquiry->value == 6 ? 'rb-tab-active' : '' }}" data-value="6">
                                                <div class="rb-spot" style="cursor: default; pointer-events: none;">
                                                    <span class="rb-txt pt-1">6</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    @endforeach
                @else
                    @foreach($inquiries as $inquiry)
                        @if ($inquiry->order == 999)
                            @continue
                        @endif
                        <div class="col-sm-12 col-md-12 col-lg-12">

                            <div class="form-group quiz_question_div rb-box p-3">

                                <div class="row">
                                    <div class="col-sm-12 col-md-7 col-lg-7 align-self-center">
                                        <div class="question">
                                            <strong>Questão {{ $loop->index + 1 }}:</strong> {{ $inquiry->question }}
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-5 col-lg-5 align-self-center">
                                        <div id="rb-{{$inquiry->id}}" class="rb" data-id="{{ $inquiry->id }}">
                                            <div class="rb-tab rb-tab-active" data-value="1">
                                                <div class="rb-spot">
                                                    <span class="rb-txt pt-1">1</span>
                                                </div>
                                            </div>
                                            <div class="rb-tab" data-value="2">
                                                <div class="rb-spot">
                                                    <span class="rb-txt pt-1">2</span>
                                                </div>
                                            </div>
                                            <div class="rb-tab" data-value="3">
                                                <div class="rb-spot">
                                                    <span class="rb-txt pt-1">3</span>
                                                </div>
                                            </div>
                                            <div class="rb-tab" data-value="4">
                                                <div class="rb-spot">
                                                    <span class="rb-txt pt-1">4</span>
                                                </div>
                                            </div>
                                            <div class="rb-tab" data-value="5">
                                                <div class="rb-spot">
                                                    <span class="rb-txt pt-1">5</span>
                                                </div>
                                            </div>
                                            <div class="rb-tab" data-value="6">
                                                <div class="rb-spot">
                                                    <span class="rb-txt pt-1">6</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    @endforeach
                @endif

            </div>

            <hr class="mt-4 mb-4">

            <div class="row mb-4">
                
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label class="label_title d-block" style="font-size: 30px;">
                        {{ $anxiety_inquiry->question }} </label>
                        <div class="d-flex flex-column">
                            <p class="exercise_author" style="margin-bottom: -10px;">
                                Use uma escala de 1 a 5 para medir a <strong>'Temperatura'</strong> da sua <strong>Ansiedade</strong> em relação à
                            </p>
                            <p class="exercise_author">
                                <strong>Compreensão Oral</strong>:
                            </p>
                        </div>

                        <div class="row mt-4 text-center justify-content-center pr-5 pl-5 rb anxiety_levels" id="rb-15" data-id="15">
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2 mb-3 rb-tab
                             {{ ($exame_review && $exame->anxiety_inquiry->value == 1) || !$exame_review ? 'rb-tab-active' : '' }}" data-value="1">
                                <div class="rb-spot" style="{{ $exame_review ? 'cursor: default; pointer-events: none;' : '' }}">
                                    <span class="rb-txt pt-1">1</span>
                                </div>
                                <div class="quiz_level_label" style="{{ $exame_review ? 'cursor: default; pointer-events: none;' : '' }}">
                                    Senti muita Ansiedade
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2 mb-3 rb-tab {{ $exame_review && $exame->anxiety_inquiry->value == 2 ? 'rb-tab-active' : '' }}" data-value="2">
                                <div class="rb-spot" style="{{ $exame_review ? 'cursor: default; pointer-events: none;' : '' }}">
                                    <span class="rb-txt pt-1">2</span>
                                </div>
                                <div class="quiz_level_label" style="{{ $exame_review ? 'cursor: default; pointer-events: none;' : '' }}">
                                    Senti Ansiedade
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2 mb-3 rb-tab {{ $exame_review && $exame->anxiety_inquiry->value == 3 ? 'rb-tab-active' : '' }}" data-value="3">
                                <div class="rb-spot" style="{{ $exame_review ? 'cursor: default; pointer-events: none;' : '' }}">
                                    <span class="rb-txt pt-1">3</span>
                                </div>
                                <div class="quiz_level_label" style="{{ $exame_review ? 'cursor: default; pointer-events: none;' : '' }}">
                                    Senti pouca Ansiedade
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2 mb-3 rb-tab {{ $exame_review && $exame->anxiety_inquiry->value == 4 ? 'rb-tab-active' : '' }}" data-value="4">
                                <div class="rb-spot" style="{{ $exame_review ? 'cursor: default; pointer-events: none;' : '' }}">
                                    <span class="rb-txt pt-1">4</span>
                                </div>
                                <div class="quiz_level_label" style="{{ $exame_review ? 'cursor: default; pointer-events: none;' : '' }}">
                                    Não senti Ansiedade
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2 mb-3 rb-tab {{ $exame_review && $exame->anxiety_inquiry->value == 5 ? 'rb-tab-active' : '' }}" data-value="5">
                                <div class="rb-spot" style="{{ $exame_review ? 'cursor: default; pointer-events: none;' : '' }}">
                                    <span class="rb-txt pt-1">5</span>
                                </div>
                                <div class="quiz_level_label" style="{{ $exame_review ? 'cursor: default; pointer-events: none;' : '' }}">
                                    Não senti Ansiedade nenhuma
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="mt-4 mb-4">

            <div class="d-block text-center mt-4 mb-4">
                <a href="#after-listening" class="btn btn-theme remove_button m-2 perform_exercise_nav_button" style="float: none; padding: 15px 25px;">
                    <img src="{{asset('/assets/backoffice_assets/icons/small_arrow_back.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                    Voltar
                </a>
                @if(!$exame_review)
                    <a href="#evaluation" id="{{ $exame_review ? '' : 'finish_exercise_button' }}" class="btn search-btn comment_submit m-2" style="float: none; padding: 15px 25px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Check.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Concluir
                    </a>
                @else
                    <a href="#evaluation" id="" class="btn search-btn comment_submit m-2 perform_exercise_nav_button" style="float: none; padding: 15px 25px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Check.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Ver Classificação
                    </a>
                @endif
            </div>

        </div>
    </div>
</div>