<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table='notifications';
    protected $primaryKey='notification_id';
    protected$fillable=['notification_id','pupil_id','message'];
    public function pupil(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(Pupil::class);
    }

}
