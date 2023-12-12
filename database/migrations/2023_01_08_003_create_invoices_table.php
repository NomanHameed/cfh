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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers');
            $table->string('invoice_number')->nullable();
            $table->bigInteger('invoice_date');

            $table->foreignId('account_id')->nullable()->references('id')->on('accounts');
            $table->enum('payment_type',['Cash','Pending', 'Transfer'])->nullable();
            $table->enum('order_type',['Takeaway','Delivery'])->nullable();
            $table->double('payment', 10, 2)->default(0);

            $table->string('status')->default('Pending');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
