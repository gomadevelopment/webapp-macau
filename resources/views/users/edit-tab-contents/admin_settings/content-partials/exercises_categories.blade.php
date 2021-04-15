<div class="dashboard_container card-body settings_table">
    <div class="dashboard_container_header">
        <div class="dashboard_fl_1">
            <h4 class="add_new_content_h4">
                <span class="add_new_content_span">Adicionar nova Categoria: &nbsp;</span>
                <input type="text" name="new_content_exercise_category" id="new_content_exercise_category" class="form-control add_new_content_input">
                <a href="#" class="btn search-btn comment_submit float-none add_new_content_button new_exercise_category disabled" id="">Guardar</a>
            </h4>
        </div>
    </div>
    <div class="dashboard_container_body">
        <div class="table-responsive">
            <div class="preloader ajax exercise_category col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="margin: auto !important;"><span></span><span></span></div>

            @if(!$exercises_categories->count())

                <div class="dashboard_container_header exercises_categories">
                    <div class="dashboard_fl_1">
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group mb-0">
                                    <label for="" class="label_title" style="font-size: 18px;">Não foram encontradas Categorias de Exercícios.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                
                <table class="table exercises_categories">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nome da Categoria</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($exercises_categories as $exercise_category)
                            <tr id="exercise_category_{{ $exercise_category->id }}">
                                <th scope="row">
                                    <span class="exercise_category_span">{{ $exercise_category->name }}</span>
                                    <input type="text" name="exercise_category_input_{{ $exercise_category->id }}" id="exercise_category_input_{{ $exercise_category->id }}" 
                                        value="{{ $exercise_category->name }}" class="inputs_inside_table" disabled style="display: none;">
                                </th>
                                <td>
                                    <div class="dash_action_link">
                                        <a href="#" data-id="{{ $exercise_category->id }}" class="view edit_on_table edit_exercise_category">Editar</a>
                                        <a href="#" data-id="{{ $exercise_category->id }}" class="view save_on_table save_exercise_category" style="display: none;">Guardar</a>
                                        @if($exercise_category->canBeDeleted())
                                            <a href="#" data-id="{{ $exercise_category->id }}" class="cancel ml-4 delete_on_table delete_exercise_category">Apagar</a>
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