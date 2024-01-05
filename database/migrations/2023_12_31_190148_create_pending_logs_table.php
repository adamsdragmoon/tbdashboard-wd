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
        Schema::create('pending_logs', function (Blueprint $table) {
            
            $table->id();
            $table->string('req_uuid');
            $table->string('memberid');
            $table->integer('saldomember');
            $table->timestamp('tglwktrequest');
            $table->string('agent');
            $table->string('dibuat_oleh');
            $table->timestamp('tglwktdibuat');
            $table->string('diproses_oleh');
            $table->text('catatanproses');
            $table->integer('biaya_proses');
            $table->string('namarek');
            $table->string('namabank');
            $table->string('norek');
            $table->integer('jumlahwd');
            $table->string('status');
            $table->timestamp('tglwktdiproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_logs');
    }
};
