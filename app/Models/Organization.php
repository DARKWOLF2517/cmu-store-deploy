<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $table = 'organizations';
    protected $primaryKey = 'org_id';

    protected $fillable = [
        'name',
        'description',
        'college_id',
    ];
    public function user_organization()
    {
        return $this->hasMany(UserOrganization::class,'student_org_id','org_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class,'org_id','org_id');
    }
    public function college()
    {
        return $this->belongsTo(College::class,'college_id','id');
    }

}
