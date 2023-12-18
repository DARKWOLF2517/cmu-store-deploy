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
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function events()
    {
        return $this->hasOne(Event::class,'event_id','event_id');
    }
}
