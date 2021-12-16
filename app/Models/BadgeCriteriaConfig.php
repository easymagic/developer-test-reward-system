<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadgeCriteriaConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sequence_order',
        'hit_count_requirement'
    ];

    function users(){
        return $this->hasMany(UserBadge::class,'badge_criteria_config_id');
    }

}
