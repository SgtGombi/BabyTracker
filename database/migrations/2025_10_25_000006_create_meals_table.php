<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('children_id')->constrained('children')->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->enum('meal_type', ['drink', 'food']);
            $table->string('meal_name');
            $table->decimal('meal_quantity', 8, 2)->nullable();
            $table->string('meal_unit')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meals');
    }
}
