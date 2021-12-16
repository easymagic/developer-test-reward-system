<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{
    use HasFactory;
    // $table->integer('user_id')->nullable();
    // $table->integer('badge_criteria_config_id')->nullable();

    protected $fillable = [
      'user_id',
      'badge_criteria_config_id'
    ];


    function criteria(){
        return $this->belongsTo(BadgeCriteriaConfig::class,'badge_criteria_config_id');
    }

}
