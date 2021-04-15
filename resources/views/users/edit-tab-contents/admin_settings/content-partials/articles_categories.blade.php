<div class="dashboard_container card-body settings_table">
    <div class="dashboard_container_header">
        <div class="dashboard_fl_1">
            <h4 class="add_new_content_h4">
                <span class="add_new_content_span">Adicionar nova Categoria: &nbsp;</span>
                <input type="text" name="new_content_article_category" id="new_content_article_category" class="form-control add_new_content_input">
                <a href="#" class="btn search-btn comment_submit float-none add_new_content_button new_article_category disabled" id="">Guardar</a>
            </h4>
        </div>
    </div>
    <div class="dashboard_container_body">
        <div class="table-responsive">
            <div class="preloader ajax article_category col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="margin: auto !important;"><span></span><span></span></div>

            @if(!$articles_categories->count())

                <div class="dashboard_container_header articles_categories">
                    <div class="dashboard_fl_1">
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group mb-0">
                                    <label for="" class="label_title" style="font-size: 18px;">Não foram encontradas Categorias de Artigos.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                
                <table class="table articles_categories">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nome da Categoria</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($articles_categories as $article_category)
                            <tr id="article_category_{{ $article_category->id }}">
                                <th scope="row">
                                    <span class="article_category_span">{{ $article_category->name }}</span>
                                    <input type="text" name="article_category_input_{{ $article_category->id }}" id="article_category_input_{{ $article_category->id }}" 
                                        value="{{ $article_category->name }}" class="inputs_inside_table" disabled style="display: none;">
                                </th>
                                <td>
                                    <div class="dash_action_link">
                                        <a href="#" data-id="{{ $article_category->id }}" class="view edit_on_table edit_article_category">Editar</a>
                                        <a href="#" data-id="{{ $article_category->id }}" class="view save_on_table save_article_category" style="display: none;">Guardar</a>
                                        @if($article_category->canBeDeleted())
                                            <a href="#" data-id="{{ $article_category->id }}" class="cancel ml-4 delete_on_table delete_article_category">Apagar</a>
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