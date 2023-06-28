<?php
namespace App\DataSource;

use App\Helper\HttpResponses;
use App\Models\News;
use Illuminate\Support\Facades\Http;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class NewsApi{
    const URL_NEWS_LIST = "https://newsapi.org/v2/everything";
    const URL_TOP_HEADLINES = "https://newsapi.org/v2/top-headlines";
    const URL_EVERYTHING = "https://newsapi.org/v2/everything";

    

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

    public function search($query = null, $source = null, $from = null, $to = null, $page = 1){
        try {
            $request   = Http::get(self::URL_EVERYTHING,[
                'apiKey' => env('NEWS_API_KEY'),
                'pageSize' => 10,
                'page' => $page,
                'q' => $query,
                'sources' => $source,
                'from' => $from,
                'to'    => $to
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