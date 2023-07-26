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
        Schema::create('businessdetails', function (Blueprint $table) {
            $table->id('b_id');
            $table->longText('purpose')->nullable();
            $table->longText('core_val')->nullable();
            $table->longText('team_structure')->nullable();
            $table->longText('product_offer')->nullable();
            $table->longText('service_offer')->nullable();
            $table->longText('pricing_model')->nullable();
            $table->longText('target_market')->nullable();
            $table->longText('buyer_pearsona')->nullable();
            $table->longText('location_analysis')->nullable();
            $table->longText('position')->nullable();
            $table->longText('acquisition')->nullable();
            $table->longText('marketing_tools')->nullable();
            $table->longText('sales_meth')->nullable();
            $table->longText('sales_structure')->nullable();
            $table->longText('sales_channel')->nullable();
            $table->longText('sales_tech')->nullable();
            $table->longText('leagal_structure')->nullable();
            $table->longText('legal_consideration')->nullable();
            $table->longText('startup_cost')->nullable();
            $table->longText('sales_forcast')->nullable();
            $table->longText('analysis')->nullable();
            $table->longText('projected_pl')->nullable();
            $table->longText('funding_require')->nullable();
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
        Schema::dropIfExists('businessdetails');
        // $table->dropColumn('company_id');
    }
};
