<div class="dashboard_container card-body settings_table">
    <div class="dashboard_container_header">
        <div class="dashboard_fl_1">
            <h4 class="add_new_content_h4">
                <span class="add_new_content_span">Adicionar nova Tag: &nbsp;</span>
                <input type="text" name="new_content_tag" id="new_content_tag" class="form-control add_new_content_input">
                <a href="#" class="btn search-btn comment_submit float-none add_new_content_button new_tag disabled" id="">Guardar</a>
            </h4>
        </div>
    </div>
    <div class="dashboard_container_body">
        <div class="table-responsive">
            <div class="preloader ajax tag col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="margin: auto !important;"><span></span><span></span></div>

            @if(!$tags->count())

                <div class="dashboard_container_header tags">
                    <div class="dashboard_fl_1">
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group mb-0">
                                    <label for="" class="label_title" style="font-size: 18px;">Não foram encontradas Tags.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                
                <table class="table tags">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nome da Tag</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($tags as $tag)
                            <tr id="tag_{{ $tag->id }}">
                                <th scope="row">
                                    <span class="tag_span">{{ $tag->name }}</span>
                                    <input type="text" name="tag_input_{{ $tag->id }}" id="tag_input_{{ $tag->id }}" 
                                        value="{{ $tag->name }}" class="inputs_inside_table" disabled style="display: none;">
                                </th>
                                <td>
                                    <div class="dash_action_link">
                                        <a href="#" data-id="{{ $tag->id }}" class="view edit_on_table edit_tag">Editar</a>
                                        <a href="#" data-id="{{ $tag->id }}" class="view save_on_table save_tag" style="display: none;">Guardar</a>
                                        @if($tag->canBeDeleted())
                                            <a href="#" data-id="{{ $tag->id }}" class="cancel ml-4 delete_on_table delete_tag">Apagar</a>
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