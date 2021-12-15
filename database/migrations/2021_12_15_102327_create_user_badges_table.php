<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//         user_id
// badge_criteria_config_id

        Schema::create('user_badges', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('badge_criteria_config_id')->nullable();
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
        Schema::dropIfExists('user_badges');
    }
}
