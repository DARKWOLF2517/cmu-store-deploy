<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeFinesStudent extends Model
{
    use HasFactory;
    protected $table = 'free_fines_student';
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'student_id',
        'reason',
        'org_id',
        'school_year',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id','id');
    }

}
