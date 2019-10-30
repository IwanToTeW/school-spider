<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    // This hides columns if we want to
    protected $hidden = ['timestamp'];

    protected $fillable = ['title', 'content'];

    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
