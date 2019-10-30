@extends('parent')


@section('main')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div align="right">
        <a href="{{ route('news.index') }}" class="btn btn-default">Back</a>
    </div>

    <form method="post" action="{{ route('news.update', $data->id) }}" enctype="multipart/form-data">

        @csrf
        @method('PATCH')
        <div class="form-group">
            <label class="col-md-4 text-right">Title</label>
            <div class="col-md-8">
                <input type="text" name="title" class="form-control input-lg"  value="{{$data->title}}"/>
            </div>
        </div>
        <br />
        <br />
        <br />
        <div class="form-group">
            <label class="col-md-4 text-right">Upload more images</label>
            <div class="col-md-8">
                <input type="file" class="form-control" name="images[]" placeholder="address" multiple/>
            </div>
            <br />
            <div align="center">
                @foreach ($images as $image)
                    <img src="{{ URL::to('/') }}/images/{{ $image->name_logo }}" class="img-thumbnail" />
                @endforeach
            </div>
        </div>
        <br />
        <br />
        <br />
        <div class="form-group">
            <label class="col-md-4 text-right">News' post content</label>
            <div class="col-md-8">
                <textarea class="content" name="text">{{ $data->content }}</textarea>
            </div>
        </div>
        <br /><br /><br />
        <div class="form-group text-center">
            <input type="submit" name="add" class="btn btn-primary input-lg" value="Update" />
        </div>

    </form>
@endsection
