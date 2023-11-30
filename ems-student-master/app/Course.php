<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable =
        [
            'name',
            'course_code',
            'price',
            'description',
            'c_no',
            'status',
        ];


    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
