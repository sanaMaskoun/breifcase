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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->tinyInteger('status');
            $table->string('answer')->nullable();
            $table->tinyInteger('type');
            $table->integer('price')->nullable();
            $table->boolean('accept_case')->nullable();
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
