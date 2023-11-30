<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class File extends Model
{
    use HasFactory;
    protected $table='files';
    protected $fillable=['project_id','file_name','file'];

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
