<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('TransCode');
            $table->date('TransDate');
            $table->string('CustName');
            $table->string('Member');
            $table->float('Subtotal', 16, 0);
            $table->float('Discount', 16, 0);
            $table->float('Total', 16, 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
