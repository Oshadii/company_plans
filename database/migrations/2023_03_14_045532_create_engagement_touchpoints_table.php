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
        Schema::dropIfExists('engagement_touchpoints');
        Schema::create('engagement_touchpoints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_engagement_id');
            $table->string('engagement_touchpoint');
            $table->boolean('details_filled')->nullable();
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
        Schema::dropIfExists('engagement_touchpoints');
    }
};
