@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/classroom.css', config()->get('app.https')) }}">

@stop

@section('content')

<!-- ============================ Find Courses with Sidebar ================================== -->
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
                        <img src="https://via.placeholder.com/500x500" alt="" class="user_round_avatar mr-3">
                        
                    </div>
                        <h4 class="sg_rate_title align-self-center text-center mt-3 mb-3">
                            João Paulo Madeira
                            <p class="exercise_author align-self-center text-center">
                                <img src="{{asset('/assets/backoffice_assets/icons/Location.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 5px;">
                                Ilha da Taipa, Macau
                            </p>
                            <a href="/perfil/editar" class="btn search-btn comment_submit mt-4" style="float: none; padding: 12px 20px; font-size: 21px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Pencil.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Editar
                            </a>
                        </h4>
                </div>
            </div>

            {{-- About me / Professional path --}}
            <div class="col-sm-12 col-md-8 col-lg-8">
                <div class="wrap mb-3">
                    @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                        <h1 class="title">Percurso Profissional</h1>
                    @else
                        <h1 class="title">Sobre mim</h1>
                    @endif
                    
                </div>
                <div class="shop_grid_caption card-body m-0 mb-4 pb-0">
                    <div class="d-flex flex-column">
                        <p class="exercise_author" style="line-height: 25px;">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac mi non est
                            consectetur pellentesque at et lorem. Class aptent taciti sociosqu ad litora torquent
                            per conubia nostra, per inceptos himenaeos. Nunc commodo fermentum tincidunt.
                            Sed mollis, lectus non egestas posuere, tellus purus aliquam enim, ac hendrerit est
                            augue nec nulla. Nulla nec orci non magna finibus pharetra. 
                        </p>
                    </div>

                    <hr>

                    @if(auth()->user()->role == 1 || auth()->user()->role == 2)

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                                <h4 class="sg_rate_title">Mais informação</h4>
                                <div class="d-block text-left mt-3">
                                    <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; font-size: 21px;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/contact.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                        Contactar
                                    </a>
                                </div>
                                <div class="d-block text-left mt-3">
                                    {{-- LinkedIn logo --}}
                                    <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 44px; font-size: 21px; background-color: #0766c1; border-color: #0766c1;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/LinkedIn_Logo.svg')}}" alt="" style="width: 110%;">
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                                <h4 class="sg_rate_title">A aguardar Validação</h4>
                                <div class="d-block text-left mt-3">
                                    <p class="exercise_author" style="line-height: 25px; font-style: italic;">
                                        Enquanto não for aprovado, não poderá 
                                        utilizar as <strong style="line-height: 25px;">Ferramentas</strong> de <strong style="line-height: 25px;">Ensino</strong>.
                                    </p>
                                </div>
                                <div class="d-block text-left mt-3">
                                    <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; font-size: 21px;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/contact.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                        Solicitar novamente
                                    </a>
                                </div>
                            </div>
                        </div>

                    @else

                        <h4 class="sg_rate_title">Mais informação</h4>
                        <div class="d-flex flex-column">
                            <p class="exercise_author"><strong>Instituição:</strong> St. Joseph University Macau </p>
                        </div>
                        <div class="d-flex float-left flex-column">
                            <p class="exercise_author"><strong>Professor:</strong> <a href="#" class="professor_link">João Paulo</a></p>
                            <p class="exercise_author"><strong>Turma:</strong> A
                        </div>
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

        @if(auth()->user()->role == 1 || auth()->user()->role == 2)

            {{-- professor - promoted exercises --}}
            <div class="row mb-5">
                <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                    <div class="wrap mb-3">
                        <h1 class="title">Exercícios promovidos pelo Utilizador</h1>
                    </div>
                    <div class="shop_grid_caption card-body m-0 mb-4">
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

                        <div class="d-block float-right mt-3">
                            <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Eye.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Visualizar
                            </a>
                        </div>
                        

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
                            
                    </div>

                    <div class="shop_grid_caption card-body m-0 mb-4">
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

                        <div class="d-block float-right mt-3">
                            <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Eye.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Visualizar
                            </a>
                        </div>
                        

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
                            
                    </div>

                    <div class="shop_grid_caption card-body m-0 mb-4">
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

                        <div class="d-block float-right mt-3">
                            <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Eye.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Visualizar
                            </a>
                        </div>
                        

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
                            
                    </div>

                    <div class="shop_grid_caption card-body m-0 mb-4">

                        <div class="d-block mt-3 mb-3">
                            <a href="/exercicios" class="btn btn-theme remove_button" style="float: none; padding: 12px 20px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/icon_View_Exercises.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Ver todos os Exercícios
                            </a>
                            <a href="/sala_de_aula" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Book.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Sala de Aula
                            </a>
                        </div>
                            
                    </div>
                </div>
            </div>

        @else

            {{-- student - My Performance --}}
            <div class="row mb-5">
                <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                    <div class="wrap mb-3">
                        <h1 class="title">O meu Desempenho</h1>
                    </div>
                    <div class="card-body" style="position: relative; overflow: hidden; height: 600px; display: grid;">
                        <img src="{{asset('/assets/backoffice_assets/icons/performance_icon.svg')}}" alt="" style="position: absolute; place-self: center;">
                    </div>
                </div>
            </div>

        @endif
        
    </div>

</section>
<!-- ============================ Find Courses with Sidebar End ================================== -->

@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https'))}}"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https'))}}"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/exercises.js', config()->get('app.https'))}}"></script>
    <script src="{{asset('/assets/js/ckeditor/ckeditor.js', config()->get('app.https'))}}"></script>
    <script src="{{asset('/assets/js/ckeditor/config.js', config()->get('app.https'))}}"></script>

    <script src="{{asset('/assets/js/dropzone/dist/dropzone.js', config()->get('app.https'))}}"></script>

    <script>

        // CKEDITOR.replace( 'intro_text' , {
        //     language: 'pt'
        // });

        // CKEDITOR.replace( 'statement' , {
        //     language: 'pt'
        // });

        // CKEDITOR.replace( 'audio_visual_description' , {
        //     language: 'pt'
        // });

        // CKEDITOR.replace( 'audio_transcription' , {
        //     language: 'pt'
        // });

        $(function() {
            // Change icon image on tab change
            changeIconImage();
            function changeIconImage(){
                $('#classroom_exercises_tabs a.nav-link').each(function(index, element){
                    if($(element).hasClass('active')){
                        $(element).find('.white_icon').show();
                        $(element).find('.black_icon').hide();
                    }
                    else{
                        $(element).find('.white_icon').hide();
                        $(element).find('.black_icon').show();
                    }
                });
            }

            $(document).on('click', '#classroom_exercises_tabs a.nav-link', function(){
                changeIconImage();
            });

            // Change right side info_accordion icon
            changeAccordionInfoIcon($('.info_accordion a'));
            function changeAccordionInfoIcon(selector){
                if($(selector).hasClass('collapsed')){
                    $(selector).find('.show_info_button').show();
                    $(selector).find('.hide_info_button').hide();
                }
                else{
                    $(selector).find('.show_info_button').hide();
                    $(selector).find('.hide_info_button').show();
                }
            }

            $(document).on('click', '.info_accordion a', function(){
                changeAccordionInfoIcon($(this));
            });

            $('#exercise_template').select2({
                placeholder: "Escolher exercício"
            });

            $('#categories').select2({
                placeholder: "Escolher categoria"
            });

            $('#levels').select2({
                placeholder: "Escolher Nível"
            });

            $('#class_select').select2();
            $('#student_select').select2();

            $('#fill_time').select2({
                placeholder: "Sel. Tempo"
            });

            $('#interruption_time').select2({
                placeholder: "Sel. Tempo"
            });

            $('#verbs_select_1').select2();

            $('#verbs_select_2').select2();

            $(document).on('click', '#perform_exercise_tabs .nav-link', function(){

                $('#perform_exercise_tabs_content .tab-pane').each(function(index, element){
                    $(element).removeClass('show');
                    $(element).removeClass('active');
                });

                var this_id = $(this).attr('id');

                $('#perform_exercise_tabs_content .tab-pane').each(function(index, element){

                    if($(element).attr('aria-labelledby') == this_id){
                        $(element).addClass('fade');
                        $(element).addClass('show');
                        $(element).addClass('active');

                        if($(element).attr('id') == 'listening'){
                            $('#perform_listening_tabs .nav-link:first').trigger('click');
                        }

                        if($(element).attr('id') == 'listening-shop'){
                            $('#perform_listening_shop_tabs .nav-link:first').trigger('click');
                        }
                    }
                });
            });

            function expandCollapseAccordion(selector){
                if(!$(selector).hasClass('expanded')){
                    $(selector).addClass('expanded');
                    $(selector).find('span').text('Ocultar');
                    $(selector).find('img.expand_chevron').hide();
                    $(selector).find('img.collapse_chevron').show();
                }
                else{
                    $(selector).removeClass('expanded');
                    $(selector).find('span').text('Expandir');
                    $(selector).find('img.expand_chevron').show();
                    $(selector).find('img.collapse_chevron').hide();
                }
            }

            $(document).on('click', '.expand_accordion', function(){
                expandCollapseAccordion($(this));
            });

            function hideAllDotIcons() {
                $('.student_dropdown a').each(function(index, element){
                    if(!$(element).parent().hasClass('show')){
                        $(element).find('img.filled_dots').hide();
                        $(element).find('img.empty_dots').show();
                    }
                });
            }

            // changeDotsIcons('.student_dropdown a');
            function changeDotsIcons(selector){
                if($(selector).parent().hasClass('show')){
                    $(selector).find('img.filled_dots').hide();
                    $(selector).find('img.empty_dots').show();
                    // hideAllDotIcons();
                }
                else if(!$(selector).parent().hasClass('show')){
                    $(selector).find('img.filled_dots').show();
                    $(selector).find('img.empty_dots').hide();
                }
            }

            $('.student_dropdown a').on('click', function(){
                // hideAllDotIcons();
                changeDotsIcons(this);
            });

            $('html, body').on('click', function(){
                $('.student_dropdown a').find('img.filled_dots').hide();
                $('.student_dropdown a').find('img.empty_dots').show();
            });

            // Select All Classes or Just one
            changeClass('#class_select');
            function changeClass(selector){
                // All Classes
                if($(selector).val() == 1){
                    $('p.all_classes').show();
                    $('p.one_class').hide();
                }
                // Single Class
                else{
                    $('p.all_classes').hide();
                    $('p.one_class').show();
                }
            }
            $(document).on('change', '#class_select', function(){
                changeClass($(this));
            })

        });

    </script>

@stop