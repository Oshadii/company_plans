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
        Schema::create('executive__summaries', function (Blueprint $table) {
            $table->id('summary_id');
            $table->string('history')->nullable();
            $table->string('over_view')->nullable();
            $table->string('financial_project')->nullable();
            $table->string('investors')->nullable();
            $table->integer('company_id');
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
        Schema::dropIfExists('executive__summaries');
    }
};
