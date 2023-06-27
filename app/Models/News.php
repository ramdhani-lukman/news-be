<?php

namespace App\Models;

use App\DataSource\Factory;
use App\DataSource\NewsApi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'url'
    ];
    public function headlines(){
        /* News API Data */
        $newsAPI    = new NewsApi;
        return $headlines  = $newsAPI->headlines();
    }

    public static function make($title,$description, $author, $date, $image, $url){
        return new News([
            'title' => $title,
            'description' => $description,
            'author' => $author,
            'date' => $date,
            'image' => $image,
            'url'   => $url
        ]);
    }

}
