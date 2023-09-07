@extends('layouts.login')

@section('content')
<div class="container">
    <h1>Kết quả bài kiểm tra</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h3>Bài kiểm tra: {{ $userExam->topic->name }}</h3>
            <p>Điểm số: {{ $userExam->score }}</p>
        </div>
    </div>
</div>
@endsection