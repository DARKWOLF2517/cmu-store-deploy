<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $primaryKey = 'event_id';
    protected $fillable = [
        'name',
        'start_date',
        'start_attendance',
        'end_attendance',
        'location',
        'description',
        'require_attendance',
        'attendance_count',
        'attendance_session_started',
        'fines',
        'org_id',
        'evaluation_status',
        'attendance_status',
        'event_status',
        'school_year'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id', 'org_id');
    }
    public function EvaluationFormAnswer()
    {
        return $this->hasMany(EvaluationAnswer::class, 'event_id', 'event_id');
    }
    public function Attendance()
    {
        return $this->hasMany(Attendance::class, 'event_id', 'event_id');
    }
}
