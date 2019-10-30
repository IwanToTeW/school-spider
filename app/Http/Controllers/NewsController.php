<?php

namespace App\Http\Controllers;

use App\Image;
use App\News;
use DateTime;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as ImageResize;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = News::latest()->paginate(5);
//        $data = News::all();

//        dd($data);
        return view('index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'    =>  'required',
            'text'  =>  'required',
            'images'    =>  'required'
        ]);

        $formData = [
            'title' => $request->title,
            'content' => $request->text,
        ];

        $news = News::create($formData);

        // Check if there are any images uploaded
        if ($image = $request->file('images')) {
            foreach ($image as $files) {
                $imageName = rand() . '.' . $files->getClientOriginalExtension();
                // create 120x120 image
                $logo = ImageResize::make($files->getRealPath());
                $logo->resize(120,120);
                $logo->save(public_path('images/'. $imageName));
                // create 800x800 image
                $largeImg = ImageResize::make($files->getRealPath());
                $largeImg->resize(800,800);
                $largeImg->save(public_path('images/'.'large'.$imageName));

                // Image data created here
                $imageData = [
                    'news_id' => $news->id,
                    'name_logo' => $imageName,
                    'name_large' => 'large'. $imageName,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ];

                Image::create($imageData);
            }
        }

        return redirect('news')->with('success', 'News post has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = News::findOrFail($id);
        $images = $data->images;
//        dd($images);
        return view('view', compact('data', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = News::findOrFail($id);
        $images = $data->images;

        return view('edit', compact('data', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'    =>  'required',
            'text'  =>  'required',
        ]);

        $formData = [
            'title' => $request->title,
            'content' => $request->text,
        ];

        News::whereId($id)->update($formData);

        // Check if there are any images uploaded
        if ($image = $request->file('images')) {
            foreach ($image as $files) {
                $imageName = rand() . '.' . $files->getClientOriginalExtension();
                // create 120x120 image
                $logo = ImageResize::make($files->getRealPath());
                $logo->resize(120,120);
                $logo->save(public_path('images/'. $imageName));
                // create 800x800 image
                $largeImg = ImageResize::make($files->getRealPath());
                $largeImg->resize(800,800);
                $largeImg->save(public_path('images/'.'large'.$imageName));

                // Image data created here
                $imageData = [
                    'news_id' => $id,
                    'name_logo' => $imageName,
                    'name_large' => 'large'. $imageName,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ];

                Image::create($imageData);
            }
        }

        return redirect('news')->with('success', 'Post data has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = News::findOrFail($id);
        $data->delete();

        return redirect('news')->with('success', 'News post is successfully deleted');
    }

    public function showAll()
    {
        $data = News::all()->makeHidden(['content', 'id', 'updated_at']);

        return $data;
    }


    public function showOne($id)
    {
        $data = News::with('images')->findOrFail($id)->makeHidden(['content', 'id','updated_at']);

        return $data;
    }
}
