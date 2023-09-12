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

    public function update($id)
    {
        $topic = Topic::findOrFail($id);

        return view('admin.update', compact('topic'));
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

        return redirect()->route('admin')->with('success', 'Thêm thành công');
    }

    public function updateTopic(Request $request, $id)
    {
        // Tìm đề thi cần sửa
        $topic = Topic::find($id);

        if (!$topic) {
            return redirect()->route('admin')->with('error', 'Không tìm thấy đề thi.');
        }

        // Cập nhật thông tin của đề thi
        $topic->name = $request->name;
        $topic->time = $request->time;
        $topic->save();

        // Xóa các câu hỏi và đáp án cũ của đề thi
        $topic->questions()->delete();

        // Tạo câu hỏi và đáp án mới cho đề thi
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

        return redirect()->route('admin')->with('success', 'Đã cập nhật đề thi thành công.');
    }
    public function deleteTopic($id)
    {
        $topic = Topic::findOrFail($id);
        if (!$topic) {
            return redirect()->route('admin')->with('error', 'topic not found');
        }
        $topic->delete();
        return redirect()->route('admin')->with('success', 'topic deleted successfully');
    }
}