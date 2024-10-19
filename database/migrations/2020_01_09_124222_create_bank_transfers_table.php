<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'bank_transfers', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->float('debit_amount',15,4)->default(0);
            $table->float('credit_amount',15,4)->default(0);
            $table->float('rate',15,4)->default(1);
            $table->date('date');
            $table->integer('payment_method')->default('0');
            $table->string('reference')->nullable();
            $table->text('description');
            $table->boolean('status')->default(1);
            $table->integer('created_by')->default(0);
            $table->timestamps();
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_transfers');
    }
}
