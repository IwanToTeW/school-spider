<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];

    protected $hidden = ['id','news_id','name_large', 'created_at','updated_at'];

    public function news()
    {
        return $this->belongsTo('App\News', 'news_id');
    }
}
