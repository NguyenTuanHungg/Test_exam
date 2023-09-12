<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExam extends Model
{
    use HasFactory;
    protected $table = 'user_exams';
    protected $fillable = [
        'user_id', 'topic_id', 'score', 'created_at'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }
    public function selectedAnswers()
    {
        return $this->hasMany(SelectedAnswer::class, 'user_exam_id', 'id');
    }
}
