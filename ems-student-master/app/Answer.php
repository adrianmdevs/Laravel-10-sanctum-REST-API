<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    protected $fillable =
        [
            'member_id',
            'question_id',
            'member_answer',
        ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
