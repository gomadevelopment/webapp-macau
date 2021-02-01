@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}">

@stop

@section('content')
<div class="alert alert-success successMsg" style="display:none;" role="alert">

</div>

<div class="alert alert-danger errorMsg" style="display:none;" role="alert">

</div>

<form id="exercises_filters_form" class="" method="GET" autocomplete="off">
    @csrf

    <section class="page-title articles">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    
                    <div class="wrap">
                        <h1 class="title">Exercícios</h1>
                    </div>
                    @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)
                        <div class="dropdown create_article">
                            <a href="/exercicios/criar" class="btn btn-theme btn-custom dropdown-toggle">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt=""> 
                            Criar Exercício</a>
                        </div>
                    @endif
                    <div class="show_favorites">
                        <input id="my_favorites" class="checkbox-custom" name="my_favorites" type="checkbox">
                        <label for="my_favorites" class="checkbox-custom-label">Meus Favoritos</label>                    
                    </div>
                    <div class="dropdown order_by">
                        <a class="btn btn-custom dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ordenar por <img src="{{asset('/assets/backoffice_assets/icons/Sort.svg')}}" alt="" style="margin-left: 10px;">
                        </a>
                        <span class="dropdown-menu-arrow"></span>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item exercise_order_by_date_asc" href="#">Data (Ascendente)</a>
                            <input type="text" name="exercise_order_by_date_asc" id="exercise_order_by_date_asc" value="off" hidden>
                            <a class="dropdown-item exercise_order_by_date_desc" href="#">Data (Descendente)</a>
                            <input type="text" name="exercise_order_by_date_desc" id="exercise_order_by_date_desc" value="off" hidden>
                        </div>
                    </div>
                    <div class="dropdown show-23 ml-0">
                        <a href="javascript:void(0)" class="btn btn-theme btn-custom dropdown-toggle arrow-btn filter_open dn db-991 mt30 mb0 show-23" 
                        onclick="openNav()" id="open2" style="background-color: #ff2850;">
                        Mostrar Filtros<span><i class="fas fa-arrow-alt-circle-right" style="color: #fff;"></i></span></a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0">
        <div class="container">
            
            <!-- Onclick Mobile Sidebar -->
            <div class="row">
                <div class="col-md-12 col-sm-12">							
                    <div id="filter-sidebar" class="filter-sidebar">
                        <div class="filt-head">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="ti-close"></i></a>
                        </div>
                        <div class="show-hide-sidebar">
                            <div class="sidebar-widgets page_sidebar">

                                <div class="page-title p-0">
                                    <div class="show_favorites float-none mr-auto ml-auto mb-3" style="width: fit-content;">
                                        <input id="show_my_favorites_mobile" class="checkbox-custom" name="show_my_favorites_mobile" type="checkbox">
                                        <label for="show_my_favorites_mobile" class="checkbox-custom-label">Meus Favoritos</label>                    
                                    </div>
                                    <div class="dropdown order_by d-block float-none mr-auto ml-auto mb-3" style="width: fit-content;">
                                        <a class="btn btn-custom dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ordenar por <img src="{{asset('/assets/backoffice_assets/icons/Sort.svg')}}" alt="" style="margin-left: 10px;">
                                        </a>
                                        <span class="dropdown-menu-arrow"></span>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#">Data (Ascendente)</a>
                                            <a class="dropdown-item" href="#">Data (Descendente)</a>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="side_title">Nível</h4>
                                <ul class="no-ul-list mb-3 levels">
                                    <li>
                                        <input id="show_a1_mobile" class="checkbox-custom" name="show_a1_mobile" type="checkbox" checked>
                                        <label for="show_a1_mobile" class="checkbox-custom-label">A1</label>
                                    </li>
                                    <li>
                                        <input id="show_a2_mobile" class="checkbox-custom" name="show_a2_mobile" type="checkbox">
                                        <label for="show_a2_mobile" class="checkbox-custom-label">A2</label>
                                    </li>
                                    <li>
                                        <input id="show_a3_mobile" class="checkbox-custom" name="show_a3_mobile" type="checkbox">
                                        <label for="show_a3_mobile" class="checkbox-custom-label">A3</label>
                                    </li>
                                    <a href="#" class="show_more_levels">
                                        Mostrar tudo <div class="triangle-down"></div>
                                    </a>
                                    <a href="#" class="show_less_levels">
                                        Mostrar menos <div class="triangle-up"></div>
                                    </a>
                                </ul>
                                
                                <h4 class="side_title">Categorias</h4>
                                <ul class="no-ul-list mb-3 categories">
                                    <li>
                                        <input id="cat_all_mobile" class="checkbox-custom" name="cat_all_mobile" type="checkbox" checked>
                                        <label for="cat_all_mobile" class="checkbox-custom-label">Tudo</label>
                                    </li>
                                    <li>
                                        <input id="cat_justice_mobile" class="checkbox-custom" name="cat_justice_mobile" type="checkbox">
                                        <label for="cat_justice_mobile" class="checkbox-custom-label">Justiça</label>
                                    </li>
                                    <li>
                                        <input id="cat_literature_mobile" class="checkbox-custom" name="cat_literature_mobile" type="checkbox">
                                        <label for="cat_literature_mobile" class="checkbox-custom-label">Literatura</label>
                                    </li>
                                    <li>
                                        <input id="cat_environment_mobile" class="checkbox-custom" name="cat_environment_mobile" type="checkbox">
                                        <label for="cat_environment_mobile" class="checkbox-custom-label">Meio Ambiente</label>
                                    </li>
                                    <li>
                                        <input id="cat_transports_mobile" class="checkbox-custom" name="cat_transports_mobile" type="checkbox">
                                        <label for="cat_transports_mobile" class="checkbox-custom-label">Transportes</label>
                                    </li>
                                    <li>
                                        <input id="cat_professional_life_mobile" class="checkbox-custom" name="cat_professional_life_mobile" type="checkbox">
                                        <label for="cat_professional_life_mobile" class="checkbox-custom-label">Vida Profissional</label>
                                    </li>
                                    <li>
                                        <input id="cat_grammar_mobile" class="checkbox-custom" name="cat_grammar_mobile" type="checkbox">
                                        <label for="cat_grammar_mobile" class="checkbox-custom-label">Gramática</label>
                                    </li>
                                    <li>
                                        <input id="cat_sintax_mobile" class="checkbox-custom" name="cat_sintax_mobile" type="checkbox">
                                        <label for="cat_sintax_mobile" class="checkbox-custom-label">Sintáx</label>
                                    </li>
                                    <a href="#" class="show_more_categories">
                                        Mostrar tudo <div class="triangle-down"></div>
                                    </a>
                                    <a href="#" class="show_less_categories">
                                        Mostrar menos <div class="triangle-up"></div>
                                    </a>
                                </ul>
                                
                                <h4 class="side_title">Tags</h4>
                                <div class="filter_tags">
                                    <a href="#" class="cancel">Gramática</a>
                                    <a href="#" class="cancel">Verbos</a>
                                    <a href="#" class="cancel">Experiências</a>
                                    <a href="#" class="cancel">Sintax</a>
                                    <a href="#" class="cancel">Ciência</a>
                                </div>
                                <a href="#" class="show_more_tags">
                                    Mostrar tudo <div class="triangle-down"></div>
                                </a>
                                <a href="#" class="show_less_tags">
                                    Mostrar menos <div class="triangle-up"></div>
                                </a>

                                <h4 class="side_title">Professor</h4>
                                <ul class="no-ul-list mb-3 professors">
                                    <li>
                                        <input id="show_my_exercises_mobile" class="checkbox-custom" name="show_my_exercises_mobile" type="checkbox" checked>
                                        <label for="show_my_exercises_mobile" class="checkbox-custom-label">Os meus Exercicios</label>
                                    </li>
                                    <li>
                                        <input id="show_joao_paulo_mobile" class="checkbox-custom" name="show_joao_paulo_mobile" type="checkbox">
                                        <label for="show_joao_paulo_mobile" class="checkbox-custom-label">João Paulo</label>
                                    </li>
                                    <li>
                                        <input id="show_luis_antunes_mobile" class="checkbox-custom" name="show_luis_antunes_mobile" type="checkbox">
                                        <label for="show_luis_antunes_mobile" class="checkbox-custom-label">Luis Antunes</label>
                                    </li>
                                    <a href="#" class="show_more_professors">
                                        Mostrar tudo <div class="triangle-down"></div>
                                    </a>
                                    <a href="#" class="show_less_professors">
                                        Mostrar menos <div class="triangle-up"></div>
                                    </a>
                                </ul>

                                <h4 class="side_title">Visibilidade</h4>
                                <ul class="no-ul-list mb-3 visibility">
                                    <li>
                                        <input id="show_vis_all_mobile" class="checkbox-custom" name="show_vis_all_mobile" type="checkbox" checked>
                                        <label for="show_vis_all_mobile" class="checkbox-custom-label">Todos</label>
                                    </li>
                                    <li>
                                        <input id="show_vis_my_students_mobile" class="checkbox-custom" name="show_vis_my_students_mobile" type="checkbox">
                                        <label for="show_vis_my_students_mobile" class="checkbox-custom-label">Só para os meus Alunos</label>
                                    </li>
                                    <li>
                                        <input id="show_vis_professors_mobile" class="checkbox-custom" name="show_vis_professors_mobile" type="checkbox">
                                        <label for="show_vis_professors_mobile" class="checkbox-custom-label">Só para Professores</label>
                                    </li>
                                    <a href="#" class="show_more_visibility">
                                        Mostrar tudo <div class="triangle-down"></div>
                                    </a>
                                    <a href="#" class="show_less_visibility">
                                        Mostrar menos <div class="triangle-up"></div>
                                    </a>
                                </ul>
                                
                            </div>
                            
                        </div>
                    </div>
                    
                </div>	
            </div>

            <!-- Row -->
            <div class="row">
                
                {{-- Sidebar --}}
                <div class="col-lg-3 col-md-12 col-sm-12 order-2 order-lg-1 order-md-2">							
                    <div class="page_sidebar hide-23">

                        <h4 class="side_title">Nível</h4>
                        <ul class="no-ul-list mb-3 levels">
                            <li>
                                <input id="all_levels" class="checkbox-custom" name="all_levels" type="checkbox" {{ isset($inputs['all_levels']) ? 'checked' : ''}}>
                                <label for="all_levels" class="checkbox-custom-label lev all_levels">Todos</label>
                            </li>
                            @foreach ($exercises_levels as $level)
                                <li>
                                    <input id="level_{{ $level->name }}" class="checkbox-custom" name="levels[]" type="checkbox" 
                                    value="{{ $level->id }}" {{ isset($inputs['levels']) && in_array($category->id, $inputs['levels']) ? 'checked' : '' }}>
                                    <label for="level_{{ $level->name }}" class="checkbox-custom-label lev level_{{ $level->name }}">{{ $level->name }}</label>
                                </li>
                            @endforeach
                            {{-- <li>
                                <input id="show_a1" class="checkbox-custom" name="show_a1" type="checkbox" checked>
                                <label for="show_a1" class="checkbox-custom-label">A1</label>
                            </li>
                            <li>
                                <input id="show_a2" class="checkbox-custom" name="show_a2" type="checkbox">
                                <label for="show_a2" class="checkbox-custom-label">A2</label>
                            </li>
                            <li>
                                <input id="show_a3" class="checkbox-custom" name="show_a3" type="checkbox">
                                <label for="show_a3" class="checkbox-custom-label">A3</label>
                            </li> --}}
                            <a href="#" class="show_more_levels">
                                Mostrar tudo <div class="triangle-down"></div>
                            </a>
                            <a href="#" class="show_less_levels">
                                Mostrar menos <div class="triangle-up"></div>
                            </a>
                        </ul>
                        
                        <h4 class="side_title">Categorias</h4>
                        <ul class="no-ul-list mb-3 categories">
                            <li>
                                <input id="all_categories" class="checkbox-custom" name="all_categories" type="checkbox" {{ isset($inputs['all_categories']) ? 'checked' : ''}}>
                                <label for="all_categories" class="checkbox-custom-label cat all_categories">Todas</label>
                            </li>
                            @foreach ($exercises_categories as $category)
                                <li>
                                    <input id="category_{{ $category->name }}" class="checkbox-custom" name="categories[]" type="checkbox" 
                                    value="{{ $category->id }}" {{ isset($inputs['categories']) && in_array($category->id, $inputs['categories']) ? 'checked' : '' }}>
                                    <label for="category_{{ $category->name }}" class="checkbox-custom-label cat category_{{ $category->name }}">{{ $category->name }}</label>
                                </li>
                            @endforeach
                            <a href="#" class="show_more_categories">
                                Mostrar tudo <div class="triangle-down"></div>
                            </a>
                            <a href="#" class="show_less_categories">
                                Mostrar menos <div class="triangle-up"></div>
                            </a>
                        </ul>
                        
                        <h4 class="side_title">Tags</h4>
                        <div class="filter_tags">
                            @foreach ($tags as $tag)
                                <input type="checkbox" name="tags[]" id="tag_{{ $tag->name }}" value="{{ $tag->id }}" hidden>
                                <label for="tag_{{ $tag->name }}" class="cancel tag_{{ $tag->name }}">{{ $tag->name }}</label>
                            @endforeach
                        </div>
                        <a href="#" class="show_more_tags">
                            Mostrar tudo <div class="triangle-down"></div>
                        </a>
                        <a href="#" class="show_less_tags">
                            Mostrar menos <div class="triangle-up"></div>
                        </a>

                        <h4 class="side_title mt-3">Professor</h4>
                        <ul class="no-ul-list mb-3 professors">
                            <li>
                                <input id="show_all_professors" class="checkbox-custom" name="show_all_professors" type="checkbox" checked>
                                <label for="show_all_professors" class="checkbox-custom-label prof show_all_professors">Todos</label>
                            </li>
                            @if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)
                                <li>
                                    <input id="show_{{ auth()->user()->username }}" class="checkbox-custom" name="show_professors[]" type="checkbox" 
                                    value="{{ auth()->user()->id }}" {{ isset($inputs['show_professors']) && in_array(auth()->user()->id, $inputs['show_professors']) ? 'checked' : '' }}>
                                    <label for="show_{{ auth()->user()->username }}" class="checkbox-custom-label prof professor_{{ auth()->user()->username }}">Os meus Exercicios</label>
                                </li>
                            @endif
                            @foreach ($professors as $professor)
                                <li>
                                    <input id="show_{{ $professor->username }}" class="checkbox-custom" name="show_professors[]" type="checkbox" 
                                    value="{{ $professor->id }}" {{ isset($inputs['show_professors']) && in_array($professor->id, $inputs['show_professors']) ? 'checked' : '' }}>
                                    <label for="show_{{ $professor->username }}" class="checkbox-custom-label prof professor_{{ $professor->username }}">{{ $professor->username }}</label>
                                </li>
                            @endforeach
                            
                            <a href="#" class="show_more_professors">
                                Mostrar tudo <div class="triangle-down"></div>
                            </a>
                            <a href="#" class="show_less_professors">
                                Mostrar menos <div class="triangle-up"></div>
                            </a>
                        </ul>

                        @if (auth()->user()->user_role_id != 3)
                            <h4 class="side_title">Visibilidade</h4>
                            <ul class="no-ul-list mb-3 visibility">
                                <li>
                                    <input id="show_vis_all" class="checkbox-custom" name="show_vis_all" type="checkbox" checked>
                                    <label for="show_vis_all" class="checkbox-custom-label show_vis_all">Todos</label>
                                </li>
                                <li>
                                    <input id="show_vis_my_students" class="checkbox-custom" name="show_vis_my_students" type="checkbox">
                                    <label for="show_vis_my_students" class="checkbox-custom-label show_vis_my_students">Só para os meus Alunos</label>
                                </li>
                                {{-- <li>
                                    <input id="show_vis_professors" class="checkbox-custom" name="show_vis_professors" type="checkbox">
                                    <label for="show_vis_professors" class="checkbox-custom-label">Só para Professores</label>
                                </li>
                                <a href="#" class="show_more_visibility">
                                    Mostrar tudo <div class="triangle-down"></div>
                                </a>
                                <a href="#" class="show_less_visibility">
                                    Mostrar menos <div class="triangle-up"></div>
                                </a> --}}
                            </ul>
                        @endif
                        
                        
                    </div>
                    
                </div>	
                <div class="preloader ajax col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2"><span></span><span></span></div>
                <div class="col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2 order-md-1 update_exercises_list">

                    @include('exercises.exercises_list_partial')
                    
                </div>
                <input type="text" name="exercise_to_delete_id" id="exercise_to_delete_id" hidden disabled>
            
            </div>
            <!-- Row -->
            
        </div>
    </section>
    <input type="number" name="page" id="page_number" value="1" hidden>
    <input type="number" name="previous_page" id="previous_page_number" value="1" hidden>

</form>
@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https'))}}"></script>
    {{-- <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https'))}}"></script> --}}
    <script src="{{asset('/assets/js/webapp-macau-custom-js/exercises.js', config()->get('app.https'))}}"></script>

    <script>
        function openNav() {
            document.getElementById("filter-sidebar").style.width = "320px";
        }

        function closeNav() {
            document.getElementById("filter-sidebar").style.width = "0";
        }

        $(function(){
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('input[name="_token"]').attr("value")
                }
            });

            // Article Heart like
            $(document).on("click", ".heart_icon, .heart_filled_icon", function() {
                var exercise_id = $(this).attr("data-exercise-id");
                var this_icon = $(this);
                var toggle = "";

                if (this_icon.attr("class") == "heart_icon") {
                    toggle = "on";
                } else {
                    toggle = "off";
                }

                $.ajax({
                    type: "POST",
                    url: "/exercicios/exercicio_favorito",
                    data: { exercise_id: exercise_id, toggle: toggle },
                    success: function(response) {
                        if (toggle == "on") {
                            this_icon.hide();
                            this_icon.next().show();
                        } else {
                            this_icon.hide();
                            this_icon.prev().show();
                        }
                    }
                });
            });

            // Filters + Delete Exercise
            $(document).on('click', 'label.checkbox-custom-label, .filter_tags label.cancel, .dropdown.order_by a.dropdown-item, .pagination li a, .remove_exercise', function(e){

                var changed_page = false;

                $(".update_exercises_list").hide();
                $('.preloader.ajax').show();

                // Delete Article
                if($(this).hasClass('remove_exercise')){
                    $('#exercise_to_delete_id').attr('value', $(this).attr('data-exercise-id'));
                    $('#exercise_to_delete_id').attr('disabled', false);
                }

                // Pagination
                if($(this).parent().hasClass('page-item')){
                    e.preventDefault();
                    changed_page = true;
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

                // Order by Date
                if($(this).hasClass('dropdown-item')){
                    e.preventDefault();
                    if(!$(this).hasClass('order_by_active')){
                        if($(this).hasClass('exercise_order_by_date_asc')){
                            $('.dropdown.order_by a.exercise_order_by_date_desc').removeClass('order_by_active');
                            $('.dropdown.order_by a.exercise_order_by_date_desc').next('input').attr('value', 'off');
                        }
                        else{
                            $('.dropdown.order_by a.exercise_order_by_date_asc').removeClass('order_by_active');
                            $('.dropdown.order_by a.exercise_order_by_date_asc').next('input').attr('value', 'off');
                        }
                        $(this).addClass('order_by_active');
                        $(this).next('input').attr('value', 'on');
                    }
                    else{
                        if($(this).hasClass('exercise_order_by_date_asc')){
                            $('.dropdown.order_by a.exercise_order_by_date_desc').removeClass('order_by_active');
                            $('.dropdown.order_by a.exercise_order_by_date_desc').next('input').attr('value', 'off');
                        }
                        else{
                            $('.dropdown.order_by a.exercise_order_by_date_asc').removeClass('order_by_active');
                            $('.dropdown.order_by a.exercise_order_by_date_asc').next('input').attr('value', 'off');
                        }
                        $(this).removeClass('order_by_active');
                        $(this).next('input').attr('value', 'off');
                    }
                }

                // Levels
                if($(this).hasClass('lev')){
                    if($(this).hasClass('all_levels')){
                        $('label.checkbox-custom-label[class*="level_"]').each(function(index, element){
                            if(!$(element).hasClass('all_levels')){
                                $(element).prev('input').attr('checked', false);
                            }
                        });
                    }
                    else if(!$(this).hasClass('all_levels') && $(this).hasClass('lev')){
                        $('label.checkbox-custom-label.all_levels').prev('input').attr('checked', false);
                    }

                    setTimeout(function () {
                        if($('label.checkbox-custom-label[class*="level_"]').prev('input:checked').length == 0){
                            $('label.checkbox-custom-label.all_levels').prev('input').click();
                        }
                    }, 50);
                }
                
                
                // Categories
                if($(this).hasClass('cat')){
                    if($(this).hasClass('all_categories')){
                        $('label.checkbox-custom-label[class*="category_"]').each(function(index, element){
                            if(!$(element).hasClass('all_categories')){
                                $(element).prev('input').attr('checked', false);
                            }
                        });
                    }
                    else if(!$(this).hasClass('all_categories') && $(this).hasClass('cat')){
                        $('label.checkbox-custom-label.all_categories').prev('input').attr('checked', false);
                    }

                    setTimeout(function () {
                        if($('label.checkbox-custom-label[class*="category_"]').prev('input:checked').length == 0){
                            $('label.checkbox-custom-label.all_categories').prev('input').click();
                        }
                    }, 50);
                }

                // Tags
                if($(this).hasClass('cancel')){
                    if(!$(this).hasClass('active')){
                        $(this).addClass('active');
                    }
                    else{
                        $(this).removeClass('active');
                    }
                }

                // Professors
                if($(this).hasClass('prof')){
                    if($(this).hasClass('show_all_professors')){
                        $('label.checkbox-custom-label[class*="professor_"]').each(function(index, element){
                            if(!$(element).hasClass('show_all_professors')){
                                $(element).prev('input').attr('checked', false);
                            }
                        });
                    }
                    else if(!$(this).hasClass('show_all_professors') && $(this).hasClass('prof')){
                        $('label.checkbox-custom-label.show_all_professors').prev('input').attr('checked', false);
                    }

                    setTimeout(function () {
                        if($('label.checkbox-custom-label[class*="professor_"]').prev('input:checked').length == 0){
                            $('label.checkbox-custom-label.show_all_professors').prev('input').click();
                        }
                    }, 50);
                }
                
                

                // Visibility
                if($(this).hasClass('show_vis_all')){
                    $('label.checkbox-custom-label.show_vis_my_students').prev('input').attr('checked', false);
                }
                else if($(this).hasClass('show_vis_my_students')){
                    if(typeof $('label.checkbox-custom-label.show_vis_all').prev('input').attr('checked') == "undefined"
                        && typeof $('label.checkbox-custom-label.show_vis_my_students').prev('input').attr('checked') == "undefined"){
                            $('label.checkbox-custom-label.show_vis_all').prev('input').click();
                        }
                    else{
                        $('label.checkbox-custom-label.show_vis_all').prev('input').attr('checked', false);
                    }
                }

                var form_array;
                setTimeout(function () {
                    form_array = $("#exercises_filters_form").serialize();
                    $.ajax({
                        url: "/exercicios",
                        type: "GET",
                        dataType: "JSON",
                        data: form_array,
                        success: function (response) {
                            if(response && response.status == 'success'){
                                $(".update_exercises_list").html(response.html);
                                $(".update_exercises_list").show();
                                $('.preloader.ajax').hide();
                                $('#exercise_to_delete_id').attr('value', null);
                                $('#exercise_to_delete_id').attr('disabled', true);
                                if(response.message){
                                    $(".successMsg").text(response.message);
                                    $(".successMsg").fadeIn();
                                    setTimeout(() => {
                                        $(".successMsg").fadeOut();
                                    }, 2000);
                                }
                                if(!changed_page){
                                    if($('.pagination').length && $('a[data-page="1"]').length){
                                        $('a[data-page="1"]').click();
                                    }
                                }
                            }
                            else{
                                $(".update_exercises_list").show();
                                $('.preloader.ajax').hide();
                                $('#exercise_to_delete_id').attr('value', null);
                                $('#exercise_to_delete_id').attr('disabled', true);
                                $(".errorMsg").text(response.message);
                                $(".errorMsg").fadeIn();
                                setTimeout(() => {
                                    $(".errorMsg").fadeOut();
                                }, 2000);
                            }
                        }
                    });
                }, 50);
            });

            // Clone Exercise
            $(document).on('click', '.clone_button', function(e){
                e.preventDefault();
                var exercise_id = $(this).attr('data-exercise-id');
                if(!exercise_id){
                    $(".errorMsg").text('Ocorreu um erro ao clonar este exercício! Por favor, atualize a página e tente de novo!');
                    $(".errorMsg").fadeIn();
                    setTimeout(() => {
                        $(".errorMsg").fadeOut();
                    }, 5000);
                }
                else{
                    $.ajax({
                        type: 'POST',
                        url: '/exercicios/clonar/' + exercise_id,
                        success: function(response){
                            if(response && response.status == 'success'){
                                window.location = '/exercicios/editar/' + response.clone_exercise_id;
                                // $("html, body").animate({ scrollTop: 0 }, 500);
                                // setTimeout(function () {
                                //     $(".successMsg").text(response.message);
                                //     $(".successMsg").fadeIn();
                                //     setTimeout(() => {
                                //         $(".successMsg").fadeOut();
                                //     }, 5000);
                                // }, 1000);
                            }
                            else{
                                $(".errorMsg").text(response.message);
                                $(".errorMsg").fadeIn();
                                setTimeout(() => {
                                    $(".errorMsg").fadeOut();
                                }, 2000);
                            }
                        }
                    });
                }
                
            });
        });
    </script>

@stop