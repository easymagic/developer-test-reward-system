<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAchievementStack extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'achievement_criteria_config_id'
    ];

}
