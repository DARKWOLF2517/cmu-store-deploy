<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeFinesStudent extends Model
{
    use HasFactory;
    use Loggable;
    protected $table = 'waive_fees';
    // protected $primaryKey = 'student_id';

    protected $fillable = [
        'student_id',
        'reason',
        'accountability_type',
        'org_id',
        'school_year',
        'event_id',

    ];


    public function user_profile()
    {
        return $this->belongsTo(UserProfile::class, 'student_id', 'user_id');
    }
    public function waived_events()
    {
        return $this->hasMany(WaiveFeeEvent::class, 'waive_fee_id');
    }
}
