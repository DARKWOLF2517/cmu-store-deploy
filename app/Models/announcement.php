<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcement';
    // protected $primaryKey = 'accountability_id'; 
    protected $fillable = [
        'org_id',
        'school_year',
        'title',
        'description',
        'date',
        'time'
    ];


    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id', 'org_id');
    }
}
