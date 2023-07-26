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
        Schema::create('parent__engagements', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_id')->nullable();
            $table->string('started_date')->nullable();
            $table->string('end_date')->nullable();
            $table->boolean('is_submitted')->nullable();
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
        Schema::dropIfExists('parent__engagements');
    }
};
