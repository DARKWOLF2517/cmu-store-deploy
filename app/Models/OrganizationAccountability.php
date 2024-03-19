<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NumberFormatter;

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
    public function paid_accountabilities()
    {
        return $this->hasMany(PaidAccountability::class, 'student_org_id', 'org_id');
    }

}
