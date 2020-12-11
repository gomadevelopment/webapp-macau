<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use App\Article,
    App\ArticleCategory,
    App\Tag,
    App\ArticleFavorite,
    App\ArticleTag;

use DB;

class ArticlesController extends Controller
{
    public function index()
    {
        $inputs = request()->all();

        $article_categories = ArticleCategory::get();
        $tags = Tag::get();
        // dd($inputs);
        if(!empty($inputs)){
            // dd($inputs);
            try {
                // Delete article
                if(isset($inputs['article_to_delete_id']) && $inputs['article_to_delete_id']){
                    $id = $inputs['article_to_delete_id'];
                    $article = Article::find($id);

                    if (!$article) {
                        return response()->json(['status' => 'error', 'message' => 'Ocorreu um erro ao apagar este artigo. Por favor, tente de novo!'], 200);
                    }

                    DB::beginTransaction();
                    try{
                        foreach(ArticleTag::where('article_id', $article->id)->get() as $article_tag){
                            $article_tag->delete();
                        }
                        foreach(ArticleFavorite::where('article_id', $article->id)->get() as $article_fav){
                            $article_fav->delete();
                        }
                        $article->poster()->delete();
                        $article->medias()->delete();
                        $article->delete();
                    }catch (\Exception $e) {
                        // dd($e);
                        DB::rollback();
                        return response()->json(['status' => 'error', 'message' => 'Ocorreu um erro ao apagar este artigo. Por favor, tente de novo!'], 200);
                    }
                    DB::commit();
                }

                $articles = Article::applyFilters($inputs);

                foreach($articles as $article){
                    $article['is_article_favorite'] = $article->is_article_favorite();
                }

                $articles->withPath('/artigos');

                $view = view()->make("articles.articles_list_partial", [
                    'articles' => $articles,
                    'article_categories' => $article_categories,
                    'tags' => $tags,
                    'inputs' => $inputs
                ]);
                $html = $view->render();
            } catch (\Exception $e) {
                // dd($e);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ocorreu um erro ao aplicar os filtros! Por favor, atualize a página e tente de novo.'
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => isset($inputs['article_to_delete_id']) && $inputs['article_to_delete_id'] ? 'Artigo removido com sucesso!' : null,
                'html' => $html
            ]);
        }

        $articles = Article::orderBy('created_at', 'asc')->paginate(4);

        foreach($articles as $article){
            $article['is_article_favorite'] = $article->is_article_favorite();
        }

        $inputs['page'] = 1;
        $inputs['article_order_by_date_asc'] = 'off';
        $inputs['article_order_by_date_desc'] = 'off';
        $inputs['all_categories'] = 'on';
        $inputs['show_all'] = 'on';

        return view('articles.index', compact('articles', 'article_categories', 'tags', 'inputs'));
        
    }

    public function details($id)
    {
        $article = Article::find($id);

        return view('articles.details', compact('article'));
    }

    public function save($id = null)
    {
        $article = $id ? Article::find($id) : new Article;

        $article_categories = ArticleCategory::get();
        $tags = Tag::get();

        return view('articles.save', compact('article', 'article_categories', 'tags'));
    }

    public function savePost($id = null)
    {
        $inputs = request()->all();
        // dd($inputs);
        $article = $id ? Article::find($id) : new Article;

        $rules = $id ? Article::rulesForEdit() : Article::$rulesForAdd;

        $validator = \Validator::make($inputs, Article::rulesForEdit(), Article::$messages);

        if ($validator->fails()) {
            request()->session()->flash('save_article_error', 'Por favor, verifique os erros no formulário.');
            request()->session()->flash('error', 'Ocorreu um erro ao criar/editar o artigo. Por favor, tente de novo!');

            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
                'message' => 'Ocorreu um erro ao criar/editar o artigo. Por favor, verifique os erros no formulário.'
            ]);
        }

        DB::beginTransaction();
        try {
            
            $article->saveArticle($inputs);

        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();

            request()->session()->flash('save_article_error', 'Por favor, verifique os erros no formulário.');
            request()->session()->flash('error', 'Ocorreu um erro ao criar/editar o artigo. Por favor, tente de novo!');
            return response()->json([
                'status' => 'error',
                'message' => 'Ocorreu um erro ao criar/editar o artigo. Por favor, verifique os erros no formulário.'
            ]);
        }
        DB::commit();

        request()->session()->flash('success', 'Artigo criado/atualizado com sucesso!');

        return response()->json([
            'status' => 'success',
            'url' => '/artigos'
        ]);
    }

    public function toggleFavorite()
    {
        $data = request()->only('article_id', 'toggle');
        
        $article = Article::find($data['article_id']);

        if($data['toggle'] == 'on'){
            ArticleFavorite::create([
                'article_id' => $article->id,
                'user_id' => auth()->user()->id
            ]);
        }
        else {
            ArticleFavorite::where('article_id', $article->id)->where('user_id', auth()->user()->id)->delete();
        }

        return response()->json(['status' => 'success'], 200);
    }

    public function getArticlePoster($article_id)
    {
        $article = Article::find($article_id);
        if(!$article->poster){
            return 'no_poster';
        }
        $path = 'webapp-macau-storage/articles/'.$article_id.'/poster/'.$article->poster->media_url;
        $poster_file = new File($path);
        $array = [
            'poster' => [
                'name' => $poster_file->getFilename(),
                'size' => $poster_file->getSize(),
                'path' => '/'.$poster_file->getPathname()
            ]
        ];
        return $array;
    }

    public function getArticleMedias($article_id)
    {
        $article = Article::find($article_id);
        $count = 0;
        $array = [];
        if(!$article->medias()){
            return 'no_medias';
        }
        foreach ($article->medias()->get() as $media) {
            // dd($media);
            $path = 'webapp-macau-storage/articles/'.$article_id.'/medias/'.$media->media_url;
            $media_file = new File($path);
            $array['media_'.$count] = 
            [
                'name' => $media_file->getFilename(),
                'size' => $media_file->getSize(),
                'path' => '/'.$media_file->getPathname()
            ];
            $count++;
        }

        return $array;
    }
}
