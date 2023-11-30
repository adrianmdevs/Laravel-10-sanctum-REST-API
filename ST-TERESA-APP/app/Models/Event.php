<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table='events';
    protected $primaryKey='event-id';

    protected $fillable=['event_name','event_id','event_description', 'event_date', 'event_time'];
}
