<?php

namespace App\Http\Controllers\API;

use App\Helper\HttpResponses;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller{
    public function headlines(){
        $news   = new News();
        $result = $news->headlines();
        return $result;
    }

}
