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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('card_id');
            $table->unsignedBigInteger('merchant_id');
            $table->string('type');
            $table->boolean('is_finished')->default(false);
            $table->string('status')->default('in progress');
            $table->timestamps();

            $table->foreign('card_id')->references('id')->on('cards');
            $table->foreign('merchant_id')->references('id')->on('merchants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
