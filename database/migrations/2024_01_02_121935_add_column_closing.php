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
        Schema::table('closings', function (Blueprint $table) {
            //
            $table->integer('lastreqwedeid');
            $table->integer('firstreqwedeid');
            $table->integer('endreqwedeid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('closings', function (Blueprint $table) {
            //
            $table->dropColumn('lastreqwedeid');
            $table->dropColumn('firstreqwedeid');
            $table->dropColumn('endreqwedeid');
        });
    }
};
