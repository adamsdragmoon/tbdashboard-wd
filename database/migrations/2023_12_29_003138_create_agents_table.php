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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('kodeagent')->unique();
            $table->string('namaagent');
            $table->string('kodeprovider');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};



/*

Agent::create([
    'kodeagent' => 'pocari4d',
    'namaagent' => 'Credit : Pocari 4D',
    'provider_id' => 1,
    'kodeprovider' => 'idntoto' 
]);

*/