<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card-body p-0 mb-3 ml-1" style="background:none; box-shadow: none;">
            <label class="label_title">Apagar Exercícios/Sequências</label>
        </div>
        <div class="dashboard_container card-body professor_validation_table student settings_table">
            <div class="dashboard_container_header">
                <div class="dashboard_fl_1">
                    <h4>
                        <a href="#collapse_exercises_filters" class="ml-auto p-0 b-0 align-self-center exercises_validation_filters_accordion expand_accordion collapsed"  data-toggle="collapse" data-parent="#accordion">
                            Filtros &nbsp;
                            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_black.svg', config()->get('app.https'))}}?v=2.4" class="expand_chevron" alt="">
                            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_up_pink.svg', config()->get('app.https'))}}?v=2.4" class="collapse_chevron" alt="" style="display: none;">
                        </a>
                    </h4>
                    <div id="collapse_exercises_filters" class="collapse" data-parent="#accordion">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="" class="label_title" style="font-size: 18px;">Título da Sequência</label>
                                    <input class="form-control" type="text" name="settings_exercises_filter_name" id="settings_exercises_filter_name" value="{{ $inputs['settings_exercises_filter_name'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="" class="label_title" style="font-size: 18px;">Categoria/Tema</label>
                                    <select name="settings_exercises_filter_category" id="settings_exercises_filter_category" class="form-control">
                                        <option value="all" 
                                            {{ isset($inputs['settings_exercises_filter_category']) && $inputs['settings_exercises_filter_category'] == 'all' ? 'selected' : '' }}>
                                            Todos
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ isset($inputs['settings_exercises_filter_category']) && $inputs['settings_exercises_filter_category'] == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="" class="label_title" style="font-size: 18px;">Nível</label>
                                    <select name="settings_exercises_filter_level" id="settings_exercises_filter_level" class="form-control">
                                        <option value="all" 
                                            {{ isset($inputs['settings_exercises_filter_level']) && $inputs['settings_exercises_filter_level'] == 'all' ? 'selected' : '' }}>
                                            Todos
                                        </option>
                                        @foreach ($levels as $level)
                                            <option value="{{ $level->id }}" 
                                                {{ isset($inputs['settings_exercises_filter_level']) && $inputs['settings_exercises_filter_level'] == $level->id ? 'selected' : '' }}>
                                                {{ $level->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="" class="label_title" style="font-size: 18px;">Está Publicado?</label>
                                    <select name="settings_exercises_filter_published" id="settings_exercises_filter_published" class="form-control">
                                        <option value="all" 
                                            {{ isset($inputs['settings_exercises_filter_published']) && $inputs['settings_exercises_filter_published'] == 'all' ? 'selected' : '' }}>
                                            Todos
                                        </option>
                                        <option value="1" 
                                            {{ isset($inputs['settings_exercises_filter_published']) && $inputs['settings_exercises_filter_published'] == 1 ? 'selected' : '' }}>
                                            Sim
                                        </option>
                                        <option value="0" 
                                            {{ isset($inputs['settings_exercises_filter_published']) && $inputs['settings_exercises_filter_published'] == 0 ? 'selected' : '' }}>
                                            Não
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button class="btn search-btn comment_submit float-none exercises" id="apply_filters">Aplicar</button>
                            
                    </div>
                </div>
            </div>
            <div class="dashboard_container_body">
                <div class="table-responsive">
                    <div class="preloader ajax exercises col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="margin: auto !important;"><span></span><span></span></div>

                    @if(!$exercises->count())

                        <div class="dashboard_container_header">
                            <div class="dashboard_fl_1">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <div class="form-group mb-0">
                                            <label for="" class="label_title none_professors_found" style="font-size: 18px;">Não foram encontrados Exercícios/Sequências.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Título</th>
                                    <th scope="col">Categoria/Tema</th>
                                    <th scope="col">Nível</th>
                                    <th scope="col">Está Publicado?</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($exercises as $exercise)
                                    <tr id="{{ $exercise->id }}">
                                        <th scope="row">{{ $exercise->title ?? '-' }}</th>
                                        <th scope="row">{{ $exercise->category->name ?? '-' }}</th>
                                        <th scope="row">{{ $exercise->level->name ?? '-' }}</th>
                                        <th scope="row">{{ $exercise->published ? 'Sim' : 'Não' }}</th>
                                        <td>
                                            <div class="dash_action_link">
                                                <a href="/acoes-irreversiveis/apagar/exercicio/{{ $exercise->id }}" class="delete cancel" delete-who="exercise" data-id="{{ $exercise->id }}">Apagar</a>
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

<input type="number" name="settings_exercises_page" id="settings_exercises_page_number" value="1" hidden="">
<input type="number" name="previous_settings_exercises_page" id="previous_settings_exercises_page_number" value="1" hidden="">

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        
        <!-- Pagination -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                {{ $exercises->appends($inputs)->links('layouts.pagination-macau') }}
                
            </div>
        </div>
        
    </div>
</div>
