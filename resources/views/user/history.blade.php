@extends('layouts.login')

@section('content')
<div class="container">
    <h1 class="mb-4">Danh sách bài kiểm tra đã làm của {{ Auth::user()->name }}</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên bài kiểm tra</th>
                <th scope="col">Điểm số</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userExams as $userExam)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $userExam->topic->name }}</td>
                <td>{{ $userExam->score }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection