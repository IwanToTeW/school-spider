<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];

    public function news()
    {
        return $this->belongsTo('App\News', 'news_id');
    }
}
