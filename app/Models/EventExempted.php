<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventExempted extends Model
{
    use HasFactory;
    protected $table = 'events_exempted';
    // protected $primaryKey = 'org_id';

    protected $fillable = [
        'org_id',
        'event_id',
        'year_level_id',
    ];
}
