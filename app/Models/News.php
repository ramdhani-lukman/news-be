<?php

namespace App\Models;

use App\DataSource\Factory;
use App\DataSource\NewsApi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class News extends Model
{
    use HasFactory;
    public $fillable = [
        'title',
        'description',
        'author',
        'date',
        'image',
        'url',
        'source'
    ];
    public function headlines(Request $request){
        /* News API Data */
        $newsAPI    = new NewsApi;
        $query      = $request->has('q') ? $request->q : null;
        $category      = $request->has('category') ? $request->category : null;
        $authors      = $request->has('authors') ? $request->authors : null;
        $page      = $request->has('page') ? intval($request->page) : 1;

        return $headlines  = $newsAPI->headlines($query, $category, $authors, $page);
    }

    public function search(Request $request){
        $newsAPI    = new NewsApi;
        return $newsAPI->search($request->q,$request->sources,$request->from,$request->to,$request->page);
    }

    public static function make($title,$description, $author, $date, $image, $url, $source){
        return new News([
            'title' => $title,
            'description' => $description,
            'author' => $author,
            'date' => $date,
            'image' => $image,
            'url'   => $url,
            'source' => $source
        ]);
    }

}
