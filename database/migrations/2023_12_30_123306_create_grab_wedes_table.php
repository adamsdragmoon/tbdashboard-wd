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
        Schema::create('grab_wedes', function (Blueprint $table) {
            $table->id();
            $table->uuid('req_uuid')->unique();
            $table->timestamp('tglwktrequest');

            $table->string('memberid');
            $table->integer('saldomember');
            $table->string('kategorirek');
            $table->string('namarek');
            $table->string('namabank');
            $table->string('norek');
            $table->integer('jumlahwd');
            $table->string('agent');
            $table->string('createdby');
            $table->string('processedby');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grab_wedes');
    }
};
