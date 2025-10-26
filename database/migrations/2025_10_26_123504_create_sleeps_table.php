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
        Schema::create('sleeps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('children_id')->constrained('children')->onDelete('cascade');
            $table->datetime('date_from');
            $table->datetime('date_to');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sleeps');
    }
};
