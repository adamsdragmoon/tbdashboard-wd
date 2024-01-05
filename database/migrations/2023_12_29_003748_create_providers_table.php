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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('kodeprovider')->unique();
            $table->string('namaprovider');
            $table->json('game')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};





/*

        Provider::create([
        'kodeprovider'=> 'meta',
        'namaprovider'=> 'Meta Asia',
        ]);
        

    Provider::create(
        [
        'kodeprovider' => 'idntoto',
        'namaprovider' => 'IDN Toto',
        ],
        [
        'kodeprovider' => 'idnsports',
        'namaprovider' => 'IDN Sports',
        ],
        [
        'kodeprovider'=> 'idnpoker',
        'namaprovider'=> 'IDN Poker',
        ],
        [
        'kodeprovider'=> 'nexus',
        'namaprovider'=> 'Nexus',
        ]
    );

        
*/
