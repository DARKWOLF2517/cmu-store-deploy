<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $table = 'user_profile';
    protected $primaryKey = 'user_id';
    // public $incrementing = false;


    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'college_id',
        'year_level_id',
    ];
    public function college()
    {
        return $this->belongsTo(College::class,'college_id','id');
    }
    public function year_level()
    {
        return $this->belongsTo(YearLevel::class,'year_level_id','id');
    }
    
}
