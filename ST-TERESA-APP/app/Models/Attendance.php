<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table='attendances';
    protected $fillable=['attendance_status','date_entered','time_entered','created_at','updated_at'];




}
