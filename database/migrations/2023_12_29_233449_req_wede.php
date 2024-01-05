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
        Schema::create('req_wedes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('slug');
            $table->timestamp('tglwktrequest');
            $table->string('memberid');
            $table->integer('saldomember');
            $table->string('namarek');
            $table->string('kategorirek');
            $table->string('namabank');
            $table->string('norek');
            $table->integer('jumlahwd');
            $table->string('agent');
            $table->string('status')->default('open');
            $table->string('createdby');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('req_wedes');
    }
};


/* 

ReqWede::create([
    'tglwktrequest'=> '2023-11-20 16:35:25',
    'memberid'=> 'galirejeki',
    'saldomember'=> '2000000',
    'namarek'=> 'Tugimin',
    'kategorirek'=> 'bank',
    'namabank'=> 'Mandiri',
    'norek'=> '2130021394334432',
    'jumlahwd'=> '50000',
    'agent'=> 'terminal4d',
    'createdby'=> 'joker'
]);

*/
