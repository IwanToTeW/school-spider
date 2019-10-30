<?php


namespace App\Http\Controllers;

use App\News;
use DB;

class NewsExampleController
{
    public function showOne($item)
    {

        $news = News::where('id', $item)->firstOrFail();

        dd($news);

        return $item;
    }

    public function showAll()
    {

        $news = News::all();

        return $news;
    }
}
