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
        Schema::create('worker_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->references('id')->on('workers');
            $table->string('reference');
            $table->string('detail');
            $table->bigInteger('date');
            $table->enum('type',['Paid','Received']);
            $table->decimal('amount',10,2);
            $table->decimal('balance',10,2);
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
        Schema::dropIfExists('worker_details');
    }
};
