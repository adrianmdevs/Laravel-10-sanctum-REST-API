<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\Employee;

class Department extends Model
{
    use HasFactory;
    protected $table='departments';
    protected $primarykey='department_id';
    protected $fillable=['department_id','project_id','employee_id','department_name'];
    
    public function project(){
        return $this->hasMany(Project::class);
    
    }
    public function employee(){
        return $this->hasMany(Employee::class);
    }
}
