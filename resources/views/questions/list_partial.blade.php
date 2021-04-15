<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card-body p-0 mb-3 ml-1" style="background:none; box-shadow: none;">
            <label class="label_title">Vista Geral de Questões</label>
            <br>
            <label class="label_title" style="font-size: 18px;">
                Nota:
            </label>
            <label class="label_title" style='font-size: 16px; font-family: "Gilroy - Regular";'>
                Ao Editar uma questão, será redireccionado para um novo separador.
            </label>
        </div>
        <div class="dashboard_container card-body professor_validation_table questions_table settings_table">
            
            <div class="dashboard_container_header">
                <div class="dashboard_fl_1">
                    <h4>
                        <a href="#collapse_questions_filters" class="ml-auto p-0 b-0 align-self-center questions_filters_accordion professor_validation_filters_accordion expand_accordion collapsed"  data-toggle="collapse" data-parent="#accordion">
                            Filtros &nbsp;
                            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_black.svg')}}" class="expand_chevron" alt="">
                            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_up_pink.svg')}}" class="collapse_chevron" alt="" style="display: none;">
                        </a>
                    </h4>
                    <div id="collapse_questions_filters" class="collapse" data-parent="#accordion">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="" class="label_title" style="font-size: 18px;">Referência</label>
                                    <input class="form-control" type="text" name="questions_filter_reference" id="questions_filter_reference" value="{{ $inputs['questions_filter_reference'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="" class="label_title" style="font-size: 18px;">Do Exercício</label>
                                    <select name="questions_filter_exercises" id="questions_filter_exercises" class="form-control">
                                        <option value="all">Todos</option>
                                        @foreach ($exercises as $exercise)
                                            <option value="{{ $exercise->id }}" {{ isset($inputs['questions_filter_exercises']) && $inputs['questions_filter_exercises'] == $exercise->id ? 'selected' : '' }}>
                                                {{ $exercise->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button class="btn search-btn comment_submit float-none questions" id="apply_filters">Aplicar</button>
                            
                    </div>
                </div>
            </div>

            <div class="dashboard_container_body">
                <div class="table-responsive">
                    <div class="preloader ajax questions col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="margin: auto !important;"><span></span><span></span></div>

                    @if(!$questions->count())

                        <div class="dashboard_container_header">
                            <div class="dashboard_fl_1">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <div class="form-group mb-0">
                                            <label for="" class="label_title none_questions_found none_professors_found" style="font-size: 18px;">Não foram encontradas Questões.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        
                        <table class="table questions">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Referência</th>
                                    <th scope="col">Do Exercício</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($questions as $question)
                                    <tr id="{{ $question->id }}">
                                        <th scope="row"> {{ $question->reference }} </th>
                                        <th scope="row">{{ $question->exercise->title }}</th>
                                        <td>
                                            <div class="dash_action_link">
                                            <a href="/exercicios/{{ $question->exercise->id }}/questao/editar/{{ $question->id }}?exercise_question_section={{ $question->section }}" 
                                                    target="_blank" data-id="{{ $question->id }}" class="view">
                                                    Editar
                                                </a>
                                            </div>	
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

<input type="number" name="questions_page" id="questions_page_number" value="1" hidden="">
<input type="number" name="previous_questions_page" id="previous_questions_page_number" value="1" hidden="">

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        
        <!-- Pagination -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                {{ $questions->appends($inputs)->links('layouts.pagination-macau') }}
                
            </div>
        </div>
        
    </div>
</div>