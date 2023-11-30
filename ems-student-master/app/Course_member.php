<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_member extends Model
{
    protected $table = 'course_members';
    protected $fillable =
        [
            'course_id',
            'member_id',
            'cert_no',
        ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
