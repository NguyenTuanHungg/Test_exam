<!DOCTYPE html>
<html>
<head>
    <title>Biểu mẫu Đề thi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <form method="POST" action="{{ route('add_topic') }}">
            @csrf
            <div class="form-group">
                <label for="name">Topic Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Topic Name">
            </div>
            <div class="form-group">
                <label for="time">Topic Time</label>
                <input type="text" class="form-control" id="time" name="time" placeholder="Topic Time">
            </div>
        
            <!-- Questions -->
            <div class="questions">
                @for ($i = 0; $i < 2; $i++)
                    <div class="question">
                        <div class="form-group">
                            <label for="question{{ $i }}">Question {{ $i + 1 }}</label>
                            <input type="text" class="form-control" id="question{{ $i }}" name="questions[{{ $i }}][name]" placeholder="Question {{ $i + 1 }}">
                        </div>
                        <div class="answers">
                            @for ($j = 0; $j < 2; $j++)
                                <div class="answer">
                                    <div class="form-group">
                                        <label for="answer{{ $i }}{{ $j }}">Answer {{ $j + 1 }}</label>
                                        <input type="text" class="form-control" id="answer{{ $i }}{{ $j }}" name="questions[{{ $i }}][answers][{{ $j }}][content]" placeholder="Answer {{ $j + 1 }}">
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="true{{ $i }}{{ $j }}" name="questions[{{ $i }}][answers][{{ $j }}][true]" value="1">
                                        <label class="form-check-label" for="true{{ $i }}{{ $j }}">Correct</label>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endfor
            </div>
        
            
            <button type="submit">Submit</button>
        </form>

</body>
</html>