<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'topics';
    protected $fillable = [
        'name',
        'time',
        'score',
        'category_id'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function category()
    {
        return $this->belongsTo(TopicName::class, 'category_id', 'id');
    }
}
