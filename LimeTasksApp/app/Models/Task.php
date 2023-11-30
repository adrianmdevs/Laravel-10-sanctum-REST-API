<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\Employee;
use App\Models\Subtask;

class Task extends Model
{
    use HasFactory;
    protected $table='tasks';
    protected $fillable=['task_title','deadline','description','project_id','employee_id','status','reminder'];

    //defining relationships
    public function project(){
        return $this->belongsTo(Project::class);

    }
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function subtasks(){
        return $this->hasMany(Subtask::class)->orderBy('priority'); // Each task can be divided to many subtasks sorted in order of priority in this case
    }
}
