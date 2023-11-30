<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'email'];

    public function classes()
    {
        return $this->hasMany(Classs::class);
    }
    public function isTeacher(){
        return $this->role === 'teacher';
    }
}
