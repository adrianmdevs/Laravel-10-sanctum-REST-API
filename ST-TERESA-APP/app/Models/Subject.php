<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table='subjects';
    protected $primaryKey='subject_id';
    protected $fillable=['subject_id'.'subject_name','description'];
    
    public function pupil(){
        return $this->hasMany(Pupil::class, 'pupil_subject','subject_id');
    }
    
}
