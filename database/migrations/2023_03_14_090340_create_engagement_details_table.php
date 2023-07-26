<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engagement_details', function (Blueprint $table) {
            $table->id();
            $table->string('presence')->nullable();
            $table->string('followership')->nullable();
            $table->string('recency')->nullable();
            $table->string('responsiveness')->nullable();
            $table->string('competitor_analysis')->nullable();
            $table->string('engagement_objective')->nullable();
            $table->string('need_to_be_done')->nullable();
            $table->string('key_result')->nullable();
            $table->string('target_result')->nullable();
            $table->string('budget_allocated')->nullable();
            $table->integer('engagement_touchpoint_id')->unsigned();
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
        Schema::dropIfExists('engagement_details');
    }
};
