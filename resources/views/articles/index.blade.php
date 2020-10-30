@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}">

@stop

@section('content')

<!-- ============================ Page Title Start================================== -->
<section class="page-title articles">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <div class="breadcrumbs-wrap">
                    <h1 class="breadcrumb-title">Artigos</h1>
                </div>
                <div class="dropdown create_article">
                    <a href="#" class="btn btn-theme btn-custom dropdown-toggle">
                    <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt=""> 
                    Criar Artigo</a>
                </div>
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
        
        <!-- Onclick Sidebar -->
        <div class="row">
            <div class="col-md-12 col-sm-12">							
                <div id="filter-sidebar" class="filter-sidebar">
                    <div class="filt-head">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="ti-close"></i></a>
                    </div>
                    <div class="show-hide-sidebar">
                        
                        <!-- Find New Property -->
                        <div class="sidebar-widgets page_sidebar">
                            
                            <h4 class="side_title">Categorias</h4>
                            <ul class="no-ul-list mb-3 categories">
                                <li>
                                    <input id="cat_all_mobile" class="checkbox-custom" name="cat_all_mobile" type="checkbox" checked>
                                    <label for="cat_all_mobile" class="checkbox-custom-label">Tudo</label>
                                </li>
                                <li>
                                    <input id="cat_grammar_mobile" class="checkbox-custom" name="cat_grammar_mobile" type="checkbox">
                                    <label for="cat_grammar_mobile" class="checkbox-custom-label">Gramática</label>
                                </li>
                                <li>
                                    <input id="cat_science_mobile" class="checkbox-custom" name="cat_science_mobile" type="checkbox">
                                    <label for="cat_science_mobile" class="checkbox-custom-label">Ciência</label>
                                </li>
                                <li>
                                    <input id="cat_sports_mobile" class="checkbox-custom" name="cat_sports_mobile" type="checkbox">
                                    <label for="cat_sports_mobile" class="checkbox-custom-label">Desporto</label>
                                </li>
                                <li>
                                    <input id="cat_geography_mobile" class="checkbox-custom" name="cat_geography_mobile" type="checkbox">
                                    <label for="cat_geography_mobile" class="checkbox-custom-label">Geografia</label>
                                </li>
                                <a href="#" class="show_more_categories">
                                    Mostrar tudo <div class="triangle-down"></div>
                                </a>
                                <a href="#" class="show_less_categories">
                                    Mostrar menos <div class="triangle-up"></div>
                                </a>
                            </ul>
                            
                            <h4 class="side_title">Mostrar</h4>
                            <ul class="no-ul-list mb-3 mostrar">
                                <li>
                                    <input id="show_all_mobile" class="checkbox-custom" name="show_all_mobile" type="checkbox" checked>
                                    <label for="show_all_mobile" class="checkbox-custom-label">Todos</label>
                                </li>
                                <li>
                                    <input id="show_my_articles_mobile" class="checkbox-custom" name="show_my_articles_mobile" type="checkbox">
                                    <label for="show_my_articles_mobile" class="checkbox-custom-label">As minhas Publicações</label>
                                </li>
                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                    <li>
                                        <input id="show_my_students_articles_mobile" class="checkbox-custom" name="show_my_students_articles_mobile" type="checkbox">
                                        <label for="show_my_students_articles_mobile" class="checkbox-custom-label">Dos meus Alunos</label>
                                    </li>
                                @elseif(auth()->user()->role == 3)
                                        <li>
                                        <input id="show_my_professor_articles_mobile" class="checkbox-custom" name="show_my_professor_articles_mobile" type="checkbox">
                                        <label for="show_my_professor_articles_mobile" class="checkbox-custom-label">Do meu Professor</label>
                                    </li>
                                @endif
                                <li>
                                    <input id="show_all_students_mobile" class="checkbox-custom" name="show_all_students_mobile" type="checkbox">
                                    <label for="show_all_students_mobile" class="checkbox-custom-label">De todos os Alunos</label>
                                </li>
                                <li>
                                    <input id="show_all_professors_mobile" class="checkbox-custom" name="show_all_professors_mobile" type="checkbox">
                                    <label for="show_all_professors_mobile" class="checkbox-custom-label">De todos os Professores</label>
                                </li>
                                <a href="#" class="show_more_mostrar">
                                    Mostrar tudo <div class="triangle-down"></div>
                                </a>
                                <a href="#" class="show_less_mostrar">
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

                            <h4 class="side_title mt-3">Favoritos</h4>
                            <ul class="no-ul-list mb-3">
                                <li>
                                    <input id="show_favorites" class="checkbox-custom" name="show_favorites_mobile" type="checkbox">
                                    <label for="show_favorites" class="checkbox-custom-label">Mostrar Favoritos</label>
                                </li>
                            </ul>
                            
                            <button class="btn btn-theme full-width mb-2">Aplicar Filtros</button>
                        
                        </div>
                        
                    </div>
                </div>
                
            </div>	
        </div>

        <!-- Row -->
        <div class="row">
        
            <div class="col-lg-3 col-md-12 col-sm-12 order-2 order-lg-1 order-md-2">							
                <div class="page_sidebar hide-23">
                    
                    <h4 class="side_title">Categorias</h4>
                    <ul class="no-ul-list mb-3 categories">
                        <li>
                            <input id="cat_all" class="checkbox-custom" name="cat_all" type="checkbox" checked>
                            <label for="cat_all" class="checkbox-custom-label">Tudo</label>
                        </li>
                        <li>
                            <input id="cat_grammar" class="checkbox-custom" name="cat_grammar" type="checkbox">
                            <label for="cat_grammar" class="checkbox-custom-label">Gramática</label>
                        </li>
                        <li>
                            <input id="cat_science" class="checkbox-custom" name="cat_science" type="checkbox">
                            <label for="cat_science" class="checkbox-custom-label">Ciência</label>
                        </li>
                        <li>
                            <input id="cat_sports" class="checkbox-custom" name="cat_sports" type="checkbox">
                            <label for="cat_sports" class="checkbox-custom-label">Desporto</label>
                        </li>
                        <li>
                            <input id="cat_geography" class="checkbox-custom" name="cat_geography" type="checkbox">
                            <label for="cat_geography" class="checkbox-custom-label">Geografia</label>
                        </li>
                        <a href="#" class="show_more_categories">
                            Mostrar tudo <div class="triangle-down"></div>
                        </a>
                        <a href="#" class="show_less_categories">
                            Mostrar menos <div class="triangle-up"></div>
                        </a>
                    </ul>
                    
                    <h4 class="side_title">Mostrar</h4>
                    <ul class="no-ul-list mb-3 mostrar">
                        <li>
                            <input id="show_all" class="checkbox-custom" name="show_all" type="checkbox" checked>
                            <label for="show_all" class="checkbox-custom-label">Todos</label>
                        </li>
                        <li>
                            <input id="show_my_articles" class="checkbox-custom" name="show_my_articles" type="checkbox">
                            <label for="show_my_articles" class="checkbox-custom-label">As minhas Publicações</label>
                        </li>
                        @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                            <li>
                                <input id="show_my_students_articles" class="checkbox-custom" name="show_my_students_articles" type="checkbox">
                                <label for="show_my_students_articles" class="checkbox-custom-label">Dos meus Alunos</label>
                            </li>
                        @elseif(auth()->user()->role == 3)
                                <li>
                                <input id="show_my_professor_articles" class="checkbox-custom" name="show_my_professor_articles" type="checkbox">
                                <label for="show_my_professor_articles" class="checkbox-custom-label">Do meu Professor</label>
                            </li>
                        @endif
                        <li>
                            <input id="show_all_students" class="checkbox-custom" name="show_all_students" type="checkbox">
                            <label for="show_all_students" class="checkbox-custom-label">De todos os Alunos</label>
                        </li>
                        <li>
                            <input id="show_all_professors" class="checkbox-custom" name="show_all_professors" type="checkbox">
                            <label for="show_all_professors" class="checkbox-custom-label">De todos os Professores</label>
                        </li>
                        <a href="#" class="show_more_mostrar">
                            Mostrar tudo <div class="triangle-down"></div>
                        </a>
                        <a href="#" class="show_less_mostrar">
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

                    <h4 class="side_title mt-3">Favoritos</h4>
                    <ul class="no-ul-list mb-3">
                        <li>
                            <input id="show_favorites" class="checkbox-custom" name="show_favorites" type="checkbox">
                            <label for="show_favorites" class="checkbox-custom-label">Mostrar Favoritos</label>
                        </li>
                    </ul>
                    
                </div>
                
            </div>	
            
            <div class="col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2 order-md-1">
                
                <div class="row">
            
                    <!-- Single Product -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                
                        <div class="shop_grid">
                            <div class="shop_grid_thumb img">
                                <img src="{{asset('/assets/backoffice_assets/images/woman_thumbnail.png')}}" class="img-fluid" alt="" />
                            </div>
                            <div class="shop_grid_caption">
                                {{-- Like buttons heart/heart_filled --}}
                                <img class="heart_icon" src="{{asset('/assets/backoffice_assets/icons/Heart.svg')}}" alt="">
                                <img class="heart_filled_icon" src="{{asset('/assets/backoffice_assets/icons/Heart_filled.svg')}}" alt="" style="display: none;">
                                <h4 class="sg_rate_title">A história de Astrid Pires</h4>
                                <p class="article_author"><strong>Por:</strong> João Monteiro | 5 min. de leitura</p>
                                <p class="article_description">Vamos conhecer Astrid Pires, professora de Alemão em Lisboa. De onde é que ela é? Porque é que veio para Portugal? Quais as dificuldades que teve?</p>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Gramática</p>
                                </div>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Experiência</p>
                                </div>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Verbos</p>
                                </div>
                                <div class="article_buttons">
                                    <a href="#" class="btn btn-theme edit_button">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Pencil.svg')}}" alt="">Editar
                                    </a>
                                    <a href="#" class="btn btn-theme remove_button">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="">Remover
                                    </a>
                                    <a href="#" class="btn btn-theme share_button">
                                        <img src="{{asset('/assets/backoffice_assets/icons/share.svg')}}" alt="">Partilhar
                                    </a>
                                </div>
                                <div class="read_more">
                                    <a href="#" class="">Ler mais <img src="{{asset('/assets/backoffice_assets/icons/Add.svg')}}" alt="" style="margin-left: 5px; margin-top: -2px; margin-right: 10px;"></a>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>

                    <!-- Single Product -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                
                        <div class="shop_grid">
                            <div class="shop_grid_thumb img">
                                <img src="{{asset('/assets/backoffice_assets/images/woman_thumbnail.png')}}" class="img-fluid" alt="" />
                            </div>
                            <div class="shop_grid_caption">
                                {{-- Like buttons heart/heart_filled --}}
                                <img class="heart_icon" src="{{asset('/assets/backoffice_assets/icons/Heart.svg')}}" alt="">
                                <img class="heart_filled_icon" src="{{asset('/assets/backoffice_assets/icons/Heart_filled.svg')}}" alt="" style="display: none;">
                                <h4 class="sg_rate_title">A história de Astrid Pires</h4>
                                <p class="article_author"><strong>Por:</strong> João Monteiro | 5 min. de leitura</p>
                                <p class="article_description">Vamos conhecer Astrid Pires, professora de Alemão em Lisboa. De onde é que ela é? Porque é que veio para Portugal? Quais as dificuldades que teve?</p>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Gramática</p>
                                </div>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Experiência</p>
                                </div>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Verbos</p>
                                </div>
                                <div class="article_buttons">
                                    <a href="#" class="btn btn-theme edit_button">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Pencil.svg')}}" alt="">Editar
                                    </a>
                                    <a href="#" class="btn btn-theme remove_button">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="">Remover
                                    </a>
                                    <a href="#" class="btn btn-theme share_button">
                                        <img src="{{asset('/assets/backoffice_assets/icons/share.svg')}}" alt="">Partilhar
                                    </a>
                                </div>
                                <div class="read_more">
                                    <a href="#" class="">Ler mais <img src="{{asset('/assets/backoffice_assets/icons/Add.svg')}}" alt="" style="margin-left: 5px; margin-top: -2px; margin-right: 10px;"></a>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>

                    <!-- Single Product -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                
                        <div class="shop_grid">
                            <div class="shop_grid_thumb img">
                                <img src="{{asset('/assets/backoffice_assets/images/woman_thumbnail.png')}}" class="img-fluid" alt="" />
                            </div>
                            <div class="shop_grid_caption">
                                {{-- Like buttons heart/heart_filled --}}
                                <img class="heart_icon" src="{{asset('/assets/backoffice_assets/icons/Heart.svg')}}" alt="">
                                <img class="heart_filled_icon" src="{{asset('/assets/backoffice_assets/icons/Heart_filled.svg')}}" alt="" style="display: none;">
                                <h4 class="sg_rate_title">A história de Astrid Pires</h4>
                                <p class="article_author"><strong>Por:</strong> João Monteiro | 5 min. de leitura</p>
                                <p class="article_description">Vamos conhecer Astrid Pires, professora de Alemão em Lisboa. De onde é que ela é? Porque é que veio para Portugal? Quais as dificuldades que teve?</p>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Gramática</p>
                                </div>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Experiência</p>
                                </div>
                                <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                    <p>Verbos</p>
                                </div>
                                <div class="article_buttons">
                                    <a href="#" class="btn btn-theme edit_button">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Pencil.svg')}}" alt="">Editar
                                    </a>
                                    <a href="#" class="btn btn-theme remove_button">
                                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="">Remover
                                    </a>
                                    <a href="#" class="btn btn-theme share_button">
                                        <img src="{{asset('/assets/backoffice_assets/icons/share.svg')}}" alt="">Partilhar
                                    </a>
                                </div>
                                <div class="read_more">
                                    <a href="#" class="">Ler mais <img src="{{asset('/assets/backoffice_assets/icons/Add.svg')}}" alt="" style="margin-left: 5px; margin-top: -2px; margin-right: 10px;"></a>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
                <!-- Row -->
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
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https'))}}"></script>

    <script>
        function openNav() {
            document.getElementById("filter-sidebar").style.width = "320px";
        }

        function closeNav() {
            document.getElementById("filter-sidebar").style.width = "0";
        }
    </script>

@stop