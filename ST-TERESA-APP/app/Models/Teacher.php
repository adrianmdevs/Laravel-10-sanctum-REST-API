<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table='teachers';
    protected $primaryKey='teacher_id';
    protected $fillable=['teacher_id', 'teacher_name','subject','contact_id'];

    public function subject(){
        return $this->belongsToMany(Subject::class,'subject_id');
    }



}
