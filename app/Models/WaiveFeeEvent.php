<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaiveFeeEvent extends Model
{
    use HasFactory;
    protected $table = 'waive_fee_events';
    // protected $primaryKey = 'id';
    protected $fillable = [
        'event_id',
        'waive_fee_id'
    ];
}
