<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class Employee extends Model
{
    use HasFactory;
    protected $table='employees';
    protected $primarykey='employee_id';
    protected $fillable=['employee_id','employee_name','job-title','organization','phone_number','details'];

    public function department(){
        return $this->hasOne(Department::class);
    }
}
