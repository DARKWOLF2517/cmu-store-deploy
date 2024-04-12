<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accountability extends Model
{
    use HasFactory;
    use Loggable;
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
