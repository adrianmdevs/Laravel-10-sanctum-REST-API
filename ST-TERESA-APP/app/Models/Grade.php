<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Grade extends Model
{
    use HasFactory;
    protected $table='grades';
    protected $primaryKey='grade_id';
    protected $fillable=['grade_id','grade_level','grade_name','teacher_id'];

    public function teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
    public function Pupil(){
        return $this->belongsToMany(Pupil::class);
    }
}
