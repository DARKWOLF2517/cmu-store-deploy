<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeFinesStudent extends Model
{
    use HasFactory;
    use Loggable;
    protected $table = 'free_fines_student';
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'student_id',
        'reason',
        'org_id',
        'school_year',
    ];


    public function user_profile()
    {
        return $this->belongsTo(UserProfile::class, 'student_id', 'user_id');
    }
}
