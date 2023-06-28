<?php

namespace App\Http\Controllers\API;

use App\Helper\HttpResponses;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\News;
use App\Models\Sources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller{
    public function headlines(Request $request){
        $news   = new News();
        $result = $news->headlines($request);
        return $result;
    }

    public function search(Request $request){
        $news   = new News();
        $result = $news->search($request);
        return $result;
    }

    public function source(Request $request){
        $sources    = new Sources();
        return $sources->list();
    }
}
