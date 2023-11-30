<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $guarded = [];

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
      return $this->belongsTo(User::class, 'branch_id');
    }
}
