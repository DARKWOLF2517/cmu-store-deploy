<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationDefaultSchoolYear extends Model
{
    use HasFactory;
    protected $table = 'organization_default_school_year';
    // protected $primaryKey = 'id';

    protected $fillable = [
        'org_id',
        'school_year',
    ];
}
