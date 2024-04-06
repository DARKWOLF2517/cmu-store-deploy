<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementStudentOpened extends Model
{
    use HasFactory;
    protected $table = 'announcement_student_opened';
    // protected $primaryKey = 'role_id';

    protected $fillable = [
        'announcement_id',
        'student_id',
        // 'org_id',
        'school_year'
    ];
}
