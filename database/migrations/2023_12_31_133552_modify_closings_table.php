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
        //
        Schema::table('closings', function (Blueprint $table) {
            
            $table->integer('jumlahtransaksiwd')->nullable()->change();
            $table->double('totaltransaksiwd')->nullable()->change();
            $table->double('totalpengeluarankaswd')->nullable()->change();
            $table->double('totalpenerimaankaswd')->nullable()->change();
            $table->integer('lastidtransaksiwd')->nullable()->change();
            $table->integer('firstidtransaksiwd')->nullable()->change();
            $table->integer('endidtransaksiwd')->nullable()->change();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
