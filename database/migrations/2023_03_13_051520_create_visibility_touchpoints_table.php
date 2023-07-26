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
        Schema::dropIfExists('visibility_touchpoints');
        Schema::create('visibility_touchpoints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_visibility_plan_id');
            $table->string('touchpoint');
            $table->boolean('details_filled')->nullable();
            $table->timestamps();
           
            // $table->foreign('Parent_Visibility_Plan_id')->references('parent_visibility_id')->on('parent__visibility__plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visibility_touchpoints');
    }
};
