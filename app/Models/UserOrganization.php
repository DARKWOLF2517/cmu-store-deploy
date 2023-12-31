<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrganization extends Model
{
    use HasFactory;
    protected $table = 'user_organization';
    // protected $primaryKey = ['student_org_id', 'student_id', 'role_id'];
    // public $incrementing = false;


    protected $fillable = [
        'id',
        'student_org_id',
        'student_id',
        'role_id',
        'year_level_id'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'student_org_id', 'org_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id','id');
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'role_id', 'role_id');
    }

    
}
