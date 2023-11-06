<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationFormDetails extends Model
{
    use HasFactory;
    protected $table = 'evaluation_form_details';
    // protected $primaryKey = 'event_id'; 
    protected $fillable = [
        'id',
        'org_id',
        'event_id',
        'evaluation_form_name',
        'description',
    ];
    public function formQuestions()
    {
        return $this->hasMany(EvaluationFormQuestions::class,'evaluation_form_id');
    }
    public function formOptions()
    {
        return $this->hasMany(EvaluationFormOptions::class, 'evaluation_form_id');
    }
    public function formAnswers()
    {
        return $this->hasMany(EvaluationFormAnswer::class, 'evaluation_form_id');
    }
    // public function Organization()
    // {
    //     return $this->hasOne(Organization::class, 'org_id');
    // }
}
