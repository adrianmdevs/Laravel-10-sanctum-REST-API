<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';
    protected $fillable =
        [
            'course_id',
            'name',
            'unit_code',
            'price',
            'description',
            'status',
        ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function documents()
    {
        return $this->hasMany(Book::class, 'unit_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'unit_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'unit_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'unit_id');
    }
}
