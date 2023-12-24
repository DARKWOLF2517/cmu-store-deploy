<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationOfficer extends Model
{
    use HasFactory;
    protected $table = 'organization_officer';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'org_id',
        'position',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id','id');
    }
}
