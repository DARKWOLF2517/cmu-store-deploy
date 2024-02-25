<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationOption extends Model
{
    use HasFactory;
    protected $table = 'evaluation_option';
    // protected $primaryKey = 'role_id';

    protected $fillable = [
        'question_id',
        'option',
    ];

    public function evaluation_question(){
        return $this->belongsTo(EvaluationQuestion::class,'question_id','id');
    }
}
