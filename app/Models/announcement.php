<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    use Loggable;
    protected $table = 'announcement';
    // protected $primaryKey = 'accountability_id'; 
    protected $fillable = [
        'org_id',
        'school_year',
        'title',
        'description',
        'date',
        'time',
        'important',
        'event_id'
    ];


    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id', 'org_id');
    }
}
