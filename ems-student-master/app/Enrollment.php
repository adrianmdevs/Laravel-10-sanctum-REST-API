<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'enrollments';
    protected $dates = ['deleted_at'];

    protected $fillable = ['member_id', 'unit_id', 'status'];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
