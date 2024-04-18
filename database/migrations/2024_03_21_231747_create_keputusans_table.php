<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keputusans', function (Blueprint $table) {
            $table->id();
            $table->char('kode_gejala');
            $table->char('kode_depresi');
            $table->float('mb');
            $table->float('md');
            $table->timestamps();

            $table->foreign('kode_gejala')->references('kode')->on('gejalas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_depresi')->references('kode')->on('depresis')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keputusans');
    }
};
