<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearLevel extends Model
{
    use HasFactory;
    protected $table = 'year_level';
    // protected $primaryKey = ['student_org_id', 'student_id', 'role_id'];
    protected $fillable = [
        'org_id',
        'year_level'
    ];
}
