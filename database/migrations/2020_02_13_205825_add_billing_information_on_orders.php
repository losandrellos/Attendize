<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBillingInformationOnOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('business_einvoice_identifier_type')->nullable();
            $table->string('business_einvoice_identifier')->nullable();
            $table->integer('country_id');

//            $table->foreign('country_id')->references('id')->on('countries');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('business_einvoice_identifier_type');
            $table->dropColumn('business_einvoice_identifier');
            $table->dropColumn('country_id');
        });
    }
}
