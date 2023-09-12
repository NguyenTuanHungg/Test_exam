<?php

namespace App\Http\Controllers;

use App\Models\SelectedAnswer;
use App\Models\Topic;
use App\Models\UserExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserExamController extends Controller
{
    //
    public function startExam($id)
    {
        if (Auth::check()) {
            $exam = Topic::findOrFail($id);

            $exam->load('questions');
            $exam->questions = $exam->questions->shuffle();

            foreach ($exam->questions as $question) {
                $question->answers = $question->answers->shuffle();
            }

            return view('user.exam', compact('exam'));
        }
    }



    public function showResult($id)
    {
        $userExam = UserExam::find($id);

        if (!$userExam || $userExam->user_id !== auth()->id()) {
            return redirect()->route('user.home')->with('error', 'Invalid user exam.');
        }

        return view('user.result', compact('userExam'));
    }

    public function resultHistory()
    {
        $userExams = UserExam::where('user_id', Auth::id())->paginate(6);

        if (!$userExams) {
            return redirect()->route('user.home')->with('error', 'Invalid user exam.');
        }

        return view('user.history', compact('userExams'));
    }


    public function submitExam($id, Request $request)
    {
        if (Auth::check()) {
            $topic = Topic::findOrFail($id);

            $userExam = new UserExam([
                'user_id' => Auth::id(),
                'topic_id' => $topic->id,
            ]);
            $score = $this->calculateScore($userExam, $request->input('answers'));
            $userExam->score = $score;

            $userExam->save();

            foreach ($userExam->topic->questions as $question) {

                $selectedAnswers = $request->input('answers.' . $question->id);
                if (is_array($selectedAnswers)) {
                    foreach ($selectedAnswers as $selectedAnswer) {
                        SelectedAnswer::create([
                            'question_id' => $question->id,
                            'answer_id' => $selectedAnswer,
                            'user_id' => Auth::id(),
                            'user_exam_id' => $userExam->id,
                        ]);
                    }
                } elseif (is_numeric($selectedAnswers)) {
                    SelectedAnswer::create([
                        'question_id' => $question->id,
                        'answer_id' => $selectedAnswers,
                        'user_id' => Auth::id(),
                        'user_exam_id' => $userExam->id,
                    ]);
                }
            }

            return redirect()->route('result', ['id' => $userExam->id]);
        }
    }

    private function calculateScore(UserExam $userExam, $answers)
    {
        $exam = $userExam->topic;
        $questions = $exam->questions;
        $score = 0;

        foreach ($questions as $question) {
            if ($question->answers->count() === 0) {
                continue;
            }

            $correctAnswers = $question->answers->where('true', 1)->pluck('id')->toArray();
            $selectedAnswers = isset($answers[$question->id]) ? (is_array($answers[$question->id]) ? $answers[$question->id] : [$answers[$question->id]]) : null;


            if (is_array($selectedAnswers)) {

                // Chuyển đổi các giá trị trong mảng $selectedAnswers thành số nguyên
                $selectedAnswers = array_map('intval', $selectedAnswers);

                // Kiểm tra xem tất cả các đáp án đúng đã được chọn
                // Kiểm tra xem có đáp án sai nào trong danh sách các đáp án đã chọn hay không
                $incorrectAnswerFound = !empty(array_diff($selectedAnswers, $correctAnswers));

                if (!$incorrectAnswerFound) {
                    $score += 1;
                } elseif (empty($selectedAnswers)) {
                    $score += 0;
                }
            } else {
                $score += 0;
            }
        }
        // dd($correctAnswers, $selectedAnswers);
        return $score;
    }




    public function userExamAnswers($id)
    {
        // Lấy thông tin bài thi của người dùng
        $userExam = UserExam::find($id);

        if (!$userExam || $userExam->user_id !== auth()->id()) {
            return redirect()->route('user.home')->with('error', 'Invalid user exam.');
        }

        // Lấy các câu hỏi và đáp án đã chọn của người dùng
        $selectedAnswers = $userExam->selectedAnswers->pluck('answer_id')->toArray();
        return view('user.history-exam', compact('selectedAnswers', 'userExam'));
    }
}