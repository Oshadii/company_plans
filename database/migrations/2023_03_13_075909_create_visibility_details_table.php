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
        Schema::dropIfExists('visibility_details');
        Schema::create('visibility_details', function (Blueprint $table) {
            $table->id();
            $table->string('current_status')->nullable();
            $table->string('desired_status')->nullable();
            $table->string('way_to_bridge_gap')->nullable();
            $table->string('budget_allocated')->nullable();
            $table->string('metrics_to_measure')->nullable();
            $table->string('target_result')->nullable();
            $table->string('other_resources')->nullable();
            $table->integer('touchpoint_id')->unsigned();
            // $table->foreign('touchpoints_id')->references('touchpoint_id')->on('visibility_touchpoints')->onDelete('cascade');
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
        Schema::dropIfExists('visibility_details');
    }
};
