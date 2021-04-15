<div class="dashboard_container card-body settings_table">
    <div class="dashboard_container_header">
        <div class="dashboard_fl_1">
            <h4 class="add_new_content_h4">
                <span class="add_new_content_span">Adicionar novo Nível: &nbsp;</span>
                <input type="text" name="new_content_exercise_level" id="new_content_exercise_level" class="form-control add_new_content_input">
                <a href="#" class="btn search-btn comment_submit float-none add_new_content_button new_exercise_level disabled" id="">Guardar</a>
            </h4>
        </div>
    </div>
    <div class="dashboard_container_body">
        <div class="table-responsive">
            <div class="preloader ajax col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="margin: auto !important;"><span></span><span></span></div>

            @if(!$exercises_levels->count())

                <div class="dashboard_container_header exercises_levels">
                    <div class="dashboard_fl_1">
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group mb-0">
                                    <label for="" class="label_title" style="font-size: 18px;">Não foram encontrados Níveis de Exercícios.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                
                <table class="table exercises_levels">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nome do Nível</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($exercises_levels as $exercise_level)
                            <tr id="exercise_level_{{ $exercise_level->id }}">
                                <th scope="row">
                                    <span class="exercise_level_span">{{ $exercise_level->name }}</span>
                                    <input type="text" name="exercise_level_input_{{ $exercise_level->id }}" id="exercise_level_input_{{ $exercise_level->id }}" 
                                        value="{{ $exercise_level->name }}" class="inputs_inside_table" disabled style="display: none;">
                                </th>
                                <td>
                                    <div class="dash_action_link">
                                        <a href="#" data-id="{{ $exercise_level->id }}" class="view edit_on_table edit_exercise_level">Editar</a>
                                        <a href="#" data-id="{{ $exercise_level->id }}" class="view save_on_table save_exercise_level" style="display: none;">Guardar</a>
                                        @if($exercise_level->canBeDeleted())
                                            <a href="#" data-id="{{ $exercise_level->id }}" class="cancel ml-4 delete_on_table delete_exercise_level">Apagar</a>
                                        @endif
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