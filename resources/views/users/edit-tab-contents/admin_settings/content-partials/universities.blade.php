<div class="dashboard_container card-body settings_table">
    <div class="dashboard_container_header">
        <div class="dashboard_fl_1">
            <h4 class="add_new_content_h4">
                <span class="add_new_content_span">Adicionar nova Universidade: &nbsp;</span>
                <input type="text" name="new_content_university" id="new_content_university" class="form-control add_new_content_input">
                <a href="#" class="btn search-btn comment_submit float-none add_new_content_button new_university disabled" id="">Guardar</a>
            </h4>
        </div>
    </div>
    <div class="dashboard_container_body">
        <div class="table-responsive">
            <div class="preloader ajax university col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="margin: auto !important;"><span></span><span></span></div>

            @if(!$universities->count())

                <div class="dashboard_container_header universities">
                    <div class="dashboard_fl_1">
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group mb-0">
                                    <label for="" class="label_title" style="font-size: 18px;">Não foram encontradas Universidades.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                
                <table class="table universities">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nome da Universidade</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($universities as $university)
                            <tr id="university_{{ $university->id }}">
                                <th scope="row">
                                    <span class="university_span">{{ $university->name }}</span>
                                    <input type="text" name="university_input_{{ $university->id }}" id="university_input_{{ $university->id }}" 
                                        value="{{ $university->name }}" class="inputs_inside_table" disabled style="display: none;">
                                </th>
                                <td>
                                    <div class="dash_action_link">
                                        <a href="#" data-id="{{ $university->id }}" class="view edit_on_table edit_university">Editar</a>
                                        <a href="#" data-id="{{ $university->id }}" class="view save_on_table save_university" style="display: none;">Guardar</a>
                                        @if($university->canBeDeleted())
                                            <a href="#" data-id="{{ $university->id }}" class="cancel ml-4 delete_on_table delete_university">Apagar</a>
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