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
          Schema::create('resortavailabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resort_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->boolean('is_available')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('resortavailabilities');
    }
};
