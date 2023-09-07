@extends('layouts.login')

@section('content')
<div class="container">
    <h1>Bài kiểm tra: {{ $exam->name }}</h1>
    <div id="countdown">
        Thời gian còn lại: <span id="timer"></span>
    </div>
    <form method="POST" action="{{ route('submit', ['id' => $exam->id]) }}" id="examForm">
        @csrf
        <!-- Hiển thị câu hỏi và đáp án -->
        @foreach ($exam->questions as $question)
        <div class="card mb-4">
            <div class="card-body">
                <h3>Câu hỏi {{ $loop->iteration }}</h3>
                <p>{{ $question->name }}</p>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="answerA{{ $question->id }}" value="{{ $question->answers[0]->id }}">
                    <label class="form-check-label" for="answerA{{ $question->id }}">
                        A. {{ $question->answers[0]->content }}
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="answerB{{ $question->id }}" value="{{ $question->answers[1]->id }}">
                    <label class="form-check-label" for="answerB{{ $question->id }}">
                        B. {{ $question->answers[1]->content }}
                    </label>
                </div>


            </div>
        </div>
        @endforeach
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Nộp bài kiểm tra</button>
        </div>
    </form>
</div>
<script>
    var timeString = "{{$exam->time}}"; // Thời gian ở định dạng chuỗi HH:mm:ss

    // Chuyển đổi chuỗi thời gian thành giây
    var timeParts = timeString.split(":");
    var hours = parseInt(timeParts[0], 10);
    var minutes = parseInt(timeParts[1], 10);
    var seconds = parseInt(timeParts[2], 10);
    var totalTimeInSeconds = hours * 3600 + minutes * 60 + seconds;
    var remainingTime = totalTimeInSeconds;
    var countdownElement = document.getElementById('timer');

    function updateTimer() {
        if (remainingTime > 0) {
            remainingTime--;
            var minutes = Math.floor(remainingTime / 60);
            var seconds = remainingTime % 60;
            countdownElement.innerText = minutes + ' phút ' + seconds + ' giây';
        } else {
            clearInterval(timerInterval);
            document.getElementById('examForm').submit(); // Gửi form nộp bài
        }
    }

    var timerInterval = setInterval(updateTimer, 1000); // Cập nhật thời gian mỗi giây
</script>
@endsection