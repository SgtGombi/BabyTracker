<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiapersTable extends Migration
{
    public function up()
    {
        Schema::create('diapers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('children_id')->constrained('children')->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->enum('diaper_type', ['pepee', 'popoo']);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diapers');
    }
}
