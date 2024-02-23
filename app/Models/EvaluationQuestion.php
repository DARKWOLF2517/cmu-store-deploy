<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationQuestion extends Model
{
    use HasFactory;
    protected $table = 'evaluation_questions';
    // protected $primaryKey = 'role_id';

    protected $fillable = [
        'evaluation_form_id',
        'description',
    ];

}
