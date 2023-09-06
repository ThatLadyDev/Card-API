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
        Schema::create('card_switches', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('new_card_id');
            $table->unsignedBigInteger('merchant_id');
            $table->unsignedBigInteger('previous_card_id');
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('new_card_id')->references('id')->on('cards');
            $table->foreign('previous_card_id')->references('id')->on('cards');
            $table->foreign('merchant_id')->references('id')->on('merchants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_switches');
    }
};
