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
        Schema::create('grabs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->timestamp('tglwktrequest');
            $table->string('memberid');
            $table->integer('saldomember');
            $table->string('namarek');
            $table->string('kategorirek');
            $table->string('namabank');
            $table->string('norek');
            $table->integer('jumlahwd');
            $table->string('agent');
            $table->string('status');
            $table->string('createdby');
            $table->timestamps();


            /*
                'uuid' => '1',
                'tglrequest' => '2021-01-01',
                'wakturequest' => '15:30:02', 
                'tglinput' => '2021-01-01',
                'waktuinput' => '15:33:12',
                'memberid' => 'kolonel',
                'saldomember' => '2000000',
                'namarek' => 'Kolonel Geraldine',
                'kategorirek' => 'bank',
                'detailrek' => 'BCA 1234567890',
                'jumlahwd' => '1000000',
                'agent' => 'bacan4d',
                'status' => 'open',
                'createdby' => 'bacanop01',
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grabs');
    }
};
