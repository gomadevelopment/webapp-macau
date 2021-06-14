@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}?v=1.7">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}?v=1.7">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/classroom.css', config()->get('app.https')) }}?v=1.7">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/users.css', config()->get('app.https')) }}?v=1.7">

<link rel="stylesheet" href="{{asset('/assets/js/bootstrap-datepicker/dist/css/bootstrap-datepicker.css', config()->get('app.https')) }}" id="bscss">

@stop

@section('content')

<div class="alert alert-success successMsg global-alert" style="display:none;" role="alert">

</div>

<div class="alert alert-danger errorMsg global-alert" style="display:none;" role="alert">

</div>

@if (session('success'))
    <div class="global-alert alert alert-success" role="alert">
        {{session('success')}}
    </div>
@endif
@if (session('error'))
    <div class="global-alert alert alert-danger" role="alert">
        {{session('error')}}
    </div>
@endif

<section class="page-title classroom">
    <div class="container">
        
        <div class="row mb-5">
            {{-- My Profile --}}
            <div class="col-sm-12 col-md-4 col-lg-4 mb-5">
                <div class="wrap mb-3">
                    <h1 class="title">O meu Perfil</h1>
                </div>
                <div class="shop_grid_caption card-body m-0 p-4">
                    <div class="form-group d-flex flex-wrap justify-content-center m-0">
                        {{-- <img src="{{ $user->avatar_url ? '/webapp-macau-storage/avatars/'.$user->id.'/'.$user->avatar_url : 'https://via.placeholder.com/500x500'}}"
                        alt="" class="user_round_avatar"> --}}
                        <div style="background-size: 100%; background-repeat: no-repeat; background-image: url('{{$user->avatar_url ? '/webapp-macau-storage/avatars/'.$user->id.'/'.$user->avatar_url : 'https://via.placeholder.com/500x500'}}')" class="user_round_avatar">
                        </div>
                    </div>
                    <h4 class="sg_rate_title align-self-center text-center mt-3 mb-3">
                        {{ $user->username }}
                        @if ($user->university)
                            <p class="exercise_author align-self-center text-center">
                                <img src="{{asset('/assets/backoffice_assets/icons/Location.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 5px;">
                                {{ $user->university->name }}
                            </p>
                        @else
                        <br>
                        @endif
                        @if ($user->id == auth()->user()->id || auth()->user()->isAdmin())
                            <a href="/perfil/editar/{{ $user->id }}" class="btn search-btn comment_submit mt-4" style="float: none; padding: 12px 20px; font-size: 21px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Pencil.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Editar
                            </a>
                        @endif
                    </h4>
                </div>
            </div>

            {{-- About me / Professional path --}}
            <div class="col-sm-12 col-md-8 col-lg-8">
                <div class="wrap mb-3">
                    @if($user->user_role_id == 1 || $user->user_role_id == 2 || $user->user_role_id == 4)
                        <h1 class="title">Percurso Profissional</h1>
                    @else
                        <h1 class="title">Sobre mim</h1>
                    @endif
                    
                </div>
                <div class="shop_grid_caption card-body m-0 mb-4 pb-0">
                    @if($user->resume)
                    <div class="d-flex flex-column">
                        <p class="exercise_author" style="line-height: 25px;">
                            {{ $user->resume }}
                        </p>
                    </div>

                    <hr>
                    @endif

                    @if($user->user_role_id == 1 || $user->user_role_id == 2 || $user->user_role_id == 4)

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                                <h4 class="sg_rate_title">Mais informação</h4>
                                <div class="d-block text-left mt-3">
                                    <a href="/chat/{{ $user->id }}" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; font-size: 21px;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/contact.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                        Contactar
                                    </a>
                                </div>
                                @if ($user->linkedin_url)
                                    <div class="d-block text-left mt-3">
                                        {{-- LinkedIn logo --}}
                                        <a href="{{ $user->linkedin_url }}" target="_blank" 
                                        class="btn search-btn comment_submit" style="float: none; padding: 12px 44px; font-size: 21px; background-color: #0766c1; border-color: #0766c1;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/LinkedIn_Logo.svg')}}" alt="" style="width: 110%;">
                                        </a>
                                    </div>
                                @endif
                            </div>
                            @if($user->isPreProfessor())
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                                    <h4 class="sg_rate_title">A aguardar Validação</h4>
                                    <div class="d-block text-left mt-3">
                                        <p class="exercise_author" style="line-height: 25px; font-style: italic;">
                                            Enquanto não for aprovado, não poderá 
                                            utilizar as <strong style="line-height: 25px;">Ferramentas</strong> de <strong style="line-height: 25px;">Ensino</strong>.
                                        </p>
                                    </div>
                                    <div class="d-block text-left mt-3">
                                        @if($user->id == auth()->user()->id)
                                            <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; font-size: 21px;">
                                                <img src="{{asset('/assets/backoffice_assets/icons/contact.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                                Solicitar novamente
                                            </a>
                                        @else
                                            <a href="/activate_deactivate_user/{{ $user->id }}/true" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; font-size: 21px;">
                                                Aprovar Utilizador
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                    @else

                        <h4 class="sg_rate_title">Mais informação</h4>
                        @if ($user->university)
                        <div class="d-flex flex-column">
                            <p class="exercise_author"><strong>Instituição:</strong> {{ $user->university->name }} </p>
                        </div>
                        @endif
                        @if($user->student_class_user)
                        <div class="d-flex float-left flex-column">
                            <p class="exercise_author"><strong>Professor:</strong> 
                                <a href="/perfil/{{ $user->student_class_user->student_class->teacher->id }}" class="professor_link">
                                    {{ $user->student_class_user->student_class->teacher->username }}
                                    <img src="{{asset('/assets/backoffice_assets/icons/eye_outline.svg')}}" alt="" style="margin: 0 3px 2px 3px;">
                                </a>
                            </p>
                            <p class="exercise_author"><strong>Turma:</strong> {{ $user->student_class_user->student_class->name }}
                        </div>
                        @endif
                        <div class="d-block float-right mt-3 mb-4">
                            <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px; font-size: 21px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/contact.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Contactar
                            </a>
                        </div>

                    @endif
                        
                </div>
            </div>
        </div>

        @if($user->isProfessor() && $user->isActive())

            {{-- professor - promoted exercises --}}
            <form id="promoted_exercises_filters_form" class="" method="GET" autocomplete="off">
                @csrf
                <div class="row mb-5">
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-5 update_promoted_exercises">
                        
                        @include('users.promoted_exercises_partial')

                    </div>
                </div>
                <input type="number" name="page" id="page_number" value="1" hidden>
                <input type="number" name="previous_page" id="previous_page_number" value="1" hidden>
            </form>

        @elseif(($user->isStudent() && $user->id == auth()->user()->id && $user_exercises->count()) 
                || (auth()->user()->isProfessor() && auth()->user()->isActive() && auth()->user()->id != $user->id && $user_exercises->count()))

            {{-- student - My Performance --}}
            <div class="row mb-5">
                <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                    <div class="wrap mb-3">
                        @if($user->id == auth()->user()->id)
                            <h1 class="title">O meu Desempenho</h1>
                        @else
                            <h1 class="title">Desempenho do aluno {{ $user->username }}</h1>
                        @endif
                    </div>
                    <div class="dashboard_container card-body professor_validation_table settings_table" 
                        style="position: relative; overflow: hidden; display: block;">

                        <div class="dashboard_container_header" id="performance_filters">
                            <div class="dashboard_fl_1">
                                <h4>
                                    <a href="#collapse_performance_filters" class="ml-auto p-0 b-0 align-self-center expand_accordion collapsed" data-toggle="collapse" data-parent="#accordion">
                                        Filtros &nbsp;
                                        <img src="{{asset('/assets/backoffice_assets/icons/Chevron_black.svg')}}" class="expand_chevron" alt="">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Chevron_up_pink.svg')}}" class="collapse_chevron" alt="" style="display: none;">
                                    </a>
                                </h4>
                                <div id="collapse_performance_filters" class="collapse" data-parent="#accordion">
                                    <div class="row align-items-center">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="" class="label_title" style="font-size: 18px;">Níveis de Exercícios</label>
                                                <div class="low_z_index">
                                                    <select name="performance_filters_levels" id="performance_filters_levels" class="form-control" multiple>
                                                        @foreach ($levels as $level)
                                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group filters_dates">
                                                <label for="" class="label_title">Data Início</label>
                                                <input type="text" name="performance_filters_start_date" class="form-control" id="performance_filters_start_date" value="" readonly />
                                                <button class="btn search-btn comment_submit" id="reset-performance_filters_start_date">Limpar Data</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="" class="label_title" style="font-size: 18px;">Temas</label>
                                                <div class="low_z_index">
                                                    <select name="performance_filters_categories" id="performance_filters_categories" class="form-control" multiple>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group filters_dates">
                                                <label for="" class="label_title">Data Fim</label>
                                                <input type="text" name="performance_filters_end_date" class="form-control" id="performance_filters_end_date" value="" readonly />
                                                <button class="btn search-btn comment_submit" id="reset-performance_filters_end_date">Limpar Data</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="" class="label_title" style="font-size: 18px;">Tipos de Questões contidas</label>
                                                <div class="low_z_index">
                                                    <select name="performance_filters_question_types" id="performance_filters_question_types" class="form-control" multiple>
                                                        @foreach ($question_types_subtypes as $question_type)
                                                            <optgroup label="{{ $question_type->name }}">
                                                                @foreach ($question_type->subtypes as $subtype)
                                                                    <option value="{{ $subtype->id }}">{{ $subtype->name }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="" class="label_title" style="font-size: 18px;">Legenda</label>
                                                <div id="choices" class="form-control d-inline-flex" style="margin-left: auto;"></div>
                                            </div>
                                        </div> --}}

                                    </div>

                                    <button class="btn search-btn comment_submit float-none professors" id="apply_filters">Aplicar</button>
                                        
                                </div>
                            </div>
                        </div>

                        <div class="preloader ajax performance col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="height: 500px !important; margin: auto !important;"><span></span><span></span></div>

                        <div class="dashboard_container_body p-3">

                            {{-- <div id="performance_graph_placeholder" style="background: url({{asset('/assets/backoffice_assets/icons/performance_icon.svg')}}) no-repeat;"></div> --}}
                            
                            <div id="performance_graph_placeholder" style="background: url({{asset('/assets/backoffice_assets/icons/performance_icon.svg')}}) no-repeat;"></div>

                            {{-- <button type="button" class="btn search-btn comment_submit float-none" id="download_pdf">Exportar para PDF</button> --}}

                        </div>
                        
                    </div>
                </div>
            </div>

        @endif
        
    </div>

</section>

{{-- {{ dd((auth()->user()->isProfessor() && auth()->user()->isActive() && auth()->user()->id != $user->id && $user_exercises->count())) }} --}}

<input type="hidden" name="show_performance" id="show_performance" 
    value="{{ ($user->isStudent() && $user->id == auth()->user()->id && $user_exercises->count()) 
                || (auth()->user()->isProfessor() && auth()->user()->isActive() && auth()->user()->id != $user->id && $user_exercises->count()) ? true : false }}">
<input type="text" name="hidden_user_id" id="hidden_user_id" value="{{ $user->id }}" hidden>
<input type="text" name="hidden_user_name" id="hidden_user_name" value="{{ $user->username }}" hidden>


@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https')) }}?v=1.7"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https')) }}?v=1.7"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/exercises.js', config()->get('app.https')) }}?v=1.7"></script>

    <script src="{{asset('/assets/js/bootstrap-datepicker/dist/js/bootstrap-datepicker.js', config()->get('app.https'))}}"></script>
    <script src="{{asset('/assets/js/bootstrap-datepicker/dist/js/bootstrap-datepicker.pt.min.js', config()->get('app.https'))}}"></script>

    {{-- HighCharts --}}
    <script src="https://code.highcharts.com/highcharts.js?v=1.7"></script>
    <script src="https://code.highcharts.com/modules/data.js?v=1.7"></script>
    <script src="https://code.highcharts.com/modules/series-label.js?v=1.7"></script>
    <script src="https://code.highcharts.com/modules/exporting.js?v=1.7"></script>
    <script src="https://code.highcharts.com/modules/export-data.js?v=1.7"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js?v=1.7"></script>

    <!-- Additional files for the Highslide popup effect -->
    {{-- <script src="https://www.highcharts.com/samples/static/highslide-full.min.js"></script>
    <script src="https://www.highcharts.com/samples/static/highslide.config.js" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="https://www.highcharts.com/samples/static/highslide.css" /> --}}

    <script>

        var high_chart = null;

        var user_exercises = {!! json_encode($user_exercises) !!};
        
        var toggleAxisExtremes = function(event) {
            var series = event.target,
                yAxis = series.yAxis;
 
            if (event.type === "show") {
                    (yAxis.oldExtremes) ? yAxis.setExtremes(yAxis.oldExtremes.min, yAxis.oldExtremes.max, true, false) : false;
            } else if (event.type === "hide"){
                    yAxis.oldExtremes = {
                        min: yAxis.min,
                    max: yAxis.max
                }
                    yAxis.setExtremes("null")
            }
        }
        
        $(function() {

            var options2 = {

                chart: { 
                    alignTicks: false,
                    zoomType: 'x'
                },

                lang: {
                    exitFullscreen: 'Sair de Ecrã Inteiro',
                },

                title: {
                    text: 'Desempenho do Aluno: ' + $('#hidden_user_name').val()
                },

                subtitle: {
                    style: {
                        color: '#131b31',
                    }
                },

                yAxis: [
                    { // Desempenho yAxis
                        title: false,
                        min: 0,
                        max: 100,
                        labels: {
                            format: '{value}%',
                            style: {
                                color: '#795548'
                            }
                        },
                        tickInterval: 25,
                    }, 
                    { // Avaliação yAxis
                        title: false,
                        min: 0,
                        max: 100,
                        labels: {
                            format: '{value}%',
                            style: {
                                color: '#00b265'
                            }
                        },
                        tickInterval: 25,
                    }, 
                    { // Ansiedade yAxis
                        title: false,
                        min: 1,
                        max: 5,
                        labels: {
                            format: '{value}',
                            style: {
                                color: '#ff9b20'
                            }
                        },
                        tickInterval: 1,
                    }
                ],

                xAxis: {
                    tickInterval: 1,
                },

                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'top'
                },

                plotOptions: {
                    series: {
                        label: {
                            enabled: false,
                            // connectorAllowed: false
                        },
                        events: {
                            show: toggleAxisExtremes,
                            hide: toggleAxisExtremes
                        }
                    }
                },

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                },

                exporting: {
                    menuItemDefinitions: {
                        viewFullscreen: {
                            text: 'Ver em Ecrã inteiro'
                        },
                        printChart: {
                            onclick: function () {
                                this.print();
                            },
                            text: 'Imprimir gráfico'
                        },
                        separator: true,
                        downloadPNG: {
                            onclick: function () {
                                this.exportChart();
                            },
                            text: 'Exportar para Imagem'
                        },
                        downloadPDF: {
                            onclick: function() {
                                // Highcharts.exportCharts(
                                //     [high_chart], 
                                //     {
                                //         type: 'image/png',
                                //         filename: 'Desempenho do Aluno: ' + $('#hidden_user_name').val()
                                //     }, 
                                //     'performance_filters'
                                // );
                                this.exportChart({
                                    type: 'application/pdf'
                                });
                            },
                            text: 'Exportar para PDF'
                        },
                    },
                    buttons: {
                        contextButton: {
                            menuItems: ['viewFullscreen', 'printChart', 'separator', 'downloadPNG', 'downloadPDF']
                        }
                    }
                },

                navigation: {
                    menuItemStyle: {
                        fontWeight: 'normal',
                        background: 'none',
                        color: '#131b31'
                    },
                    menuItemHoverStyle: {
                        fontWeight: 'bold',
                        background: '#ff2850',
                        color: 'white'
                    }
                },

                credits: {
                    enabled: false
                },

            };

            Highcharts.setOptions({
                lang: {
                    resetZoom: 'Cancelar Zoom'
                }
            });

            if($('#show_performance').val()){
                applyHighChart(user_exercises);
            }

            function applyHighChart(user_exercises){

                
                var performance_data_array = [];
                var evaluation_data_array = [];
                var anxiety_data_array = [];

                user_exercises.forEach((exercise, index) => {

                    performance_data_array.push([exercise.exercise.title, parseFloat(exercise.performance)]);
                    evaluation_data_array.push([exercise.exercise.title, parseFloat(exercise.classification_median)]);
                    anxiety_data_array.push([exercise.exercise.title, parseFloat(exercise.anxiety_median)]);
                    
                });

                var performance_data = {
                    name: 'Desempenho',
                    data: performance_data_array,
                    color: '#795548'
                };

                var evaluation_data = {
                    name: 'Avaliação',
                    data: evaluation_data_array,
                    color: '#00b265',
                    yAxis: 1,
                };

                var anxiety_data = {
                    name: 'Ansiedade',
                    data: anxiety_data_array,
                    color: '#ff9b20',
                    yAxis: 2,
                };

                options2.xAxis.labels = {
                    enabled: true,
                    formatter: function(){
                        return '<a href="/exercicios/realizar/'+user_exercises[this.value].exercise.id+'" target="_blank" class="link_on_chart">'+performance_data_array[this.value][0]+'</a>';
                    },
                    rotation: -30,
                    // align: 'right',
                    // verticalAlign: 'top'
                };

                options2.series = [
                    performance_data, 
                    evaluation_data,
                    anxiety_data
                ];

                options2.tooltip = {
                    shared: true,
                    headerFormat: "",
                    pointFormatter: function() {
                        let y = parseFloat(this.y);
                        var perc = '';
                        if(this.series.name == 'Desempenho' || this.series.name == 'Avaliação'){
                            perc = '%'
                        }
                        return "<span style=\"color:"+this.series.color+"\">■</span> "+this.series.name+": <b>"+ y + perc +"</b></br>"
                    }
                }

                high_chart = Highcharts.chart('performance_graph_placeholder', options2);
            }
                
            /////////////
            
            // FILTERS

            $('#performance_filters_levels, #performance_filters_categories, #performance_filters_question_types').select2();

            $("#performance_filters_start_date, #performance_filters_end_date").datepicker({
                format: "dd/mm/yyyy",
                orientation: 'bottom'
            });    

            $('#performance_filters_start_date, #performance_filters_end_date').datepicker().on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });

            $("#reset-performance_filters_start_date").click(function () {
                $('#performance_filters_start_date').val("").datepicker("update");
            });

            $("#reset-performance_filters_end_date").click(function () {
                $('#performance_filters_end_date').val("").datepicker("update");
            });

            // Apply Filters
            $(document).on('click', '#apply_filters', function(e){
                e.preventDefault();

                $(".dashboard_container_body").hide();
                $('.preloader.ajax.performance')
                    .css('height', $(".dashboard_container_body").height())
                    .show();
                
                var data = {
                    by_student_or_class : 'by_student',
                    user_id : $('#hidden_user_id').val(),
                    performance_filters_levels: $('#performance_filters_levels').val(),
                    performance_filters_categories: $('#performance_filters_categories').val(),
                    performance_filters_question_types: $('#performance_filters_question_types').val(),
                    performance_filters_start_date: $('#performance_filters_start_date').val(),
                    performance_filters_end_date: $('#performance_filters_end_date').val(),
                };

                $.ajax({
                    type: 'GET',
                    url: '/performance_filters',
                    data: data,
                    success: function(response){
                        if (response && response.status == "success") {

                            $(".dashboard_container_body").show();
                            $('.preloader.ajax.performance').hide();

                            user_exercises = response.user_exercises;
                            applyHighChart(response.user_exercises);
                            addFiltersToChart(data);
                        }
                        else {
                            $(".errorMsg").text(response.message);
                            $(".errorMsg").fadeIn();
                            setTimeout(() => {
                                $(".errorMsg").fadeOut();
                            }, 2000);
                        }
                    }
                });
            });

            function addFiltersToChart(filters){
                var filters_subtitle = '';

                if(filters.performance_filters_levels){
                    filters.performance_filters_levels.forEach((element, index) => {
                        if(index == 0){
                            filters_subtitle += '<b>Níveis de Exercícios: </b>' + $("#performance_filters_levels option[value='"+element+"']").text();
                        }
                        else{
                            filters_subtitle += ', ' + $("#performance_filters_levels option[value='"+element+"']").text();
                        }
                    });
                }

                if(filters.performance_filters_categories){
                    filters.performance_filters_categories.forEach((element, index) => {
                        if(index == 0){
                            if(filters_subtitle != ''){
                                filters_subtitle += ' | ';
                            }
                            filters_subtitle += '<b>Temas: </b>' + $("#performance_filters_categories option[value='"+element+"']").text();
                        }
                        else{
                            filters_subtitle += ', ' + $("#performance_filters_categories option[value='"+element+"']").text();
                        }
                    });
                }

                if(filters.performance_filters_question_types){
                    filters.performance_filters_question_types.forEach((element, index) => {
                        if(index == 0){
                            if(filters_subtitle != ''){
                                filters_subtitle += ' | ';
                            }
                            filters_subtitle += '<b>Questões: </b>' + $("#performance_filters_question_types option[value='"+element+"']").text();
                        }
                        else{
                            filters_subtitle += ', ' + $("#performance_filters_question_types option[value='"+element+"']").text();
                        }
                    });
                }

                if(filters.performance_filters_start_date != ''){
                    filters_subtitle += '<br><b>Data Ínicio: </b>' + $("#performance_filters_start_date").val();
                }

                if(filters.performance_filters_end_date != ''){
                    if(filters_subtitle != ''){
                        filters_subtitle += ' | ';
                    }
                    filters_subtitle += '<b>Data Fim: </b>' + $("#performance_filters_end_date").val();
                }

                high_chart.setTitle(null, { text: filters_subtitle});
            }

            ///////////////

            function expandCollapseAccordion(selector){
                if(!$(selector).hasClass('expanded')){
                    $(selector).addClass('expanded');
                    $(selector).css('border', 'none');
                    $(selector).find('img.expand_chevron').hide();
                    $(selector).find('img.collapse_chevron').show();
                }
                else{
                    $(selector).removeClass('expanded');
                    $(selector).css('border', 'none');
                    $(selector).find('img.expand_chevron').show();
                    $(selector).find('img.collapse_chevron').hide();
                }
            }

            $(document).on('click', '.expand_accordion', function(){
                expandCollapseAccordion($(this));
            });

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('input[name="_token"]').attr("value")
                }
            });

            // Update promoted exercises pagination
            $(document).on('click', '.pagination li a', function(e){

                // Pagination
                if($(this).parent().hasClass('page-item')){
                    e.preventDefault();
                    if($(this).attr('data-page') == 1){
                        $('#previous_page_number').attr('value', 1);
                    }
                    else{
                        $('#previous_page_number').attr('value', $('#page_number').attr('value'));
                    }
                    
                    $('#page_number').attr('value', $(this).attr('data-page'));
                    
                    $('.pagination li').each(function(index, element){
                        $(element).removeClass('active');
                    });
                    $(this).parent().addClass('active');
                    $("html, body").animate({ scrollTop: 0 }, 500);
                }

                var form_array;
                setTimeout(function () {
                    form_array = $("#promoted_exercises_filters_form").serialize();
                    // console.log($('#hidden_user_id').val(), form_array);
                    $.ajax({
                        url: "/perfil/" + $('#hidden_user_id').val(),
                        type: "GET",
                        dataType: "JSON",
                        data: form_array,
                        success: function (response) {
                            if(response && response.status == 'success'){
                                $(".update_promoted_exercises").html(response.html);
                                // if ($('ul.pagination').length && response.changed_page){
                                //     if($('a[data-page="1"]').length){
                                //         $('a[data-page="1"]').click();
                                //     }
                                // }
                            }
                            else{
                                $(".errorMsg").text(response.message);
                                $(".errorMsg").fadeIn();
                                setTimeout(() => {
                                    $(".errorMsg").fadeOut();
                                }, 10000);
                            }
                        }
                    });
                }, 50);
            });

        });

    </script>

@stop