<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card-body p-0 mb-3 ml-1" style="background:none; box-shadow: none;">
            <label class="label_title">Validação de Artigos</label>
        </div>
        <div class="dashboard_container card-body professor_validation_table article_validation_table settings_table">
            <div class="dashboard_container_header">
                <div class="dashboard_fl_1">
                    <h4>
                        <a href="#collapse_articles_validation_filters" class="ml-auto p-0 b-0 align-self-center articles_validation_filters_accordion expand_accordion collapsed"  data-toggle="collapse" data-parent="#accordion">
                            Filtros &nbsp;
                            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_black.svg', config()->get('app.https'))}}?v=2.4" class="expand_chevron" alt="">
                            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_up_pink.svg', config()->get('app.https'))}}?v=2.4" class="collapse_chevron" alt="" style="display: none;">
                        </a>
                    </h4>
                    <div id="collapse_articles_validation_filters" class="collapse" data-parent="#accordion">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="" class="label_title" style="font-size: 18px;">Título do Artigo</label>
                                    <input class="form-control" type="text" name="settings_articles_filter_article_title" id="settings_articles_filter_article_title" value="{{ $inputs['settings_articles_filter_article_title'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="" class="label_title" style="font-size: 18px;">Aprovação</label>
                                    <select name="settings_articles_filter_article_published" id="settings_articles_filter_article_published" class="form-control">
                                        <option value="all" 
                                            {{ isset($inputs['settings_articles_filter_article_published']) && $inputs['settings_articles_filter_article_published'] == 'all' ? 'selected' : '' }}>
                                            Todos
                                        </option>
                                        <option value="published"
                                            {{ isset($inputs['settings_articles_filter_article_published']) && $inputs['settings_articles_filter_article_published'] == 'published' ? 'selected' : '' }}>
                                            Publicados
                                        </option>
                                        <option value="non_published"
                                            {{ isset($inputs['settings_articles_filter_article_published']) && $inputs['settings_articles_filter_article_published'] == 'non_published' ? 'selected' : '' }}>
                                            Não Publicados
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="" class="label_title" style="font-size: 18px;">Nome do Autor</label>
                                    <input class="form-control" type="text" name="settings_articles_filter_user_username" id="settings_articles_filter_user_username" value="{{ $inputs['settings_articles_filter_user_username'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="" class="label_title" style="font-size: 18px;">Pode Publicar?</label>
                                    <select name="settings_articles_filter_user_can_publish" id="settings_articles_filter_user_can_publish" class="form-control">
                                        <option value="all" 
                                            {{ isset($inputs['settings_articles_filter_user_can_publish']) && $inputs['settings_articles_filter_user_can_publish'] == 'all' ? 'selected' : '' }}>
                                            Todos
                                        </option>
                                        <option value="yes"
                                            {{ isset($inputs['settings_articles_filter_user_can_publish']) && $inputs['settings_articles_filter_user_can_publish'] == 'yes' ? 'selected' : '' }}>
                                            Sim
                                        </option>
                                        <option value="no"
                                            {{ isset($inputs['settings_articles_filter_user_can_publish']) && $inputs['settings_articles_filter_user_can_publish'] == 'no' ? 'selected' : '' }}>
                                            Não
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button class="btn search-btn comment_submit float-none articles" id="apply_filters">Aplicar</button>
                            
                    </div>
                </div>
            </div>
            <div class="dashboard_container_body">
                <div class="table-responsive">
                    <div class="preloader ajax articles col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="margin: auto !important;"><span></span><span></span></div>

                    @if(!$articles->count())

                        <div class="dashboard_container_header">
                            <div class="dashboard_fl_1">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <div class="form-group mb-0">
                                            <label for="" class="label_title none_professors_found" style="font-size: 18px;">Não foram encontrados Artigos.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        
                        <table class="table article">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" colspan="3" style="border: 1px solid;">Artigo</th>
                                    <th scope="col" colspan="3" style="border: 1px solid;">Autor</th>
                                </tr>
                                <tr>
                                    <th scope="col" style="border: 1px solid;">Título</th>
                                    <th scope="col" style="border: 1px solid;">Estado</th>
                                    <th scope="col" style="border: 1px solid;">Ações</th>
                                    <th scope="col" style="border: 1px solid;">Nome</th>
                                    <th scope="col" style="border: 1px solid;">Pode Publicar?</th>
                                    <th scope="col" style="border: 1px solid;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($articles as $article)
                                    <tr id="article_id_{{ $article->id }}">
                                        @include('users.edit-tab-contents.admin_settings.single_article_table_row')
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

<input type="number" name="settings_articles_page" id="settings_articles_page_number" value="1" hidden="">
<input type="number" name="previous_settings_articles_page" id="previous_settings_articles_page_number" value="1" hidden="">

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        
        <!-- Pagination -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                {{ $articles->appends($inputs)->links('layouts.pagination-macau') }}
                
            </div>
        </div>
        
    </div>
</div>
