<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchievementCriteriaConfig extends Model
{
    use HasFactory;

    protected $fillable = [
     'name',
     'type',
     'sequence_order',
     'hit_count_requirement'
    ];

}
