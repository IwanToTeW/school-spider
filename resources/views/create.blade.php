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

    <form method="post" action="{{ route('news.store') }}" enctype="multipart/form-data">

        @csrf
        <div class="form-group">
            <label class="col-md-4 text-right">Title</label>
            <div class="col-md-8">
                <input type="text" name="title" class="form-control input-lg" />
            </div>
        </div>
        <br />
        <br />
        <br />
        <div class="form-group">
            <label class="col-md-4 text-right">Select Profile Image</label>
            <div class="col-md-8">
                <input type="file" class="form-control" name="images[]" placeholder="address" multiple/>
            </div>
        </div>
        <br />
        <br />
        <br />
        <div class="form-group">
            <label class="col-md-4 text-right">Write News' post content</label>
            <div class="col-md-8">
                <textarea class="content" name="text"></textarea>
            </div>
        </div>
        <br /><br /><br />
        <div class="form-group text-center">
            <input type="submit" name="add" class="btn btn-primary input-lg" value="Add" />
        </div>

    </form>
@endsection
