<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventExemptedAttendance extends Model
{
    use HasFactory;

    protected $table = 'event_cancelled_attendance';
    // protected $primaryKey = 'org_id';

    protected $fillable = [
        'event_id',
        'session',
    ];
}
