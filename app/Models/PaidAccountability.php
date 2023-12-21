<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidAccountability extends Model
{

    use HasFactory;
    protected $table = 'paid_accountabilities';
    // protected $primaryKey = 'org_id';

    protected $fillable = [
        'student_id',
        'student_org_id',
        'accountability_name',
        'amount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id','id');
    }


}
