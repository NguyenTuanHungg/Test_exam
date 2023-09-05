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
        'time'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}