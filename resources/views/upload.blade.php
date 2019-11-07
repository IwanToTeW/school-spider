@extends('parent')
@section('main')

    <form method="POST" action="/videos" enctype="multipart/form-data">
        {{ csrf_field() }}

        <input type="file" name="video"> </input>
        <button type="submit"> Save Video</button>
    </form>
@endsection
