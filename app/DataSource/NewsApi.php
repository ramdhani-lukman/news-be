<?php
namespace App\DataSource;

use App\Helper\HttpResponses;
use App\Models\News;
use Illuminate\Support\Facades\Http;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class NewsApi{
    const URL_NEWS_LIST = "https://newsapi.org/v2/everything";
    const URL_TOP_HEADLINES = "https://newsapi.org/v2/top-headlines";
    
    public function search($category = null, $authors = null, $query = null){ 
        $request   = Http::get(self::URL_NEWS_LIST,[
            'apiKey' => env('NEWS_API_KEY')
        ]);

        if($request->failed()){
            throw new InternalErrorException("Error Processing Request");
        }

        $object = $request->object();
    }

    public function headlines($query = null, $category = null, $authors = null, $page = 1){
        try {
            $request   = Http::get(self::URL_TOP_HEADLINES,[
                'apiKey' => env('NEWS_API_KEY'),
                'country' => 'us',
                'pageSize' => 10,
                'page' => $page,
                'q' => $query,
                'category' => $category
            ]);
        } catch (\Throwable $th) {
            return HttpResponses::error("Failed fetching headlines");
        }

        if($request->failed()){
            return false;
        }
        $requestBody = json_decode($request->body());
        $articles   = $requestBody->articles;
        $newsItems  = [];
        foreach($articles as $article){
            $news = News::make(
                $article->title,
                $article->description,
                $article->author,
                $article->publishedAt, 
                $article->urlToImage,
                $article->url,
                $article->source->name
            );
            $newsItems[] = $news;
        }
        return HttpResponses::success($newsItems);
    }

}