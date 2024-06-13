<?php

use App\Models\Lawyer;
use App\Models\Practice;
use App\Models\User;
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
        Schema::create('practice_lawyer', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('lawyer_id')->nullable();
            $table->foreign('lawyer_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreignIdFor(Practice::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practice_lawyer');
    }
};
