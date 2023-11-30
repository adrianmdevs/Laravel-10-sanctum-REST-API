<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = ['id'];

    public function getTotal(){

        return $this->male + $this->female + $this->children ;
    }

    public function service_types(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
      return $this->belongsTo(ServiceType::class);
    }
}
