@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}?v=1.3">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}?v=1.3">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/classroom.css', config()->get('app.https')) }}?v=1.3">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/users.css', config()->get('app.https')) }}?v=1.3">

<link rel="stylesheet" href="{{asset('/assets/js/bootstrap-datepicker/dist/css/bootstrap-datepicker.css', config()->get('app.https')) }}" id="bscss">

@stop

@section('content')

@if (session('restrict_page_error'))
    <div class="global-alert alert alert-danger" role="alert">
        {{session('restrict_page_error')}}
    </div>
@endif

<!-- ============================ Page Title Start================================== -->
<section class="page-title articles">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <div class="wrap">
                    <h1 class="title">Questões</h1>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- ============================ Page Title End ================================== -->	

<!-- ============================ Find Courses with Sidebar ================================== -->
<section class="pt-0">
    <div class="container questions_list_partial">

            @include('questions.list_partial')
        
    </div>
</section>

<!-- ============================ Find Courses with Sidebar End ================================== -->

@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https')) }}?v=1.3"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https')) }}?v=1.3"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/exercises.js', config()->get('app.https')) }}?v=1.3"></script>
    <script src="{{asset('/assets/js/ckeditor/ckeditor.js', config()->get('app.https')) }}?v=1.3"></script>
    <script src="{{asset('/assets/js/ckeditor/config.js', config()->get('app.https')) }}?v=1.3"></script>

    <script src="{{asset('/assets/js/bootstrap-datepicker/dist/js/bootstrap-datepicker.js', config()->get('app.https'))}}"></script>
    <script src="{{asset('/assets/js/bootstrap-datepicker/dist/js/bootstrap-datepicker.pt.min.js', config()->get('app.https'))}}"></script>

    <script>

        $(function() {

            $('#questions_filter_exercises').select2({
                placeholder: "Escolha um Exercício..."
            });

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

            $(document).on('click', '#apply_filters, .pagination.questions .page-item a', function(e){
                e.preventDefault();

                $('.preloader.ajax.questions').next("table").hide();
                $('.preloader.ajax.questions')
                    .css('height', $('.preloader.ajax.questions').next("table").height())
                    .show();

                var this_anchor = this;

                var filters_expanded = $(this).closest('#collapse_questions_filters').hasClass('show') ? true : false;

                // Pagination
                if($(this).parent().hasClass('page-item')){
                    if($(this).attr('data-page') == 1){
                        $('#previous_questions_page_number').attr('value', 1);
                    }
                    else{
                        $('#previous_questions_page_number').attr('value', $('#questions_page_number').attr('value'));
                    }
                    
                    $('#questions_page_number').attr('value', $(this).attr('data-page'));
                    
                    $('.pagination.questions li').each(function(index, element){
                        $(element).removeClass('current_page_active');
                    });
                    $(this).parent().addClass('current_page_active');
                    $("html, body").animate({ scrollTop: 0 }, 500);
                }

                var page = $('#questions_page_number').attr('value');

                var data = {
                    page : page,
                    questions_filter_reference : $('#questions_filter_reference').val(),
                    questions_filter_exercises : $('#questions_filter_exercises').val(),
                };

                $.ajax({
                    type: 'GET',
                    url: '/questoes',
                    data: data,
                    success: function(response){
                        if(response && response.status == 'success'){
                            $('.questions_list_partial').html(response.html);

                            $('.preloader.ajax.questions').next("table").show();
                            $('.preloader.ajax.questions')
                                .hide();

                            $('#questions_filter_exercises').select2({
                                placeholder: "Escolha um Exercício..."
                            });

                            $('.none_questions_found').text('Não foram encontradas Questões.')

                            $('#settings_articles_filter_article_published').select2();
                            $('#settings_articles_filter_user_can_publish').select2();

                            if(filters_expanded){
                                console.log(filters_expanded, 'AQUI');
                                $('a.questions_filters_accordion').click();
                            }
                        }
                        else{
                            $(".errorMsg").text(response.message);
                            $(".errorMsg").fadeIn();
                            setTimeout(() => {
                                $(".errorMsg").fadeOut();
                            }, 5000);
                        }
                    }
                });
            });

        });

    </script>

@stop