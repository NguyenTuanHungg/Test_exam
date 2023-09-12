<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedAnswer extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'selected_answers';
    protected $fillable = [
        'user_exam_id',
        'question_id',
        'answer_id',
        'user_id'
    ];

    public function userExam()
    {
        return $this->belongsTo(UserExam::class, 'user_exam_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id', 'id');
    }
}
