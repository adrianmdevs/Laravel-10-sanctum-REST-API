<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pupil extends Model
{
    use HasFactory;
    protected $table='pupils';
    protected $primaryKey='pupil_id';

    protected $fillable=['pupil_id','pupil_name','date_of_birth','grade_id','guardian_id'];

    public function grade(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }
    public function guardian(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Guardian::class);
    }
    // External methods
}
