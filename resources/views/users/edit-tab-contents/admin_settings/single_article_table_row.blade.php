<th scope="row"> <a href="/artigos/detalhe/{{ $article->id }}" class="link_on_table">{{ $article->title }}</a> </th>
<td>
    <span class="payment_status approve_article {{ $article->published ? 'complete' : 'cancel' }}">
            {{ $article->published ? 'Publicado' : 'Não Publicado' }}
    </span>
</td>
<td>
    <div class="dash_action_link">
        @if($article->published)
            <a href="#" class="approve_article cancel" data-id="{{ $article->id }}">Despublicar</a>
        @else
            <a href="#" class="approve_article view" data-id="{{ $article->id }}">Publicar</a>
        @endif
    </div>	
</td>
<th scope="row"> <a href="/perfil/{{ $article->user->id }}" class="link_on_table">{{ $article->user->username }}</a> </th>
<td>
    <span class="payment_status approve_user {{ $article->user->can_post_articles ? 'complete' : 'cancel' }}">
            {{ $article->user->can_post_articles ? 'Sim' : 'Não' }}
    </span>
</td>
<td>
    <div class="dash_action_link">
        @if($article->user->can_post_articles)
            <a href="#" class="approve_user cancel" data-id="{{ $article->id }}">Desaprovar</a>
        @else
            <a href="#" class="approve_user view" data-id="{{ $article->id }}">Aprovar</a>
        @endif
    </div>	
</td>