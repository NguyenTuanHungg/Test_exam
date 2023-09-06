@extends('layouts.login')

@section('content')
<div class="container">
    <h1>Bài kiểm tra: {{ $exam->name }}</h1>
    <form method="POST" action="{{ route('submit') }}">
        @csrf
        <!-- Hiển thị câu hỏi và đáp án -->
        @foreach ($exam->questions as $question)
        <div class="card mb-4">
            <div class="card-body">
                <h3>Câu hỏi {{ $loop->iteration }}</h3>
                <p>{{ $question->name }}</p>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="A" id="answerA{{ $question->id }}">
                    <label class="form-check-label" for="answerA{{ $question->id }}">
                        A. {{ $question->answers[0]->content }}
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="B" id="answerB{{ $question->id }}">
                    <label class="form-check-label" for="answerB{{ $question->id }}">
                        B. {{ $question->answers[1]->content }}
                    </label>
                </div>


            </div>
        </div>
        @endforeach
        <!-- Nút nộp bài kiểm tra -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Nộp bài kiểm tra</button>
        </div>
    </form>
</div>
@endsection