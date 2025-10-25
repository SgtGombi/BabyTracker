<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationsTable extends Migration
{
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('children_id')->constrained('children')->onDelete('cascade');
            $table->string('medication_name');
            $table->decimal('quantity', 8, 2);
            $table->string('unit');
            $table->date('date');
            $table->time('time');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medications');
    }
}
