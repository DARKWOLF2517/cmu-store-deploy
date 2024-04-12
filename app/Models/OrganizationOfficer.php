<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationOfficer extends Model
{
    use HasFactory;
    use Loggable;
    protected $table = 'organization_officer';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'student_id',
        'org_id',
        'position',
        'year_level_id',
        'school_year',
    ];

    public function user_profile()
    {
        return $this->belongsTo(UserProfile::class, 'student_id', 'user_id');
    }
}
