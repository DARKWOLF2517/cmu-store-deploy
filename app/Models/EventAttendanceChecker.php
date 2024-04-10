<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAttendanceChecker extends Model
{
    use HasFactory;
    protected $table = 'event_attendance_checker';
    // protected $primaryKey = 'role_id';

    protected $fillable = [
        'event_id',
        'student_id',
    ];
}
