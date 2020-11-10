@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}">

@stop

@section('content')

<!-- ============================ Page Title Start================================== -->
<section class="page-title articles">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <div class="wrap">
                    <h1 class="title">Exercícios</h1>
                </div>
                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                    <div class="dropdown create_article">
                        <a href="/exercicios/criar" class="btn btn-theme btn-custom dropdown-toggle">
                        <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt=""> 
                        Criar Exercício</a>
                    </div>
                @endif
                <div class="show_favorites">
                    <input id="show_my_favorites" class="checkbox-custom" name="show_my_favorites" type="checkbox">
                    <label for="show_my_favorites" class="checkbox-custom-label">Meus Favoritos</label>                    
                </div>
                <div class="dropdown">
                    <a class="btn btn-custom dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ordenar por <img src="{{asset('/assets/backoffice_assets/icons/Sort.svg')}}" alt="" style="margin-left: 10px;">
                    </a>
                    <span class="dropdown-menu-arrow"></span>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Data (Ascendente)</a>
                    <a class="dropdown-item" href="#">Data (Descendente)</a>
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
<!-- ============================ Page Title End ================================== -->	

<!-- ============================ Find Courses with Sidebar ================================== -->
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
                            <input id="cat_all" class="checkbox-custom" name="cat_all" type="checkbox" checked>
                            <label for="cat_all" class="checkbox-custom-label">Tudo</label>
                        </li>
                        <li>
                            <input id="cat_justice" class="checkbox-custom" name="cat_justice" type="checkbox">
                            <label for="cat_justice" class="checkbox-custom-label">Justiça</label>
                        </li>
                        <li>
                            <input id="cat_literature" class="checkbox-custom" name="cat_literature" type="checkbox">
                            <label for="cat_literature" class="checkbox-custom-label">Literatura</label>
                        </li>
                        <li>
                            <input id="cat_environment" class="checkbox-custom" name="cat_environment" type="checkbox">
                            <label for="cat_environment" class="checkbox-custom-label">Meio Ambiente</label>
                        </li>
                        <li>
                            <input id="cat_transports" class="checkbox-custom" name="cat_transports" type="checkbox">
                            <label for="cat_transports" class="checkbox-custom-label">Transportes</label>
                        </li>
                        <li>
                            <input id="cat_professional_life" class="checkbox-custom" name="cat_professional_life" type="checkbox">
                            <label for="cat_professional_life" class="checkbox-custom-label">Vida Profissional</label>
                        </li>
                        <li>
                            <input id="cat_grammar" class="checkbox-custom" name="cat_grammar" type="checkbox">
                            <label for="cat_grammar" class="checkbox-custom-label">Gramática</label>
                        </li>
                        <li>
                            <input id="cat_sintax" class="checkbox-custom" name="cat_sintax" type="checkbox">
                            <label for="cat_sintax" class="checkbox-custom-label">Sintáx</label>
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
                            <input id="show_my_exercises" class="checkbox-custom" name="show_my_exercises" type="checkbox" checked>
                            <label for="show_my_exercises" class="checkbox-custom-label">Os meus Exercicios</label>
                        </li>
                        <li>
                            <input id="show_joao_paulo" class="checkbox-custom" name="show_joao_paulo" type="checkbox">
                            <label for="show_joao_paulo" class="checkbox-custom-label">João Paulo</label>
                        </li>
                        <li>
                            <input id="show_luis_antunes" class="checkbox-custom" name="show_luis_antunes" type="checkbox">
                            <label for="show_luis_antunes" class="checkbox-custom-label">Luis Antunes</label>
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
                            <input id="show_vis_all" class="checkbox-custom" name="show_vis_all" type="checkbox" checked>
                            <label for="show_vis_all" class="checkbox-custom-label">Todos</label>
                        </li>
                        <li>
                            <input id="show_vis_my_students" class="checkbox-custom" name="show_vis_my_students" type="checkbox">
                            <label for="show_vis_my_students" class="checkbox-custom-label">Só para os meus Alunos</label>
                        </li>
                        <li>
                            <input id="show_vis_professors" class="checkbox-custom" name="show_vis_professors" type="checkbox">
                            <label for="show_vis_professors" class="checkbox-custom-label">Só para Professores</label>
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
            
            <div class="col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2 order-md-1">
                
                <div class="row">
            
                    <!-- Single Product 11 -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                
                        <div class="shop_grid exercises">
                            <div class="shop_grid_caption card-body">
                                {{-- Like buttons heart/heart_filled --}}
                                <img class="heart_icon" src="{{asset('/assets/backoffice_assets/icons/Heart.svg')}}" alt="">
                                <img class="heart_filled_icon" src="{{asset('/assets/backoffice_assets/icons/Heart_filled.svg')}}" alt="" style="display: none;">
                                <h4 class="sg_rate_title">Da Áustria para Macau</h4>
                                <div class="d-flex float-left flex-column">
                                    @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                        <p class="exercise_author"><strong>Autor:</strong> <a href="#" class="professor_link">Professor João Paulo <img src="{{asset('/assets/backoffice_assets/icons/Eye_pink.svg')}}" alt=""></a> </p>
                                    @else
                                        <p class="exercise_author"><strong>Autor:</strong> Professor João Paulo</p>
                                    @endif
                                    <p class="exercise_level" style="float: left; margin-right: 20px;">
                                        <strong>Nível:</strong> A1 &nbsp;&nbsp;&nbsp;
                                        @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                            <strong>Média de Avaliação:</strong> 62%
                                        @endif
                                    </p>
                                </div>
                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                    <div class="d-block float-right mt-3">
                                        <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Eye.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Visualizar
                                        </a>
                                        <a href="#" class="btn btn-theme remove_button" style="float: none; padding: 14px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 5px;">
                                            Remover
                                        </a>
                                        <a href="#" class="btn btn-theme clone_button" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/clone.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Clonar
                                        </a>
                                    </div>
                                @else
                                    <div class="d-block float-right mt-3">
                                        <a href="/exercicios/realizar" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Iniciar Exercício
                                        </a>
                                        <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Retomar
                                        </a>
                                        <a href="#" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_white.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Notificar Professor
                                        </a>
                                    </div>
                                @endif
                                

                                <hr style="margin-top: 6rem;">

                                <h4 class="sg_rate_title">Resumo</h4>

                                <p class="article_description" style="margin-top: 15px;">
                                    Vamos conhecer Astrid Pires, professora de Alemão em Lisboa. De onde é que ela é? Porque é que veio para Portugal? Quais as dificuldades que teve?
                                </p>
                                
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Gramática</p>
                                </div>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Experiência</p>
                                </div>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Verbos</p>
                                </div>

                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                    <div class="read_more available_tooltip_text">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-bottom: 5px; margin-right: 5px;"> 
                                        Disponível só para os meus Alunos
                                    </div>
                                @endif
                                    
                            </div>
                        </div>
                        
                    </div>

                    <!-- Single Product 22 -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                
                        <div class="shop_grid exercises">
                            <div class="shop_grid_caption card-body">
                                {{-- Like buttons heart/heart_filled --}}
                                <img class="heart_icon" src="{{asset('/assets/backoffice_assets/icons/Heart.svg')}}" alt="">
                                <img class="heart_filled_icon" src="{{asset('/assets/backoffice_assets/icons/Heart_filled.svg')}}" alt="" style="display: none;">
                                <h4 class="sg_rate_title">Da Áustria para Macau</h4>
                                <div class="d-flex float-left flex-column">
                                    @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                        <p class="exercise_author"><strong>Autor:</strong> <a href="#" class="professor_link">Professor João Paulo <img src="{{asset('/assets/backoffice_assets/icons/Eye_pink.svg')}}" alt=""></a> </p>
                                    @else
                                        <p class="exercise_author">
                                            <strong>Autor:</strong> Professor João Paulo &nbsp;&nbsp;&nbsp;
                                            <strong>Estado:</strong> <strong class="exercise_complete"> Realizado</strong>
                                        </p>
                                    @endif
                                    <p class="exercise_level" style="float: left; margin-right: 20px;">
                                        <strong>Nível:</strong> A1
                                        @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                            <strong>&nbsp;&nbsp;&nbsp;Média de Avaliação:</strong> 62%
                                        @else
                                             <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nota:</strong> 100%
                                        @endif
                                    </p>
                                </div>
                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                    <div class="d-block float-right mt-3">
                                        <a href="#" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Eye.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Visualizar
                                        </a>
                                        <a href="#" class="btn btn-theme remove_button" style="float: none; padding: 14px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 5px;">
                                            Remover
                                        </a>
                                        <a href="#" class="btn btn-theme clone_button" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/clone.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Clonar
                                        </a>
                                    </div>
                                @else
                                    <div class="d-block float-right mt-3">
                                        <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Iniciar Exercício
                                        </a>
                                        <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Retomar
                                        </a>
                                        <a href="#" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_white.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Notificar Professor
                                        </a>
                                    </div>
                                @endif
                                

                                <hr style="margin-top: 6rem;">

                                <h4 class="sg_rate_title">Resumo</h4>

                                <p class="article_description" style="margin-top: 15px;">
                                    Vamos conhecer Astrid Pires, professora de Alemão em Lisboa. De onde é que ela é? Porque é que veio para Portugal? Quais as dificuldades que teve?
                                </p>
                                
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Gramática</p>
                                </div>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Experiência</p>
                                </div>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Verbos</p>
                                </div>

                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                    <div class="read_more available_tooltip_text">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-bottom: 5px; margin-right: 5px;"> 
                                        Disponível só para os meus Alunos
                                    </div>
                                @endif
                                    
                            </div>
                        </div>
                        
                    </div>

                    <!-- Single Product 33 -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                
                        <div class="shop_grid exercises">
                            <div class="shop_grid_caption card-body">
                                {{-- Like buttons heart/heart_filled --}}
                                <img class="heart_icon" src="{{asset('/assets/backoffice_assets/icons/Heart.svg')}}" alt="">
                                <img class="heart_filled_icon" src="{{asset('/assets/backoffice_assets/icons/Heart_filled.svg')}}" alt="" style="display: none;">
                                <h4 class="sg_rate_title">Da Áustria para Macau</h4>
                                <div class="d-flex float-left flex-column">
                                    @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                        <p class="exercise_author"><strong>Autor:</strong> <a href="#" class="professor_link">Professor João Paulo <img src="{{asset('/assets/backoffice_assets/icons/Eye_pink.svg')}}" alt=""></a> </p>
                                    @else
                                        <p class="exercise_author">
                                            <strong>Autor:</strong> Professor João Paulo &nbsp;&nbsp;&nbsp;
                                            <strong>Estado:</strong> <strong class="exercise_in_course"> Em curso</strong>
                                        </p>
                                    @endif
                                    <p class="exercise_level" style="float: left; margin-right: 20px;">
                                        <strong>Nível:</strong> A1 &nbsp;&nbsp;&nbsp;
                                        @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                            <strong>&nbsp;&nbsp;&nbsp;Média de Avaliação:</strong> 62%
                                        @else
                                             {{-- <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nota:</strong> 100% --}}
                                        @endif
                                    </p>
                                </div>
                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                    <div class="d-block float-right mt-3">
                                        <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Eye.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Visualizar
                                        </a>
                                        <a href="#" hidden class="btn btn-theme remove_button" style="float: none; padding: 14px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 5px;">
                                            Remover
                                        </a>
                                        <a href="#" class="btn btn-theme clone_button" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/clone.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Clonar
                                        </a>
                                    </div>
                                @else
                                    <div class="d-block float-right mt-3">
                                        <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Iniciar Exercício
                                        </a>
                                        <a href="/exercicios/realizar" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Retomar
                                        </a>
                                        <a href="#" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_white.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Notificar Professor
                                        </a>
                                    </div>
                                @endif
                                

                                <hr style="margin-top: 6rem;">

                                <h4 class="sg_rate_title">Resumo</h4>

                                <p class="article_description" style="margin-top: 15px;">
                                    Vamos conhecer Astrid Pires, professora de Alemão em Lisboa. De onde é que ela é? Porque é que veio para Portugal? Quais as dificuldades que teve?
                                </p>
                                
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Gramática</p>
                                </div>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Experiência</p>
                                </div>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Verbos</p>
                                </div>

                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                    <div class="read_more available_tooltip_text">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-bottom: 5px; margin-right: 5px;"> 
                                        Disponível só para os meus Alunos
                                    </div>
                                @endif
                                    
                            </div>
                        </div>
                        
                    </div>

                    <!-- Single Product 44 -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                
                        <div class="shop_grid exercises">
                            <div class="shop_grid_caption card-body">
                                {{-- Like buttons heart/heart_filled --}}
                                <img class="heart_icon" src="{{asset('/assets/backoffice_assets/icons/Heart.svg')}}" alt="">
                                <img class="heart_filled_icon" src="{{asset('/assets/backoffice_assets/icons/Heart_filled.svg')}}" alt="" style="display: none;">
                                <h4 class="sg_rate_title">Da Áustria para Macau</h4>
                                <div class="d-flex float-left flex-column">
                                    @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                        <p class="exercise_author"><strong>Autor:</strong> <a href="#" class="professor_link">Professor João Paulo <img src="{{asset('/assets/backoffice_assets/icons/Eye_pink.svg')}}" alt=""></a> </p>
                                    @else
                                        <p class="exercise_author">
                                            <strong>Autor:</strong> Professor João Paulo &nbsp;&nbsp;&nbsp;
                                            <strong>Estado:</strong> <strong class="exercise_awaiting"> A aguardar Avaliação</strong>
                                        </p>
                                    @endif
                                    <p class="exercise_level" style="float: left; margin-right: 20px;">
                                        <strong>Nível:</strong> A1 &nbsp;&nbsp;&nbsp;
                                        @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                            <strong>&nbsp;&nbsp;&nbsp;Média de Avaliação:</strong> 62%
                                        @else
                                             <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nota Provisória:</strong> 90%
                                        @endif
                                    </p>
                                </div>
                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                    <div class="d-block float-right mt-3">
                                        <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Eye.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Visualizar
                                        </a>
                                        <a href="#" hidden class="btn btn-theme remove_button" style="float: none; padding: 14px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 5px;">
                                            Remover
                                        </a>
                                        <a href="#" class="btn btn-theme clone_button" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/clone.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Clonar
                                        </a>
                                    </div>
                                @else
                                    <div class="d-block float-right mt-3">
                                        <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Iniciar Exercício
                                        </a>
                                        <a href="/exercicios/realizar" hidden class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Retomar
                                        </a>
                                        <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                            <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_white.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                            Notificar Professor
                                        </a>
                                    </div>
                                @endif
                                

                                <hr style="margin-top: 6rem;">

                                <h4 class="sg_rate_title">Resumo</h4>

                                <p class="article_description" style="margin-top: 15px;">
                                    Vamos conhecer Astrid Pires, professora de Alemão em Lisboa. De onde é que ela é? Porque é que veio para Portugal? Quais as dificuldades que teve?
                                </p>
                                
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Gramática</p>
                                </div>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Experiência</p>
                                </div>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Verbos</p>
                                </div>

                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                    <div class="read_more available_tooltip_text">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-bottom: 5px; margin-right: 5px;"> 
                                        Disponível só para os meus Alunos
                                    </div>
                                @endif
                                    
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
                <!-- Row Pagination -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        
                        <!-- Pagination -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <ul class="pagination p-center">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                        <span class="ti-arrow-left"></span>
                                        <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="#">18</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                        <span class="ti-arrow-right"></span>
                                        <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- /Row -->
                
            </div>
        
        </div>
        <!-- Row -->
        
    </div>
</section>
<!-- ============================ Find Courses with Sidebar End ================================== -->

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
    </script>

@stop