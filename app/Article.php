<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'text', 'article_category_id'
    ];   

    /**
     * Validation Rules for user add
     *
     * @var array
     */
    public static $rulesForAdd = array(
        'title' => 'required',
        'text' => 'required',
        'poster_files' => 'required'
    );

    public static function rulesForEdit($id = 0, $merge = [])
    {
        return array_merge([
            'title' => 'required',
            'text' => 'required',
            'poster_files' => 'required'
        ], $merge);
    }

    /**
     * Validation Messages for user add
     *
     * @var array
     */
    public static $messages = array(
        'title.required' => 'O título do artigo é de preenchimento obrigatório.',
        'text.required' => 'A descrição do artigo é de preenchimento obrigatório.',
        'poster_files.required' => 'A foto de capa é de preenchimento obrigatório.',
    );

    /**
     * Category
     */
    public function category()
    {
        return $this->belongsTo('App\ArticleCategory', 'article_category_id');
    }

    /**
     * User
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Article Tags pivot
     */
    public function article_tags() { 
        return $this->belongsToMany(
            'App\Tag', 
            'articles_tags', 
            'article_id', 
            'tag_id'
        );
    }

    /**
     * Article Favorites pivot
     */
    public function article_favorite() {
        return $this->belongsToMany(
            'App\User', 
            'article_favorites', 
            'article_id', 
            'user_id'
        );
    }

    /**
     * Medias
     */
    public function medias()
    {
        return $this->hasMany('App\ArticleMedia')->where('poster', 0);
    }

    /**
     * Poster
     */
    public function poster()
    {
        return $this->hasOne('App\ArticleMedia')->where('poster', 1);
    }

    public function is_article_favorite()
    {
        if(ArticleFavorite::where('article_id', $this->id)->where('user_id', auth()->user()->id)->first()){
            return true;
        }
        else{
            return false;
        }
    }

    public function saveArticle($inputs)
    {
        // dd($inputs);
        
        $this->user_id = auth()->user()->id;
        $this->title = $inputs['title'];
        $this->text = $inputs['text'];
        $this->article_category_id = $inputs['category'];

        $this->save();

        if(isset($inputs['tags'])){
            ArticleTag::where('article_id', $this->id)->delete();
            foreach ($inputs['tags'] as $tag) {
                ArticleTag::create([
                    'article_id' => $this->id,
                    'tag_id' => $tag
                ]);
            }
            $this->save();
        }

        if(isset($inputs['poster_files'])){
            if(isset($inputs['media_files'])){
                self::updatePosterAndMedias($this->id, $inputs['poster_files'], $inputs['media_files']);
            }
            else{
                self::updatePosterAndMedias($this->id, $inputs['poster_files']);
            }
        }
    }

    public function updatePosterAndMedias($article_id, $poster, $medias = [])
    {
        // dd(is_string($poster), $medias);

        if(!is_string($poster)){
            self::find($article_id)->poster()->delete();
            $upload_date = date('Y-m-d_H:i:s_');
            $paths = [];

            Storage::disk('webapp-macau-storage')->deleteDirectory('articles/'.$article_id.'/poster');

            $fileName = $upload_date . $poster->getClientOriginalName();

            $paths = $poster->storeAs('/articles/'
                . $article_id . '/poster', $fileName, 'webapp-macau-storage');

            ArticleMedia::create([
                'article_id' => $article_id,
                'media_url' => $fileName,
                'poster' => 1
            ]);
        }
            

        if(!empty($medias)){
            // Upload medias
            $skip_medias = [];
            foreach(self::find($article_id)->medias()->get() as $existing_media){
                // dd(self::find($article_id)->medias()->get(), $medias);
                foreach($medias as $media){
                    if(is_string($media) && $media == $existing_media->media_url){
                        $skip_medias[] = $media;
                    }
                    else{
                        $existing_media->delete();
                        Storage::disk('webapp-macau-storage')->delete('articles/'.$article_id.'/medias/'.$existing_media->media_url);
                    }
                }
            }
            // dd('stop', $skip_medias);
            // self::find($article_id)->medias()->delete();
            

            // Storage::disk('webapp-macau-storage')->deleteDirectory('articles/'.$article_id.'/medias');
            foreach ($medias as $media) {
                
                if(!is_string($media)){
                    $upload_date = date('Y-m-d_H:i:s_');
                    $paths = [];

                    $fileName = $upload_date . $media->getClientOriginalName();

                    $paths = $media->storeAs('/articles/'
                        . $article_id . '/medias', $fileName, 'webapp-macau-storage');

                    ArticleMedia::create([
                        'article_id' => $article_id,
                        'media_url' => $fileName,
                        'poster' => 0
                    ]);
                }
            }

        }
    }

    public static function applyFilters($filters = [])
    {
        // Order by date filter
        if($filters['article_order_by_date_asc'] == 'on'){
            $query = self::orderBy('created_at', 'asc');
        }
        else if($filters['article_order_by_date_desc'] == 'on'){
            $query = self::orderBy('created_at', 'desc');
        }
        else{
            $query = self::orderBy('created_at', 'asc');
        }

        // My Favorites filter
        if(isset($filters['my_favorites'])){
            $query = $query->whereHas('article_favorite', function($q) {
                return $q->where('article_favorites.user_id', auth()->user()->id);
            });
        }

        // Categories filters
        if(!isset($filters['all_categories']) && isset($filters['categories']) && !empty($filters['categories'])){
            $query = $query->whereIn('article_category_id', $filters['categories']);
        }
        
        // "Show" filters
        if(!isset($filters['show_all'])){
            if(isset($filters['show_my_articles'])){
                $query = $query->where('user_id', auth()->user()->id);
            }
            if(isset($filters['show_my_students_articles'])){
                // $query = $query->where('user_id', auth()->user()->id);
            }
            if(isset($filters['show_my_professor_articles'])){
                // $query = $query->where('user_id', auth()->user()->id);
            }
            if(isset($filters['show_all_students_articles'])){
                $query = $query->whereHas('user', function($q) {
                                $q->where('user_role_id', 3);
                            });
            }
            if(isset($filters['show_all_professors_articles'])){
                $query = $query->whereHas('user', function($q) {
                                $q->where('user_role_id', 1)
                                    ->orWhere('user_role_id', 2);
                            });
            }
        }

        // Tags filters
        if(isset($filters['tags']) && !empty($filters['tags'])){
            $query = $query->whereHas('article_tags', function($q) use ($filters) {
                return $q->whereIn('articles_tags.tag_id', $filters['tags']);
            });
        }

        $skip = $filters['page'] * 4;

        return $query->skip($skip)->paginate(4);
    }
}
