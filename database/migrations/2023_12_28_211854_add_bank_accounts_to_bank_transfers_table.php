<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_transfers', function (Blueprint $table) {
            $table->foreignId('sender_id')->after('id')->index();
            $table->foreign('sender_id')->references('id')->on('bank_accounts')->onUpdate('CASCADE')->onDelete('RESTRICT');

            $table->foreignId('receiver_id')->after('id')->index();
            $table->foreign('receiver_id')->references('id')->on('bank_accounts')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::table('bank_transfers', function (Blueprint $table) {
            //
        });
    }
};
