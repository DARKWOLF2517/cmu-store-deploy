<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;
    protected $table = 'college';
    // protected $primaryKey = 'role_id';

    protected $fillable = [
        'id',
        'college',
    ];

}
