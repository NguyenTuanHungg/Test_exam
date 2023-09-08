@extends('layouts.login')

@section('content')
<div class="container">
    <h1>Xin chào, {{ auth()->user()->name }}</h1>
    <h2>Danh sách bài kiểm tra</h2>

    <ul class="list-group">
        @foreach ($exams as $exam)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-8">
                    <a href="{{ route('exam', $exam->id) }}">{{ $exam->name }}</a>
                </div>
                <div class="col-md-4 text-right">
                    <span class="badge badge-primary">{{ $exam->time }} </span>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection