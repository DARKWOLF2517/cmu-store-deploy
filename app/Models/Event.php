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
        'end_date',
        'start_attendance',
        'end_attendance',
        'location',
        'description',
        'require_attendance',
        'attendance_count',
        'fines',
        'org_id',
        'status'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id', 'org_id');
    }
    public function EvaluationFormAnswer()
    {
        return $this->hasMany(EvaluationFormAnswer::class, 'event_id', 'event_id');
    }
    public function Attendance()
    {
        return $this->hasMany(Attendance::class, 'event_id', 'event_id');
    }
}
