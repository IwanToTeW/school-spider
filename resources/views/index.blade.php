@extends('parent')

@section('main')
<div align="right">
    <a class="btn btn-success btn-sm" href="{{ route('news.create') }}"> Add </a>
</div>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{$message}}</p>
    </div>
@endif
    <table class="table table-bordered table-striped">
        <tr>
{{--            <th width="10%">Image</th>--}}
            <th width="35%">Title</th>
            <th width="35%">Content</th>
            <th width="30%">Action</th>
        </tr>
        @foreach($data as $row)
            <tr>
{{--                <td><img src="{{ URL::to('/') }}/images/{{ $row->image }}" class="img-thumbnail" width="75" /></td>--}}
                <td>{{ $row->title }}</td>
                <td>{!! $row->content !!}</td>
                <td>
                    <form action="{{ route('news.destroy', $row->id) }}" method="post">
                        <a href="{{ route('news.show', $row->id) }}" class="btn btn-primary">Show</a>
                        <a href="{{ route('news.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $data->links() !!}
@endsection
