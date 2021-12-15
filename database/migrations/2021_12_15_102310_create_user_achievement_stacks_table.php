<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAchievementStacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
// user_id
// achievement_criteria_config_id

        Schema::create('user_achievement_stacks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('achievement_criteria_config_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_achievement_stacks');
    }
}
