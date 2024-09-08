<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id')->index();
            $table->unsignedBigInteger('partnership_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->text('description')->nullable();
            $table->dateTime('date');
            $table->string('address');
            $table->float('amount');
            $table->enum('status', ['created', 'assigned', 'completed'])->default('created');
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('order_types');
            $table->foreign('partnership_id')->references('id')->on('partnerships');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
