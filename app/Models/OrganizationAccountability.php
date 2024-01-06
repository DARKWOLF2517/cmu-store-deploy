<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationAccountability extends Model
{
    use HasFactory;
    protected $table = 'organization_accountabilities';
    protected $primaryKey = 'accountability_id';

    protected $fillable = [
        'org_id',
        'accountability_name',
        'amount',
        'school_year'
    ];
}
