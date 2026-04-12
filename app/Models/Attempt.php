<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AttemptAnswer;

class Attempt extends Model
{
    protected $fillable = [
        'user_id',
        'quiz_id',
        'total_questions',
        'correct_answers',
        'score',
    ];

    public function answers()
    {
        return $this->hasMany(AttemptAnswer::class);
    }
public function quiz()
{
    return $this->belongsTo(Quiz::class);
}

    }