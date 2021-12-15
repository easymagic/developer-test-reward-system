<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgeCriteriaConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // name
        // sequence_order
        // hit_count_requirement

        Schema::create('badge_criteria_configs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('sequence_order')->nullable();
            $table->integer('hit_count_requirement')->nullable();
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
        Schema::dropIfExists('badge_criteria_configs');
    }
}
