<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTypeRequestResponeOnFcmLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('fcm_logs', function (Blueprint $table){
            $table->text('request')->change();
            $table->text('response')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('fcm_logs', function (Blueprint $table){
            $table->string('request')->change();
            $table->string('response')->change();
        });
    }
}
