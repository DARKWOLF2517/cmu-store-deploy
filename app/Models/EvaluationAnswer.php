<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationAnswer extends Model
{
    use HasFactory;
    protected $table = 'evaluation_answers';
    // protected $primaryKey = 'role_id';

    protected $fillable = [
        'student_id',
        'question_id',
        'option_id',
        'event_id',
        'word_answer'
    ];
    public function events(){
        return $this->belongsTo(Event::class,'event_id','event_id');
    }
}
