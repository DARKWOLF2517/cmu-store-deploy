<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;
    use Loggable;
    protected $table = 'college';
    // protected $primaryKey = 'role_id';

    protected $fillable = [
        'id',
        'college',
        'description'
    ];
}
