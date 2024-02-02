<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;
    
    protected $table = 'school_year';
    // protected $primaryKey = 'role_id';

    protected $fillable = [
        'school_year',
        
    ];

}
