<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationFormAnswer extends Model
{
    use HasFactory;
    protected $table = 'evaluation_form_answer';
    // protected $primaryKey = 'event_id'; 
    protected $fillable = [
        'event_id',
        'user_id',
        'org_id',
        'q1',
        'q2',
        'q3',
        'q4',
        'q5',
        'q6',
        'q7',
        'q8',
        'q9',
        'q10',
        'q11',
        'q12',
        'q13',
        'q14',
        'q15',
        'q16',
    ];

}
