@extends('layouts.login')

@section('content')
<div class="container">
    <h1 style="margin-top:70px;">Bài kiểm tra: {{ $userExam->topic->name }}</h1>
    <form>
        <!-- Hiển thị câu hỏi và kết quả đã chọn -->
        @foreach($userExam->topic->questions as $question)
        <div class="card mb-4">
            <div class="card-body">
                <h3>Câu hỏi {{ $loop->iteration }}</h3>
                <p>{{ $question->name }}</p>

                @if($question->answers->where('true', 1)->count() == 1)
                <!-- Sử dụng radio nếu chỉ có 1 đáp án đúng -->
                @foreach($question->answers as $answer)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question_{{ $question->id }}" id="answer{{ $answer->id }}" value="{{ $answer->id }}" @if(in_array($answer->id, $selectedAnswers))
                    checked
                    @endif
                    disabled>
                    <label class="form-check-label" for="answer{{ $answer->id }}">
                        {{ chr($loop->index + 65) }}. {{ $answer->content }}
                    </label>
                    @if($answer->true === 1)
                    <span class="check-mark" style="color: green;">&#10004;</span>
                    @else
                    <span class="x-mark" style="color: red;">&#10006;</span>
                    @endif
                </div>
                @endforeach
                @else
                <!-- Sử dụng checkbox nếu có nhiều đáp án đúng -->
                @foreach($question->answers as $answer)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="question_{{ $question->id }}[]" id="answer{{ $answer->id }}" value="{{ $answer->id }}" @if(in_array($answer->id, $selectedAnswers))
                    checked
                    @endif
                    disabled>
                    <label class="form-check-label" for="answer{{ $answer->id }}">
                        {{ chr($loop->index + 65) }}. {{ $answer->content }}
                    </label>
                    @if($answer->true === 1)
                    <span class="check-mark" style="color: green;">&#10004;</span>
                    @else
                    <span class="x-mark" style="color: red;">&#10006;</span>
                    @endif
                </div>
                @endforeach
                @endif

            </div>
        </div>
        @endforeach
    </form>
</div>
@endsection