<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\Answer;

class TopicController extends Controller
{
    //

    public function index()
    {
        $topics = Topic::paginate(6);
        return view('admin.dashboard', compact('topics'));
    }
    public function add()
    {
        return view('admin.add');
    }

    public function store(Request $request)
    {
        // Tạo đề thi
        $topic = Topic::create([
            'name' => $request->name,
            'time' => $request->time
        ]);

        // Tạo câu hỏi và đáp án cho đề thi
        foreach ($request->questions as $questionData) {
            $question = Question::create([
                'topic_id' => $topic->id,
                'name' => $questionData['name'],
            ]);

            foreach ($questionData['answers'] as $answerData) {
                $isCorrect = isset($answerData['true']) ? 1 : 0;

                Answer::create([
                    'question_id' => $question->id,
                    'content' => $answerData['content'],
                    'true' => $isCorrect,
                ]);
            }
        }

        return redirect()->route('admin');
    }
}