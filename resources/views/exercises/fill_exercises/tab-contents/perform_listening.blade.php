<div class="row mb-5">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card-body">

            <input type="hidden" name="" id="listening_questions_count" value="{{ $listening_questions->count() }}">

            @if($listening_questions->count())

                <div class="custom-tab customize-tab tabs_creative">
                    <ul class="nav nav-tabs p-0 b-0 m-auto" id="perform_listening_tabs" role="tablist">
                        @foreach ($listening_questions as $question)
                            <li class="nav-item">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="ex{{$question->id}}-tab" data-toggle="tab" href="#ex{{$question->id}}" role="tab" aria-controls="ex{{$question->id}}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" style="padding: 8px 30px !important;">
                                    Exercício {{$loop->index + 1}}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content" id="perform_listening_tabs_content">

                        @foreach ($listening_questions as $question)

                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" data-subtype-id="{{ $question->question_subtype_id }}"
                                id="ex{{$question->id}}" role="tabpanel" aria-labelledby="ex{{$question->id}}-tab">
                                
                                <div class="row page-title p-0" style="margin-bottom: -15px;">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group wrap m-0">
                                            <label class="label_title d-block" style="font-size: 30px;">
                                                {{ $question->section }} </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            {{-- <label class="label_title mb-3 d-block">
                                                {{ $question->title }} </label> --}}
                                            <div class="d-flex float-left flex-column">
                                                <div class="exercise_question_description">
                                                    {!! $question->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="mt-4 mb-4">

                                <input type="text" name="question_ids[]" value="{{ $question->id }}" hidden>

                                @switch($question->question_subtype_id)
                                    @case(1)
                                        @include('exercises.fill_exercises.question-types.information', ['question' => $question])
                                        @break
                                    @case(2)
                                        @include('exercises.fill_exercises.question-types.correspondence.images', ['question' => $question])
                                        @break
                                    @case(3)
                                        @include('exercises.fill_exercises.question-types.correspondence.audios', ['question' => $question])
                                        @break
                                    @case(4)
                                        @include('exercises.fill_exercises.question-types.correspondence.categories', ['question' => $question])
                                        @break
                                    @case(5)
                                        @include('exercises.fill_exercises.question-types.fill_options.shuffle', ['question' => $question])
                                        @break
                                    @case(6)
                                        @include('exercises.fill_exercises.question-types.fill_options.words_text', ['question' => $question])
                                        @break
                                    @case(18)
                                        @include('exercises.fill_exercises.question-types.fill_options.writing', ['question' => $question])
                                        @break
                                    @case(7)
                                        @include('exercises.fill_exercises.question-types.true_or_false', ['question' => $question])
                                        @break
                                    @case(8)
                                        @include('exercises.fill_exercises.question-types.multiple_choice.questions', ['question' => $question])
                                        @break
                                    @case(9)
                                        @include('exercises.fill_exercises.question-types.multiple_choice.intruder', ['question' => $question])
                                        @break
                                    @case(10)
                                        @include('exercises.fill_exercises.question-types.free_question', ['question' => $question])
                                        @break
                                    @case(11)
                                        @include('exercises.fill_exercises.question-types.differences', ['question' => $question])
                                        @break
                                    @case(12)
                                        @include('exercises.fill_exercises.question-types.statement_correction', ['question' => $question])
                                        @break
                                    @case(13)
                                        @include('exercises.fill_exercises.question-types.automatic_content', ['question' => $question])
                                        @break
                                    @case(14)
                                        @include('exercises.fill_exercises.question-types.assortment.sentences', ['question' => $question])
                                        @break
                                    @case(15)
                                        @include('exercises.fill_exercises.question-types.assortment.words', ['question' => $question])
                                        @break
                                    @case(16)
                                        @include('exercises.fill_exercises.question-types.assortment.images', ['question' => $question])
                                        @break
                                    @case(17)
                                        @include('exercises.fill_exercises.question-types.vowels', ['question' => $question])
                                        @break
                                    @default
                                        
                                @endswitch

                                <hr class="mt-4 mb-4">

                                <div class="row mb-4">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label class="label_title d-block" style="font-size: 30px;">
                                            Avaliação </label>
                                            <div class="d-flex float-left flex-column">
                                                <p class="exercise_author">
                                                <strong>Pontuação:</strong> Esta questão vale <strong>{{ $question->avaliation_score }}</strong> pontos.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-block text-center mt-4 mb-4">
                                    @if($loop->first)
                                        <a href="#pre-listening" class="btn btn-theme remove_button m-2 perform_exercise_nav_button" style="float: none; padding: 15px 25px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/small_arrow_back.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                            Voltar
                                        </a>
                                        @if($loop->last)
                                            <a href="#listening-shop" class="btn search-btn comment_submit m-2 perform_exercise_nav_button" style="float: none; padding: 15px 25px;">
                                                <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                                Continuar
                                            </a>
                                        @else
                                            <a href="#ex{{$listening_questions[$loop->index+1]->id}}" class="btn search-btn comment_submit m-2 perform_exercise_nav_button" style="float: none; padding: 15px 25px;">
                                                <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                                Seguinte
                                            </a>
                                        @endif
                                    @else
                                        @if($loop->last)
                                            <a href="#ex{{$listening_questions[$loop->index-1]->id}}" class="btn btn-theme remove_button m-2 perform_exercise_nav_button" style="float: none; padding: 15px 25px;">
                                                <img src="{{asset('/assets/backoffice_assets/icons/small_arrow_back.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                                Voltar
                                            </a>
                                            <a href="#listening-shop" class="btn search-btn comment_submit m-2 perform_exercise_nav_button" style="float: none; padding: 15px 25px;">
                                                <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                                Continuar
                                            </a>
                                        @else
                                            <a href="#ex{{$listening_questions[$loop->index-1]->id}}" class="btn btn-theme remove_button m-2 perform_exercise_nav_button" style="float: none; padding: 15px 25px;">
                                                <img src="{{asset('/assets/backoffice_assets/icons/small_arrow_back.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                                                Voltar
                                            </a>
                                            <a href="#ex{{$listening_questions[$loop->index+1]->id}}" class="btn search-btn comment_submit m-2 perform_exercise_nav_button" style="float: none; padding: 15px 25px;">
                                                <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                                Seguinte
                                            </a>
                                        @endif
                                    @endif
                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            @else

                <div class="row mb-4 mt-4">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group m-2">
                            <label class="label_title d-block text-center">
                            Esta secção não tem questões. Prossiga para a próxima secção. </label>
                        </div>
                    </div>
                </div>
                <div class="d-block text-center mt-4 mb-4">
                    <a href="#listening-shop" class="btn search-btn comment_submit m-2 perform_exercise_nav_button" style="float: none; padding: 15px 25px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Prosseguir
                    </a>
                </div>

            @endif

        </div>
    </div>
</div>