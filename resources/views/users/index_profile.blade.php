@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/classroom.css', config()->get('app.https')) }}">

@stop

@section('content')

<div class="alert alert-success successMsg" style="display:none;" role="alert">

</div>

<div class="alert alert-danger errorMsg" style="display:none;" role="alert">

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
                        <img src="{{ $user->avatar_url ? '/webapp-macau-storage/avatars/'.$user->id.'/'.$user->avatar_url : 'https://via.placeholder.com/500x500'}}"
                        alt="" class="user_round_avatar">
                        
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
                        @if ($user->id == auth()->user()->id)
                            <a href="/perfil/editar/{{ auth()->user()->id }}" class="btn search-btn comment_submit mt-4" style="float: none; padding: 12px 20px; font-size: 21px;">
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
                    @if($user->user_role_id == 1 || $user->user_role_id == 2)
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

                    @if($user->user_role_id == 1 || $user->user_role_id == 2)

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

        @if($user->user_role_id == 1 || $user->user_role_id == 2)

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

<input type="text" name="hidden_user_id" id="hidden_user_id" value="{{ $user->id }}" hidden>


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
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('input[name="_token"]').attr("value")
                }
            });

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
                                }, 2000);
                            }
                        }
                    });
                }, 50);
            });

        });

    </script>

@stop