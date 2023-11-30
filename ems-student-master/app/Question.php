<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable =
        [
            'unit_id',
            'question',
            'option1',
            'option2',
            'option3',
            'option4',
            'correct_answer',
        ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function answer()
    {
        return $this->hasOne(Answer::class, 'question_id');
    }
}
