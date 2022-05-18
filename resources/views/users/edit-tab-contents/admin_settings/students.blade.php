<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card-body p-0 mb-3 ml-1" style="background:none; box-shadow: none;">
            <label class="label_title">Gestão de Alunos</label>
        </div>
        <div class="dashboard_container card-body professor_validation_table student settings_table">
            <div class="dashboard_container_header">
                <div class="dashboard_fl_1">
                    <h4>
                        <a href="#collapse_students_filters" class="ml-auto p-0 b-0 align-self-center students_validation_filters_accordion expand_accordion collapsed"  data-toggle="collapse" data-parent="#accordion">
                            Filtros &nbsp;
                            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_black.svg', config()->get('app.https'))}}?v=2.4" class="expand_chevron" alt="">
                            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_up_pink.svg', config()->get('app.https'))}}?v=2.4" class="collapse_chevron" alt="" style="display: none;">
                        </a>
                    </h4>
                    <div id="collapse_students_filters" class="collapse" data-parent="#accordion">
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group">
                                    <label for="" class="label_title" style="font-size: 18px;">Nome de Utilizador</label>
                                    <input class="form-control" type="text" name="settings_students_filter_username" id="settings_students_filter_username" value="{{ $inputs['settings_students_filter_username'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="" class="label_title" style="font-size: 18px;">Estado</label>
                                    <select name="settings_students_filter_status" id="settings_students_filter_status" class="form-control">
                                        <option value="all" 
                                            {{ isset($inputs['settings_students_filter_status']) && $inputs['settings_students_filter_status'] == 'all' ? 'selected' : '' }}>
                                            Todos
                                        </option>
                                        <option value="active"
                                            {{ isset($inputs['settings_students_filter_status']) && $inputs['settings_students_filter_status'] == 'active' ? 'selected' : '' }}>
                                            Ativos
                                        </option>
                                        <option value="non_active"
                                            {{ isset($inputs['settings_students_filter_status']) && $inputs['settings_students_filter_status'] == 'non_active' ? 'selected' : '' }}>
                                            Não Ativos
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group filters_dates">
                                    <label for="" class="label_title">Data Início</label>
                                    <input type="text" name="settings_students_start_date" class="form-control" id="settings_students_start_date" value="{{ $inputs['settings_students_start_date'] ?? '' }}" readonly />
                                    <button class="btn search-btn comment_submit" id="reset-settings_students_start_date">Limpar Data</button>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group filters_dates">
                                    <label for="" class="label_title">Data Fim</label>
                                    <input type="text" name="settings_students_end_date" class="form-control" id="settings_students_end_date" value="{{ $inputs['settings_students_end_date'] ?? '' }}" readonly />
                                    <button class="btn search-btn comment_submit" id="reset-settings_students_end_date">Limpar Data</button>
                                </div>
                            </div>

                            <div class="col-sm-0 col-md-4 col-lg-4">
                            </div>
                        </div>

                        <button class="btn search-btn comment_submit float-none students" id="apply_filters">Aplicar</button>
                            
                    </div>
                </div>
            </div>
            <div class="dashboard_container_body">
                <div class="table-responsive">
                    <div class="preloader ajax students col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="margin: auto !important;"><span></span><span></span></div>

                    @if(!$students->count())

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
                        
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nome de Utilizador</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Apelido</th>
                                    <th scope="col">Data de Registo</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($students as $student)
                                    <tr id="{{ $student->id }}">
                                        <th scope="row"> <a href="/perfil/{{ $student->id }}" target="_blank" class="link_on_table">{{ $student->username }}</a> </th>
                                        <th scope="row">{{ $student->first_name ?? '-' }}</th>
                                        <th scope="row">{{ $student->last_name ?? '-' }}</th>
                                        <td>{{ date('d/m/Y', strtotime($student->created_at)) }}</td>
                                        <td>
                                            <span class="payment_status activate_or_deactivate {{ $student->active ? 'complete' : 'cancel' }}">
                                                    {{ $student->active ? 'Ativo' : 'Não Ativo' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dash_action_link">
                                                @if($student->active)
                                                    <a href="#" activate_or_deactivate="deactivate" data-id="{{ $student->id }}" class="activate_or_deactivate cancel">Desativar</a>
                                                @else
                                                    <a href="#" activate_or_deactivate="activate" data-id="{{ $student->id }}" class="activate_or_deactivate view">Ativar</a>
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

<input type="number" name="settings_students_page" id="settings_students_page_number" value="1" hidden="">
<input type="number" name="previous_settings_students_page" id="previous_settings_students_page_number" value="1" hidden="">

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        
        <!-- Pagination -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                {{ $students->appends($inputs)->links('layouts.pagination-macau') }}
                
            </div>
        </div>
        
    </div>
</div>
