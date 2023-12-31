<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationOfficer extends Model
{
    use HasFactory;
    protected $table = 'organization_officer';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'student_id',
        'org_id',
        'position',
        'year_level_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id','id');
    }
}
