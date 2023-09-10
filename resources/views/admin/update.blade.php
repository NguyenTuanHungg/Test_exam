<!DOCTYPE html>
<html>

<head>
    <title>Biểu mẫu Đề thi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <form method="POST" action="{{route('update',['id'=>$topic->id])}}">
            @csrf
            @method('PUT') 
            <div class="form-group">
                <label for="name">Topic Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Topic Name" value="{{ $topic->name }}">
            </div>
            <div class="form-group">
                <label for="time">Topic Time</label>
                <input type="text" class="form-control" id="time" name="time" placeholder="Topic Time" value="{{ $topic->time }}">
            </div>

            <!-- Questions -->
            <div class="questions">
                @foreach($topic->questions as $question)
                <!-- Existing question and answer fields -->
                <div class="question">
                    <div class="form-group">
                        <label for="question{{ $loop->index }}">Question {{ $loop->index + 1 }}</label>
                        <input type="text" class="form-control" id="question{{ $loop->index }}" name="questions[{{ $loop->index }}][name]" value="{{ $question->name }}">
                    </div>
                    <div class="answers">
                        @foreach($question->answers as $answer)
                        <div class="answer">
                            <div class="form-group">
                                <label for="answer{{ $loop->parent->index }}{{ $loop->index }}">Answer</label>
                                <input type="text" class="form-control" id="answer{{ $loop->parent->index }}{{ $loop->index }}" name="questions[{{ $loop->parent->index }}][answers][{{ $loop->index }}][content]" value="{{ $answer->content }}">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="true{{ $loop->parent->index }}{{ $loop->index }}" name="questions[{{ $loop->parent->index }}][answers][{{ $loop->index }}][true]" value="1" {{ $answer->true == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="true{{ $loop->parent->index }}{{ $loop->index }}">Correct</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Add Answer button for each existing question -->
                    <button type="button" class="btn btn-success add-answer" data-question-index="{{ $loop->index }}">Add Answer</button>
                </div>
                @endforeach
            </div>

            <!-- Add Question button -->
            <button type="button" class="btn btn-primary add-question">Add Question</button>

            <!-- Submit button -->
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Update Exam</button>
            </div>
        </form>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let questionCount = 1; // Initial question count
        let answerCount = 1; // Initial answer count

        // Function to add a new answer input group
        function addAnswerInput(questionIndex) {
            const answersContainer = document.querySelector(`.question:nth-child(${questionIndex + 1}) .answers`);
            const newAnswerGroup = document.createElement('div');
            newAnswerGroup.className = 'answer';
            newAnswerGroup.innerHTML = `
            <div class="form-group">
                <label for="answer${questionIndex}${answerCount}">Answer </label>
                <input type="text" class="form-control" id="answer${questionIndex}${answerCount}" name="questions[${questionIndex}][answers][${answerCount}][content]" placeholder="Answer">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="true${questionIndex}${answerCount}" name="questions[${questionIndex}][answers][${answerCount}][true]" value="1">
                <label class="form-check-label" for="true${questionIndex}${answerCount}">Correct</label>
            </div>
        `;
            answersContainer.appendChild(newAnswerGroup);
            answerCount++;
        }

        function addQuestionInput() {
            const questionsContainer = document.querySelector('.questions');
            const newQuestionGroup = document.createElement('div');
            newQuestionGroup.className = 'question';
            newQuestionGroup.innerHTML = `
            <div class="form-group">
               
                <input type="text" class="form-control" id="question${questionCount}" name="questions[${questionCount}][name]" placeholder="Question ${questionCount + 1}">
            </div>
            <div class="answers">
                <!-- Initial answer field for the new question -->
                <div class="answer">
                    <div class="form-group">
                        <label for="answer${questionCount}0">Answer 1</label>
                        <input type="text" class="form-control" id="answer${questionCount}0" name="questions[${questionCount}][answers][0][content]" placeholder="Answer 1">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="true${questionCount}0" name="questions[${questionCount}][answers][0][true]" value="1">
                        <label class="form-check-label" for="true${questionCount}0">Correct</label>
                    </div>
                </div>
            </div>
            <!-- Add Answer button for the new question -->
            <button type="button" class="btn btn-success add-answer">Add Answer</button>
        `;
            questionsContainer.appendChild(newQuestionGroup);
            questionCount++;
            answerCount = 1; // Reset answer count for the new question
        }

        // Event listener for adding answers
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('add-answer')) {
                const questionIndex = Array.from(document.querySelectorAll('.add-answer')).indexOf(event.target);
                addAnswerInput(questionIndex);
            }
        });

        // Event listener for adding questions
        document.querySelector('.add-question').addEventListener('click', addQuestionInput);
    });
</script>

</html>