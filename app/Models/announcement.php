<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class announcement extends Model
{
    use HasFactory;
    protected $table = 'announcement';
    // protected $primaryKey = 'accountability_id'; 
    protected $fillable = [
        'title',
        'description',
        'time',
    ];
}
