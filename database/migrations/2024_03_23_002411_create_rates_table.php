<?php

use App\Models\Client;
use App\Models\Consultation;
use App\Models\Document;
use App\Models\Lawyer;
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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('communication')->nullable();
            $table->tinyInteger('response_time')->nullable();
            $table->tinyInteger('problem_solving')->nullable();
            $table->tinyInteger('understanding')->nullable();
            $table->string('comment');


            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('lawyer_id')->nullable();
            $table->foreign('lawyer_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreignIdFor(Document::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
