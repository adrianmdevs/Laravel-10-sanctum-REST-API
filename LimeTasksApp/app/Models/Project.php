<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\Department;
use App\Models\File;

class Project extends Model
{
    use HasFactory;
    protected $table='projects';
    protected $primarykey='project_id';
    protected $fillable=['project_id','project_title','description','deadline','status','priority' ];
    public function department(){
        return $this->belongsTo(Department::class); //project is specific to a certain department
    
    }
    public function task(){
        return $this->hasMany(Task::class); //Each project has many tasks
    
    }
    public function file(){
        return $this->hasMany(File::class);// Project can have multiple files related to it
    }

}
