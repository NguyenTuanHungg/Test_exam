@extends('layouts.logAdmin')

@section('content')
<div class="container">
    <h1 class="my-4">Danh sách đề thi</h1>

    <div class="col-md-6 text-right">
        <a href="{{ route('add_Cate') }}" class="btn btn-success mb-4">Thêm chủ đề</a>
        <a href="{{ route('add') }}" class="btn btn-primary mb-4">Thêm đề thi</a>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên chủ đề</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topics as $topic)
            <tr>
                <th scope="row">{{ $loop-> iteration}}</th>
                <td>{{ $topic->name }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('edit', ['id' => $topic->id]) }}" class="btn btn-primary" style="margin-right:10px;height:40px">Sửa</a>
                        <form action="{{ route('delete_topic', ['id' => $topic->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $topics->links('pagination::bootstrap-4') }}

</div>
@endsection