<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidAccountability extends Model
{

    use HasFactory;
    protected $table = 'paid_accountabilities';
    // protected $primaryKey = 'org_id';

    protected $fillable = [
        'student_id',
        'student_org_id',
        'amount',
        'school_year',
        'accountability_type',
        'remarks',
    ];

    public function user_profile()
    {
        return $this->belongsTo(UserProfile::class, 'student_id','user_id');
    }


}
