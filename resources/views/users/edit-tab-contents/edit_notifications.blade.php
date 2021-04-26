<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card-body p-0 mb-3 ml-1" style="background:none; box-shadow: none;">
            <label class="label_title">Ligar/Desligar Notificações</label>
        </div>
        <div class="dashboard_container card-body professor_validation_table notification_validation_table notificaiton settings_table">
            <div class="dashboard_container_body">
                <div class="table-responsive">
                    <div class="preloader ajax notifications col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="margin: auto !important;"><span></span><span></span></div>

                    @if(!$notification_types->count())

                        <div class="dashboard_container_header">
                            <div class="dashboard_fl_1">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <div class="form-group mb-0">
                                            <label for="" class="label_title none_professors_found" style="font-size: 18px;">Não foram encontrados tipos de Notificações.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        
                        <table class="table prof">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Tipo de Notificação</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($notification_types as $notification_type)
                                    <tr id="{{ $notification_type->id }}">
                                        <th scope="row">{{ $notification_type->name }}</th>
                                        <?php $type = 'notification_type_' . $notification_type->id; ?>
                                        <td>
                                            <span class="payment_status activate_or_deactivate {{ auth()->user()->$type ? 'complete' : 'cancel' }}">
                                                    {{ auth()->user()->$type ? 'Ligadas' : 'Desligadas' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dash_action_link">
                                                @if(auth()->user()->$type)
                                                    <a href="#" class="activate_or_deactivate cancel" activate_or_deactivate="deactivate" data-id="{{ $notification_type->id }}">Desligar</a>
                                                @else
                                                    <a href="#" class="activate_or_deactivate view" activate_or_deactivate="activate" data-id="{{ $notification_type->id }}">Ligar</a>
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