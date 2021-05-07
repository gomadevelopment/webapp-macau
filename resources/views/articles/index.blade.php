@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}?v=1.3">

@stop

@section('content')

<form id="articles_filters_form" class="" method="GET" autocomplete="off">
    @csrf

    <section class="page-title articles">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    
                    <div class="wrap">
                        <h1 class="title">Biblioteca</h1>
                    </div>
                    @if(auth()->user()->isProfessor())
                        <div class="dropdown create_article">
                            <a href="/artigos/criar" class="btn btn-theme btn-custom dropdown-toggle">
                            <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt=""> 
                            Criar Artigo</a>
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
                            <a class="dropdown-item article_order_by_date_asc" href="#">Data (Ascendente)</a>
                            <input type="text" name="article_order_by_date_asc" id="article_order_by_date_asc" value="off" hidden>
                            <a class="dropdown-item article_order_by_date_desc" href="#">Data (Descendente)</a>
                            <input type="text" name="article_order_by_date_desc" id="article_order_by_date_desc" value="off" hidden>
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
            
            <!-- Onclick Sidebar -->
            {{-- Mobile filters sidebar --}}
            <div class="row">
                <div class="col-md-12 col-sm-12">							
                    <div id="filter-sidebar" class="filter-sidebar">
                        <div class="filt-head">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="ti-close"></i></a>
                        </div>
                        <div class="show-hide-sidebar">
                            
                            <!-- Find New Property -->
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
                                
                                <h4 class="side_title">Temas</h4>
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
                                    @if(auth()->user()->isProfessor())
                                        <li>
                                            <input id="show_my_students_articles_mobile" class="checkbox-custom" name="show_my_students_articles_mobile" type="checkbox">
                                            <label for="show_my_students_articles_mobile" class="checkbox-custom-label">Dos meus Alunos</label>
                                        </li>
                                    @elseif(auth()->user()->isStudent())
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

                                {{-- <h4 class="side_title mt-3">Favoritos</h4>
                                <ul class="no-ul-list mb-3">
                                    <li>
                                        <input id="show_favorites_mobile" class="checkbox-custom" name="show_favorites_mobile" type="checkbox">
                                        <label for="show_favorites_mobile" class="checkbox-custom-label">Mostrar Favoritos</label>
                                    </li>
                                </ul> --}}
                                
                                <button class="btn btn-theme full-width mb-2">Aplicar Filtros</button>
                            
                            </div>
                            
                        </div>
                    </div>
                    
                </div>	
            </div>

            <!-- Row -->
            <div class="row">
                
                {{-- Desktop filters sidebar --}}
                <div class="col-lg-3 col-md-12 col-sm-12 order-2 order-lg-1 order-md-2">							
                    <div class="page_sidebar hide-23">
                        
                        <h4 class="side_title">Temas</h4>
                        <ul class="no-ul-list mb-3 categories">
                            <li>
                                <input id="all_categories" class="checkbox-custom" name="all_categories" type="checkbox" {{ isset($inputs['all_categories']) ? 'checked' : ''}}>
                                <label for="all_categories" class="checkbox-custom-label all_categories">Todos</label>
                            </li>
                            @foreach ($article_categories as $category)
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
                        
                        <h4 class="side_title">Mostrar</h4>
                        <ul class="no-ul-list mb-3 mostrar">
                            <li>
                                <input id="show_all" class="checkbox-custom" name="show_all" type="checkbox" checked>
                                <label for="show_all" class="checkbox-custom-label show_all show_">Todos</label>
                            </li>
                            <li>
                                <input id="show_my_articles" class="checkbox-custom" name="show_my_articles" type="checkbox">
                                <label for="show_my_articles" class="checkbox-custom-label show_my_articles show_">As minhas Publicações</label>
                            </li>
                            @if(auth()->user()->isProfessor())
                                <li>
                                    <input id="show_my_students_articles" class="checkbox-custom" name="show_my_students_articles" type="checkbox">
                                    <label for="show_my_students_articles" class="checkbox-custom-label show_my_students_articles show_">Dos meus Alunos</label>
                                </li>
                            @elseif(auth()->user()->isStudent())
                                    <li>
                                    <input id="show_my_professor_articles" class="checkbox-custom" name="show_my_professor_articles" type="checkbox">
                                    <label for="show_my_professor_articles" class="checkbox-custom-label show_my_professor_articles show_">Do meu Professor</label>
                                </li>
                            @endif
                            <li>
                                <input id="show_all_students_articles" class="checkbox-custom" name="show_all_students_articles" type="checkbox">
                                <label for="show_all_students_articles" class="checkbox-custom-label show_all_students_articles show_">De todos os Alunos</label>
                            </li>
                            <li>
                                <input id="show_all_professors_articles" class="checkbox-custom" name="show_all_professors_articles" type="checkbox">
                                <label for="show_all_professors_articles" class="checkbox-custom-label show_all_professors_articles show_">De todos os Professores</label>
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

                        {{-- <h4 class="side_title mt-3">Favoritos</h4>
                        <ul class="no-ul-list mb-3">
                            <li>
                                <input id="show_favorites" class="checkbox-custom" name="show_favorites" type="checkbox">
                                <label for="show_favorites" class="checkbox-custom-label">Mostrar Favoritos</label>
                            </li>
                        </ul> --}}
                        
                    </div>
                    
                </div>

                <div class="preloader ajax col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2"><span></span><span></span></div>
                <div class="col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2 order-md-1 update_articles_list">

                    @include('articles.articles_list_partial')
                    
                </div>
                <input type="text" name="article_to_delete_id" id="article_to_delete_id" hidden disabled>
            </div>
            <!-- Row -->
            
        </div>
    </section>
    <input type="number" name="page" id="page_number" value="1" hidden>

</form>
@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https')) }}?v=1.3"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https')) }}?v=1.3"></script>

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
                var article_id = $(this).attr("data-article-id");
                var this_icon = $(this);
                var toggle = "";

                if (this_icon.attr("class") == "heart_icon") {
                    toggle = "on";
                } else {
                    toggle = "off";
                }

                $.ajax({
                    type: "POST",
                    url: "/artigos/artigo_favorito",
                    data: { article_id: article_id, toggle: toggle },
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

            // Filters + Delete article
            $(document).on('click', 'label.checkbox-custom-label, .filter_tags label.cancel, .dropdown.order_by a.dropdown-item, .pagination li a, .remove_article', function(e){

                var changed_page = false;

                $(".update_articles_list").hide();
                $('.preloader.ajax').show();

                // Delete Article
                if($(this).hasClass('remove_article')){
                    $('#article_to_delete_id').attr('value', $(this).attr('data-article-id'));
                    $('#article_to_delete_id').attr('disabled', false);
                }

                // Pagination
                if($(this).parent().hasClass('page-item')){
                    e.preventDefault();
                    changed_page = true;
                    $('#page_number').attr('value', $(this).attr('data-page'));
                    
                    $('.pagination li').each(function(index, element){
                        $(element).removeClass('current_page_active');
                    });
                    $(this).parent().addClass('current_page_active');
                    $("html, body").animate({ scrollTop: 0 }, 500);
                }

                // Order by Date
                if($(this).hasClass('dropdown-item')){
                    e.preventDefault();
                    if(!$(this).hasClass('order_by_active')){
                        if($(this).hasClass('article_order_by_date_asc')){
                            $('.dropdown.order_by a.article_order_by_date_desc').removeClass('order_by_active');
                            $('.dropdown.order_by a.article_order_by_date_desc').next('input').attr('value', 'off');
                        }
                        else{
                            $('.dropdown.order_by a.article_order_by_date_asc').removeClass('order_by_active');
                            $('.dropdown.order_by a.article_order_by_date_asc').next('input').attr('value', 'off');
                        }
                        $(this).addClass('order_by_active');
                        $(this).next('input').attr('value', 'on');
                    }
                    else{
                        if($(this).hasClass('article_order_by_date_asc')){
                            $('.dropdown.order_by a.article_order_by_date_desc').removeClass('order_by_active');
                            $('.dropdown.order_by a.article_order_by_date_desc').next('input').attr('value', 'off');
                        }
                        else{
                            $('.dropdown.order_by a.article_order_by_date_asc').removeClass('order_by_active');
                            $('.dropdown.order_by a.article_order_by_date_asc').next('input').attr('value', 'off');
                        }
                        $(this).removeClass('order_by_active');
                        $(this).next('input').attr('value', 'off');
                    }
                }

                // "Show"
                if($(this).hasClass('show_all')){
                    $('label.checkbox-custom-label[class*="show_"]').each(function(index, element){
                        if(!$(element).hasClass('show_all')){
                            $(element).prev('input').attr('checked', false);
                        }
                    });
                }
                else if(!$(this).hasClass('show_all') && $(this).hasClass('show_')){
                    $('label.checkbox-custom-label.show_all').prev('input').attr('checked', false);
                }
                
                // Categories
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
                        $('label.checkbox-custom-label.all_categories').prev('input').attr('checked', true);
                    }
                }, 50);

                // Tags
                if($(this).hasClass('cancel')){
                    if(!$(this).hasClass('active')){
                        $(this).addClass('active');
                    }
                    else{
                        $(this).removeClass('active');
                    }
                }
                
                var form_array;
                setTimeout(function () {
                    form_array = $("#articles_filters_form").serialize();
                    $.ajax({
                        url: "/artigos",
                        type: "GET",
                        dataType: "JSON",
                        data: form_array,
                        success: function (response) {
                            if(response && response.status == 'success'){
                                $(".update_articles_list").html(response.html);
                                $(".update_articles_list").show();
                                $('.preloader.ajax').hide();
                                // Reset article to delete
                                $('#article_to_delete_id').attr('value', null);
                                $('#article_to_delete_id').attr('disabled', true);
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
                                $(".update_articles_list").show();
                                $('.preloader.ajax').hide();
                                // Reset article to delete
                                $('#article_to_delete_id').attr('value', null);
                                $('#article_to_delete_id').attr('disabled', true);
                                $(".errorMsg").text(response.message);
                                $(".errorMsg").fadeIn();
                                setTimeout(() => {
                                    $(".errorMsg").fadeOut();
                                }, 5000);
                            }
                        }
                    });
                }, 50);
            
                
            });

            // $(document).ajaxComplete(function() {
            //     $('.pagination li a').click(function(e) {
            //         e.preventDefault();
            //         var url = $(this).attr('href');
            //         $.ajax({
            //             url: url,
            //             success: function(data) {
            //                 $("html").html(data);
            //             }
            //         });
            //     });
            // });
        });
    </script>

@stop