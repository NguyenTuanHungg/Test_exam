@extends('layouts.logAdmin')

@section('content')
<h1 style="margin-top:15px;">Danh sách đề thi</h1>
<a href="{{ route('add') }}" class="btn btn-primary">Thêm đề thi</a>


<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Tên chủ đề</th>
           <th>#</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($topics as $topic)
        <tr>
            <td>{{ $topic->id }}</td>
            <td>{{ $topic->name }}</td>
            <td>
                <div class="d-flex">

                <a href="{{ route('edit', ['id' => $topic->id]) }}" class="btn btn-primary btn-block mr-2" style="width:60px;height:40px">Sửa</a>
                <form action="{{ route('delete_topic', ['id' => $topic->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')" style="width: 60px">Xóa</button>
                </div>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody> 
</table>
@endsection