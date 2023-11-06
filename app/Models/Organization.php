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
    ];
    public function user_organization()
    {
        return $this->hasMany(UserOrganization::class,'student_org_id','org_id');
    }

    public function events()
    {
        return $this->hasMany(Events::class,'org_id','org_id');
    }

}
