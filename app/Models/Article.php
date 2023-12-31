<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    const SEARCH_INDEX = 'articles.index';
    
    protected $fillable = [
        'title',
        'body'
    ];
}