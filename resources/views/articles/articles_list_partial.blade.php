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

    <div class="row">
        @if ($articles->isEmpty())
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="shop_grid">
                    <div class="shop_grid_caption">
                        <h4 class="sg_rate_title" style="font-size: 20px;">
                            Não foram encontrados artigos com os filtros aplicados.
                        </h4>
                    </div>
                </div>
            </div>
        @else

        @foreach ($articles as $article)
            <div class="col-lg-12 col-md-12 col-sm-12">
        
                <div class="shop_grid">
                    <div class="shop_grid_thumb img">
                        <img src="{{ $article->poster ? '/webapp-macau-storage/articles/'.$article->id.'/poster/'.$article->poster->media_url : 'https://via.placeholder.com/500x500'}}"
                         class="img-fluid" alt="" />
                    </div>
                    <div class="shop_grid_caption">
                        {{-- Like buttons heart/heart_filled --}}
                        <img class="heart_icon" data-article-id="{{ $article->id }}"
                    src="{{asset('/assets/backoffice_assets/icons/Heart.svg')}}" alt="" style="display: {{ $article->is_article_favorite ? 'none;' : 'block;' }}">
                        <img class="heart_filled_icon" data-article-id="{{ $article->id }}"
                            src="{{asset('/assets/backoffice_assets/icons/Heart_filled.svg')}}" alt="" style="display: {{ $article->is_article_favorite ? 'block;' : 'none;' }}">
                        <h4 class="sg_rate_title">{{ $article->title }}</h4>
                        <p class="article_author"><strong>Por:</strong> {{ $article->user->username }}</p>
                        <div class="article_description">{!! $article->text !!}</div>
                        @foreach ($article->article_tags as $tag)
                            <div class="gray_tag_div" style="background-image: url({{asset('/assets/backoffice_assets/images/tag_gray_div.svg')}});">
                                <p>{{ $tag->name }}</p>
                            </div>
                        @endforeach
                        <br>
                        <div class="article_buttons">
                            @if(auth()->user()->id == $article->user_id)
                                <a href="/artigos/editar/{{ $article->id }}" class="btn btn-theme edit_button">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Pencil.svg')}}" alt="">Editar
                                </a>
                                <a href="#" class="btn btn-theme remove_button remove_article" data-article-id="{{ $article->id }}">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="">Remover
                                </a>
                            @endif
                            <a href="#" class="btn btn-theme share_button">
                                <img src="{{asset('/assets/backoffice_assets/icons/share.svg')}}" alt="">Partilhar
                            </a>
                        </div>
                        <div class="read_more">
                            <a href="/artigos/detalhe/{{ $article->id }}" class="">Ler mais <img src="{{asset('/assets/backoffice_assets/icons/Add.svg')}}" alt="" style="margin-left: 5px; margin-top: -2px; margin-right: 10px;"></a>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        @endforeach

        @endif
        
    </div>

<!-- Row -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        
        <!-- Pagination -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                {{ $articles->appends($inputs)->links('layouts.pagination-macau') }}
                
            </div>
        </div>
        
    </div>
</div>
<!-- /Row -->