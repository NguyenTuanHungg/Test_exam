@extends('layouts.login')

@section('content')
<<div class="container mt-5">
    <h1 class="mb-4">Kết quả bài kiểm tra</h1>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Bài kiểm tra: {{ $userExam->topic->name }}</h3>
            <h4 class="card-subtitle mb-2 text-muted">Sinh viên: {{ auth()->user()->name }}</h4>
            <h5 class="card-text">Điểm số: {{ $userExam->score }}</h5>
        </div>
    </div>
</div>
@endsection