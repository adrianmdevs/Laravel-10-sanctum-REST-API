<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberAttendance extends Model
{
    //
    protected $fillable = [
      'member_id','attendance','date','branch_id','service_types_id'
    ];

    public function service_types(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
      return $this->belongsTo(ServiceType::class);
    }

    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
      return $this->belongsTo(Member::class);
    }
}
