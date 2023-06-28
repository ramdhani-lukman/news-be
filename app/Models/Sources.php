<?php

namespace App\Models;

use App\Helper\HttpResponses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Sources extends Model
{
    use HasFactory;

    const URL_SOURCES = "https://newsapi.org/v2/sources";

    public function list(){
        $request   = Http::get(self::URL_SOURCES,[
            'apiKey' => env('NEWS_API_KEY')
        ]);
        if($request->failed()){
            return HttpResponses::error("Failed fetching sources");
        }

        $requestBody    = json_decode($request->body());
        $sources        = $requestBody->sources;
        return HttpResponses::success($sources);
    }
}
