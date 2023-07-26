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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('logo',300);
            $table->string('telephone');
            $table->string('address');
            $table->string('objective');
            $table->string('vision');
            $table->string('location_hq');
            $table->string('location_satellite');
            $table->string('mission');
            $table->string('goal');
            $table->string('current_year');
            $table->boolean('business_plan_filled');
            $table->boolean('market_plan_filled');
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
        Schema::dropIfExists('companies');
    }
};
