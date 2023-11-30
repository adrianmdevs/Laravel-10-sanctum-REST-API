<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    protected $fillable =
        [
            'user_id',
            'fname',
            'dob',
            'email',
            'phone',
            'nid',
            'ihrm_no',
            'status',
        ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'member_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'member_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'member_id');
    }

    public function certificates()
    {
        return $this->hasMany(Course_member::class, 'member_id');
    }
}
