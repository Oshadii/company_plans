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
        Schema::create('sratergytechnologies', function (Blueprint $table) {
            $table->id('stratergytech_id');
            $table->longText('product')->nullable();
            $table->longText('price')->nullable();
            $table->longText('promotion')->nullable();
            $table->longText('people')->nullable();
            $table->longText('process')->nullable();
            $table->longText('physical_evidence')->nullable();
            $table->longText('crm')->nullable();
            $table->longText('email_sw')->nullable();
            $table->longText('automation')->nullable();
            $table->longText('blogging')->nullable();
            $table->longText('admanage_sw')->nullable();
            $table->longText('social_media_manage')->nullable();
            $table->longText('vedio_host_sw')->nullable();
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
        Schema::dropIfExists('sratergytechnologies');
    }
};
