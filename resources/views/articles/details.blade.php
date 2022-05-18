@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}?v=2.4">

@stop

@section('content')

<!-- ============================ Page Title Start================================== -->
<section class="page-title articles">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <div class="breadcrumbs-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/artigos">Biblioteca</a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Personalidades</a></li> --}}
                            <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- ============================ Page Title End ================================== -->	

<!-- ============================ Details card body ================================== -->
<section class="pt-0">
    <div class="container">

        <!-- Row -->
        <div class="row">
            
            <div class="col-lg-12 col-md-12 col-sm-12 order-1 order-lg-2 order-md-1">
                
                <div class="row">
            
                    <!-- Single Product -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                
                        <div class="shop_grid article_details_card blog-page">
                            <div class="shop_grid_thumb img card_img">
                                <img src="{{ $article->poster ? '/webapp-macau-storage/articles/'.$article->id.'/poster/'.$article->poster->media_url : 'https://via.placeholder.com/500x500' }}"
                                 class="img-fluid" alt="" />
                            </div>
                            <div class="shop_grid_caption card_content article_detail_wrapss">
                                <div class="container">
                                    <h1 class="sg_rate_title article_title">{{ $article->title }}</h1>
                                    <p class="article_author"><strong>Por:</strong> {{ $article->user->username }}</p>

                                    <div class="article_content">
                                        {!! $article->text !!}
                                    </div>
                                    @if ($article->medias())
                                        <div class="article_content text-center">
                                            {{-- {{ var_dump($article->medias) }} --}}
                                            @foreach ($article->medias as $media)
                                                <img src="{{ '/webapp-macau-storage/articles/'.$article->id.'/medias/'.$media->media_url }}" alt=""
                                                width="300px" height="auto">
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                        @foreach ($article->article_tags as $tag)
                                            <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                                <p>{{ $tag->name }}</p>
                                            </div>
                                        @endforeach
                                    <div class="article_buttons">
                                            <a href="#" class="btn btn-theme share_button">
                                                <img src="{{asset('/assets/backoffice_assets/icons/share.svg', config()->get('app.https'))}}?v=2.4" alt="">Partilhar
                                            </a>
                                        </div>
                                    {{-- <hr>
                                    <div class="comment-area">
                                        <div class="all-comments">
                                            <h3 class="comments-title">Comentários</h3>
                                            <div class="comment-list">
                                                <ul>
                                                    <li class="article_comments_wrap">
                                                        <article>
                                                            <div class="article_comments_thumb">
                                                                <a href="#">
                                                                    <img src="https://via.placeholder.com/500x500" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="comment-details">
                                                                <div class="comment-meta">
                                                                    <div class="comment-left-meta">
                                                                        <a href="#" class="author-name">Luis Antunes</a>
                                                                    </div>
                                                                </div>
                                                                <div class="comment-text">
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac mi non est consectetur pellentesque at et lorem.</p>
                                                                </div>
                                                                <div class="comment-info">
                                                                    <p class="time-ago">12 min.</p>
                                                                    <a href="#" class="reply" style="margin-left: 5px;">Responder</a>
                                                                    <img class="heart_icon" src="{{asset('/assets/backoffice_assets/icons/Heart.svg', config()->get('app.https'))}}?v=2.4" alt="">
                                                                    <img class="heart_filled_icon" src="{{asset('/assets/backoffice_assets/icons/Heart_filled.svg', config()->get('app.https'))}}?v=2.4" alt="" style="display: none;">
                                                                </div>
                                                            </div>
                                                        </article>
                                                    </li>
                                                    <li class="article_comments_wrap">
                                                        <article>
                                                            <div class="article_comments_thumb">
                                                                <a href="#">
                                                                    <img src="https://via.placeholder.com/500x500" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="comment-details">
                                                                <div class="comment-meta">
                                                                    <div class="comment-left-meta">
                                                                        <a href="#" class="author-name">Luis Antunes</a>
                                                                    </div>
                                                                </div>
                                                                <div class="comment-text">
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac mi non est consectetur pellentesque at et lorem.</p>
                                                                </div>
                                                                <div class="comment-info">
                                                                    <p class="time-ago">12 min.</p>
                                                                    <a href="#" class="reply" style="margin-left: 5px;">Responder</a>
                                                                    <img class="heart_icon" src="{{asset('/assets/backoffice_assets/icons/Heart.svg', config()->get('app.https'))}}?v=2.4" alt="">
                                                                    <img class="heart_filled_icon" src="{{asset('/assets/backoffice_assets/icons/Heart_filled.svg', config()->get('app.https'))}}?v=2.4" alt="" style="display: none;">
                                                                </div>
                                                            </div>
                                                        </article>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="comment-box submit-form">
                                            <div class="comment-form">
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <textarea name="comment" class="form-control" cols="10" rows="2" placeholder="Escreve o teu comentário..."></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <button type="" class="btn search-btn comment_submit">Submeter Comentário</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        
        </div>
        <!-- Row -->
        
    </div>
</section>
<!-- ============================ Find Courses with Sidebar End ================================== -->

@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https')) }}?v=2.4"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https')) }}?v=2.4"></script>

    <script>
        function openNav() {
            document.getElementById("filter-sidebar").style.width = "320px";
        }

        function closeNav() {
            document.getElementById("filter-sidebar").style.width = "0";
        }
    </script>

@stop
