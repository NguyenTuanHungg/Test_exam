<?php

namespace App\Http\Controllers;

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

            $correctAnswerFound = false;

            foreach ($question->answers as $answer) {
                if ($answer->true === 1) {
                    // Nếu tìm thấy đáp án đúng, kiểm tra xem người dùng đã trả lời đúng không
                    if (isset($answers[$question->id]) && $answers[$question->id] == $answer->id) {
                        $correctAnswerFound = true;
                        break; // Nếu trả lời đúng, thoát khỏi vòng lặp
                    }
                }
            }

            if ($correctAnswerFound) {
                $score += 1;
            }
        }

        return $score;
    }
}
