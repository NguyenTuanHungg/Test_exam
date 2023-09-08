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

                @if($question->answers->where('true', 1)->count() == 1)
                <!-- Sử dụng radio nếu chỉ có 1 đáp án đúng -->
                @foreach($question->answers as $answer)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="answer{{ $answer->id }}" value="{{ $answer->id }}">
                    <label class="form-check-label" for="answer{{ $answer->id }}">
                        {{ chr($loop->index + 65) }}. {{ $answer->content }}
                    </label>
                </div>
                @endforeach
                @else
                <!-- Sử dụng checkbox nếu có nhiều đáp án đúng -->
                @foreach($question->answers as $answer)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="answers[{{ $question->id }}][]" id="answer{{ $answer->id }}" value="{{ $answer->id }}">
                    <label class="form-check-label" for="answer{{ $answer->id }}">
                        {{ chr($loop->index + 65) }}. {{ $answer->content }}
                    </label>
                </div>
                @endforeach
                @endif

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