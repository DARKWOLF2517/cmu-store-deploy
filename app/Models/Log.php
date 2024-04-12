<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $fillable = [
        'model',
        'action',
        'data',
        'user',
        'org_id',
        'school_year',
    ];
    public function user_profile()
    {
        return $this->belongsTo(UserProfile::class, 'user', 'user_id');
    }
}
