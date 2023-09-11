@extends('layouts.login')

@section('content')
<div class="container">
    <h1 class="mb-4">Danh sách bài kiểm tra đã làm của {{ Auth::user()->name }}</h1>
    <table class="table table-bordered " style="border-collapse:collapse;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên bài kiểm tra</th>
                <th scope="col">Điểm số</th>
                <th>Ngày làm</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userExams as $userExam)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><a href="">{{ $userExam->topic->name }}</a></td>
                <td>{{ $userExam->score }}</td>
                <td>{{$userExam->created_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection