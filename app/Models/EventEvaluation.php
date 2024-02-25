<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventEvaluation extends Model
{
    use HasFactory;
    protected $table = 'event_evaluation';
    // protected $primaryKey = 'role_id';

    protected $fillable = [
        'evaluation_form_id',
        'event_id',
    ];

    

}
