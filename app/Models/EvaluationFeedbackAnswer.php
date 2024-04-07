<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationFeedbackAnswer extends Model
{
    use HasFactory;
    protected $table = 'evaluation_feedback_answer';
    // protected $primaryKey = 'role_id';

    protected $fillable = [
        'student_id',
        'evaluation_form_id',
        'event_id',
        'feedback',

    ];
}
