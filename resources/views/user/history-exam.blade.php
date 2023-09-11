@extends('layouts.login')

@section('content')
<div class="container">
    <h1 style="margin-top:70px;">Bài kiểm tra: {{ $exam->name }}</h1>
    <form>
        <!-- Hiển thị câu hỏi và kết quả đã chọn -->
        @foreach ($exam->questions as $question)
        <div class="card mb-4">
            <div class="card-body">
                <h3>Câu hỏi {{ $loop->iteration }}</h3>
                <p>{{ $question->name }}</p>

                @if($question->answers->where('true', 1)->count() == 1)
                <!-- Sử dụng radio nếu chỉ có 1 đáp án đúng -->
                @foreach($question->answers as $answer)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question_{{ $question->id }}" id="answer{{ $answer->id }}" value="{{ $answer->id }}" @if(in_array($answer->id, $userAnswers[$question->id])) checked @endif disabled>
                    <label class="form-check-label" for="answer{{ $answer->id }}">
                        {{ chr($loop->index + 65) }}. {{ $answer->content }}
                    </label>
                </div>
                @endforeach
                @else
                <!-- Sử dụng checkbox nếu có nhiều đáp án đúng -->
                @foreach($question->answers as $answer)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="question_{{ $question->id }}[]" id="answer{{ $answer->id }}" value="{{ $answer->id }}" @if(in_array($answer->id, $userAnswers[$question->id])) checked @endif disabled>
                    <label class="form-check-label" for="answer{{ $answer->id }}">
                        {{ chr($loop->index + 65) }}. {{ $answer->content }}
                    </label>
                </div>
                @endforeach
                @endif

            </div>
        </div>
        @endforeach
    </form>
</div>
@endsection