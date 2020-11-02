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
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/artigos">Artigos</a></li>
                            <li class="breadcrumb-item"><a href="#">Personalidades</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sobre Astrid Pires</li>
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
                                <img src="{{asset('/assets/backoffice_assets/images/woman_thumbnail_big.png')}}" class="img-fluid" alt="" />
                            </div>
                            <div class="shop_grid_caption card_content article_detail_wrapss">
                                <div class="container">
                                    <h1 class="sg_rate_title article_title">A história de Astrid Pires</h1>
                                    <p class="article_author"><strong>Por:</strong> João Monteiro | 5 min. de leitura</p>

                                    <div class="article_content">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                        Sed ac mi non est consectetur pellentesque at et lorem. 
                                        Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. 
                                        Nunc commodo fermentum tincidunt. 
                                        Sed mollis, lectus non egestas posuere, tellus purus aliquam enim, ac hendrerit est augue nec nulla. 
                                        Nulla nec orci non magna finibus pharetra. 
                                        Sed tellus sapien, ultrices eget erat at, pellentesque efficitur ipsum. 
                                        Cras euismod lectus in ipsum lacinia, eget facilisis dolor commodo. 
                                        Pellentesque lacus urna, tincidunt ut ex non, bibendum venenatis orci. 
                                        Phasellus vel semper dui. Integer porttitor est eu magna posuere imperdiet.
                                        <br>
                                        Nunc eros arcu, commodo blandit neque eu, pulvinar malesuada augue. 
                                        Proin luctus eu libero iaculis fermentum. 
                                        Integer dui mauris, venenatis nec dapibus bibendum, placerat sed lorem. 
                                        Etiam vel placerat nibh. In a suscipit tortor, sed pretium tortor. 
                                        Sed facilisis, tortor sed dignissim bibendum, dui tellus aliquet lectus, eu elementum nisi est et ligula. 
                                        Nunc at sollicitudin libero.
                                        
                                    </div>
                                    <div style="margin-top: 30px;">
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
                                            <a href="#" class="btn btn-theme share_button">
                                                <img src="{{asset('/assets/backoffice_assets/icons/share.svg')}}" alt="">Partilhar
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                    {{-- <div class="comments">
                                        <h4 class="comments_label">Comentários</h4>

                                        <div class="unique_comment">
                                            <div class="user_comment">
                                                <a href="#" class="comments_label user_avatar">
                                                    <img src="https://via.placeholder.com/500x500" class="img-fluid avatar" alt="">
                                                    Luis Antunes
                                                </a>
                                            </div>
                                            <div class="content_comment">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac mi non est consectetur pellentesque at et lorem.</p>
                                            </div>
                                        </div>
                                    </div> --}}
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
                                                                    <img class="heart_icon" src="{{asset('/assets/backoffice_assets/icons/Heart.svg')}}" alt="">
                                                                    <img class="heart_filled_icon" src="{{asset('/assets/backoffice_assets/icons/Heart_filled.svg')}}" alt="" style="display: none;">
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
                                                                    <img class="heart_icon" src="{{asset('/assets/backoffice_assets/icons/Heart.svg')}}" alt="">
                                                                    <img class="heart_filled_icon" src="{{asset('/assets/backoffice_assets/icons/Heart_filled.svg')}}" alt="" style="display: none;">
                                                                </div>
                                                            </div>
                                                        </article>
                                                    </li>
                                                    {{-- Duplicar aqui --}}
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
                                                                {{-- type="submit" --}}
                                                                <button type="" class="btn search-btn comment_submit">Submeter Comentário</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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