@extends('parent')

@section('main')

    <div class="jumbotron text-center">
        <div align="right">
            <a href="{{ route('news.index') }}" class="btn btn-default">Back</a>
        </div>
        <br />
        @foreach ($images as $image)
            <img src="{{ URL::to('/') }}/images/{{ $image->name_logo }}" class="img-thumbnail" />
        @endforeach
        <h3>Title: {{ $data->title }} </h3>
        <h3>Content  </h3>
        <br />
        <p>{!! $data->content !!}</p>
    </div>
@endsection
