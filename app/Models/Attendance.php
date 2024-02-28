<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendance';
    protected $primaryKey = 'user_id'; 
    protected $fillable = [
        'user_id',
        'org_id',
        'event_id',
        'officer_id',
        'session',
        'remarks',
        'time',
        'created_at',
        'updated_at'
    ];

    public function user_profile()
    {
        return $this->belongsTo(UserProfile::class, 'user_id','user_id');
    }
    public function events()
    {
        return $this->hasOne(Event::class,'event_id','event_id');
    }
    // public function college()
    // {
    //     return $this->belongsTo(College::class,'college_id','id');
    // }
}
