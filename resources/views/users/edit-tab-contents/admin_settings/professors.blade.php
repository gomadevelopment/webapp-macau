<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card-body p-0 mb-3 ml-1" style="background:none; box-shadow: none;">
            <label class="label_title">Validação de Professores</label>
        </div>
        <div class="dashboard_container card-body professor_validation_table professor settings_table">
            <div class="dashboard_container_header">
                <div class="dashboard_fl_1">
                    <h4>
                        <a href="#collapse_professors_validation_filters" class="ml-auto p-0 b-0 align-self-center professors_validation_filters_accordion expand_accordion collapsed"  data-toggle="collapse" data-parent="#accordion">
                            Filtros &nbsp;
                            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_black.svg')}}" class="expand_chevron" alt="">
                            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_up_pink.svg')}}" class="collapse_chevron" alt="" style="display: none;">
                        </a>
                    </h4>
                    <div id="collapse_professors_validation_filters" class="collapse" data-parent="#accordion">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="" class="label_title" style="font-size: 18px;">Nome de Utilizador</label>
                                    <input class="form-control" type="text" name="settings_professors_filter_username" id="settings_professors_filter_username" value="{{ $inputs['settings_professors_filter_username'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="" class="label_title" style="font-size: 18px;">Aprovado</label>
                                    <select name="settings_professors_filter_approval" id="settings_professors_filter_approval" class="form-control">
                                        <option value="all" 
                                            {{ isset($inputs['settings_professors_filter_approval']) && $inputs['settings_professors_filter_approval'] == 'all' ? 'selected' : '' }}>
                                            Todos
                                        </option>
                                        <option value="approved"
                                            {{ isset($inputs['settings_professors_filter_approval']) && $inputs['settings_professors_filter_approval'] == 'approved' ? 'selected' : '' }}>
                                            Sim
                                        </option>
                                        <option value="non_approved"
                                            {{ isset($inputs['settings_professors_filter_approval']) && $inputs['settings_professors_filter_approval'] == 'non_approved' ? 'selected' : '' }}>
                                            Não
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="" class="label_title" style="font-size: 18px;">Estado</label>
                                    <select name="settings_professors_filter_status" id="settings_professors_filter_status" class="form-control">
                                        <option value="all" 
                                            {{ isset($inputs['settings_professors_filter_status']) && $inputs['settings_professors_filter_status'] == 'all' ? 'selected' : '' }}>
                                            Todos
                                        </option>
                                        <option value="active"
                                            {{ isset($inputs['settings_professors_filter_status']) && $inputs['settings_professors_filter_status'] == 'active' ? 'selected' : '' }}>
                                            Ativos
                                        </option>
                                        <option value="non_active"
                                            {{ isset($inputs['settings_professors_filter_status']) && $inputs['settings_professors_filter_status'] == 'non_active' ? 'selected' : '' }}>
                                            Não Ativos
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group filters_dates">
                                    <label for="" class="label_title">Data Início</label>
                                    <input type="text" name="settings_professors_start_date" class="form-control" id="settings_professors_start_date" value="{{ $inputs['settings_professors_start_date'] ?? '' }}" readonly />
                                    <button class="btn search-btn comment_submit" id="reset-settings_professors_start_date">Limpar Data</button>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group filters_dates">
                                    <label for="" class="label_title">Data Fim</label>
                                    <input type="text" name="settings_professors_end_date" class="form-control" id="settings_professors_end_date" value="{{ $inputs['settings_professors_end_date'] ?? '' }}" readonly />
                                    <button class="btn search-btn comment_submit" id="reset-settings_professors_end_date">Limpar Data</button>
                                </div>
                            </div>

                            <div class="col-sm-0 col-md-4 col-lg-4">
                            </div>
                        </div>

                        <button class="btn search-btn comment_submit float-none professors" id="apply_filters">Aplicar</button>
                            
                    </div>
                </div>
            </div>
            <div class="dashboard_container_body">
                <div class="table-responsive">
                    <div class="preloader ajax professors col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="margin: auto !important;"><span></span><span></span></div>

                    @if(!$professors->count())

                        <div class="dashboard_container_header">
                            <div class="dashboard_fl_1">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <div class="form-group mb-0">
                                            <label for="" class="label_title none_professors_found" style="font-size: 18px;">Não foram encontrados Professores.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        
                        <table class="table prof">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nome de Utilizador</th>
                                    <th scope="col">Nome completo</th>
                                    <th scope="col">Data de Registo</th>
                                    <th scope="col">Aprovado</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($professors as $professor)
                                    <tr id="{{ $professor->id }}">
                                        <th scope="row"> <a href="/perfil/{{ $professor->id }}" target="_blank" class="link_on_table">{{ $professor->username }}</a> </th>
                                        <th scope="row">{{ isset($professor->first_name) && isset($professor->last_name) ? $professor->first_name . ' ' . $professor->last_name : '-' }}</th>
                                        <td>{{ date('d/m/Y', strtotime($professor->created_at)) }}</td>
                                        <td>
                                            <span class="payment_status validate_or_invalidate {{ $professor->isPreProfessor() ? 'inprogress' : 'complete' }}">
                                                    {{ $professor->isPreProfessor() ? 'Não' : 'Sim' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="payment_status activate_or_deactivate {{ $professor->active ? 'complete' : 'cancel' }}">
                                                    {{ $professor->active ? 'Ativo' : 'Não Ativo' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dash_action_link" style="text-align-last: center;">
                                                @if(!$professor->isPreProfessor())
                                                    <a href="#" class="validate_or_invalidate cancel" validate_or_invalidate="invalidate" data-id="{{ $professor->id }}">Desaprovar</a>
                                                @else
                                                    <a href="#" class="validate_or_invalidate view" validate_or_invalidate="validate" data-id="{{ $professor->id }}">Aprovar</a>
                                                @endif
                                                @if($professor->active)
                                                    <a href="#" class="activate_or_deactivate cancel" activate_or_deactivate="deactivate" data-id="{{ $professor->id }}">Desativar</a>
                                                @else
                                                    <a href="#" class="activate_or_deactivate view" activate_or_deactivate="activate" data-id="{{ $professor->id }}">Ativar</a>
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
    </div>
</div>

<input type="number" name="settings_professors_page" id="settings_professors_page_number" value="1" hidden="">
<input type="number" name="previous_settings_professors_page" id="previous_settings_professors_page_number" value="1" hidden="">

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        
        <!-- Pagination -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                {{ $professors->appends($inputs)->links('layouts.pagination-macau') }}
                
            </div>
        </div>
        
    </div>
</div>