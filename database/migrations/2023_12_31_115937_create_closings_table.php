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
        Schema::create('closings', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tgltransaksiwd');
            $table->integer('jumlahtransaksiwd');
            $table->double('totaltransaksiwd');
            $table->double('totalpengeluarankaswd');
            $table->double('totalpenerimaankaswd');
            $table->integer('lastidtransaksiwd');
            $table->integer('firstidtransaksiwd');
            $table->integer('endidtransaksiwd');
            $table->string('closingby');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('closings');
    }
};
