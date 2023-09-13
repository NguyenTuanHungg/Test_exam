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
            <div class="form-group">
                <select class="form-control" id="category_id" name="category_id">
                    <option selected>Select category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Questions -->
            <div class="questions ">
                <!-- Initial question and answer fields -->
                <div class="question ">
                    <!-- Question input -->
                    <div class="form-group">
                        <label for="question0">Question 1</label>
                        <input type="text" class="form-control" id="question0" name="questions[0][name]" placeholder="Question 1">
                    </div>
                    <div class="form-group ">
                        <label for="level0">Level</label>
                        <select class="form-control" id="level0" name="questions[0][level]">
                            <option value="easy">Easy</option>
                            <option value="medium">Medium</option>
                            <option value="hard">Hard</option>
                        </select>
                    </div>
                    <!-- Answers -->
                    <div class="answers">
                        <div class="answer">
                            <!-- Answer input -->
                            <div class="form-group">
                                <label for="answer00">Answer </label>
                                <input type="text" class="form-control" id="answer00" name="questions[0][answers][0][content]" placeholder="Answer">
                            </div>
                            <!-- Correct checkbox -->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="true00" name="questions[0][answers][0][true]" value="1">
                                <label class="form-check-label" for="true00">Correct</label>
                            </div>
                        </div>
                    </div>
                    <!-- Add Answer button -->
                    <button type="button" class="btn btn-success add-answer style=" margin-bottom:10px;">Add Answer</button>
                </div>
            </div>

            <!-- Add Question button -->
            <button type="button" class="btn btn-primary add-question">Add Question</button>

            <!-- Submit button -->
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Create Exam</button>
            </div>
        </form>
    </div>

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
                        <label for="question${questionCount}">Question ${questionCount + 1}</label>
                        <input type="text" class="form-control" id="question${questionCount}" name="questions[${questionCount}][name]" placeholder="Question ${questionCount + 1}">
                    </div>
                    <div class="form-group">
                        <label for="level${questionCount}">Level</label>
                        <select class="form-control" id="level${questionCount}" name="questions[${questionCount}][level]">
                            <option value="easy">Easy</option>
                            <option value="medium">Medium</option>
                            <option value="hard">Hard</option>
                            </select>
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
                            <button type="button" class="btn btn-success add-answer" style="margin-bottom:10px;">Add Answer</button>
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