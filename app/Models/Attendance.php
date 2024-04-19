<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    use Loggable;
    protected $table = 'attendance';
    // protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'org_id',
        'event_id',
        'officer_id',
        'session',
        'remarks',
        'time',
        'attendance_log',
        'created_at',
        'updated_at'
    ];

    public function user_profile()
    {
        return $this->belongsTo(UserProfile::class, 'user_id', 'user_id');
    }
    public function events()
    {
        return $this->hasOne(Event::class, 'event_id', 'event_id');
    }
    public function attendance_checker()
    {
        return $this->belongsTo(UserProfile::class, 'officer_id', 'user_id');
    }
}
