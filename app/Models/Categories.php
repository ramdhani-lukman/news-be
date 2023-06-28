<?php

namespace App\Models;

use App\Helper\HttpResponses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    public function list(){
        return HttpResponses::success([
            'business',
            'entertainment',
            'general',
            'health',
            'science',
            'sports',
            'technology'
        ]);
    }
}
