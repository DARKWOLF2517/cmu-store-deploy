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
        'year_level_id',
        'school_year',
        // 'college_id'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'student_org_id', 'org_id');
    }
    public function user_profile()
    {
        return $this->belongsTo(UserProfile::class, 'student_id','user_id');
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'role_id', 'role_id');
    }
    public function yearLevel()
    {
        return $this->belongsTo(YearLevel::class, 'year_level_id');
    }
    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'student_org_id', 'org_id');
    }

    
}
