<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationForm extends Model
{
    use HasFactory;
    protected $table = 'evaluation_form';
    // protected $primaryKey = 'role_id';

    protected $fillable = [
        'evaluation_title',
        'evaluation_description',
    ];
}
