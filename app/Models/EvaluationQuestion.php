<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationQuestion extends Model
{
    use HasFactory;
    protected $table = 'evaluation_questions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'evaluation_form_id',
        'description',
    ];

    public function evaluation_option(){
        return $this->hasMany(EvaluationOption::class,'question_id');
    }

    public function evaluation_answers(){
        return $this->hasMany(EvaluationAnswer::class,'question_id');
    }
}
