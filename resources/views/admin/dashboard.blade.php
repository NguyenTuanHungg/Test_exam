@extends('layouts.login')

@section('content')
<h1>Danh sách đề thi</h1>
<a href="{{ route('add') }}" class="btn btn-primary">Thêm đề thi</a>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Tên chủ đề</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach ($topics as $topic)
        <tr>
            <td>{{ $topic->id }}</td>
            <td>{{ $topic->name }}</td>
            
           
            <td>
            
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection