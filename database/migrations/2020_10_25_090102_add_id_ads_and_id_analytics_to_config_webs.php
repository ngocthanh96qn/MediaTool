<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdAdsAndIdAnalyticsToConfigWebs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('config_webs', function (Blueprint $table) {
            $table->string('id_ads')->after('web_name');
            $table->string('id_analytics')->after('id_ads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('config_webs', function (Blueprint $table) {
            $table->dropColumn(['id_ads','id_analytics']);
        });
    }
}
