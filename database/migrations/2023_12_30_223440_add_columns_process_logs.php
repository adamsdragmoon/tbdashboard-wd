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
        Schema::table('process_logs', function (Blueprint $table) {
        $table->string('req_uuid');
        $table->string('memberid');
        $table->integer('saldomember');
        $table->timestamp('tglwktrequest');
        $table->string('agent');
        $table->string('dibuat_oleh');
        $table->timestamp('tglwktdibuat');
        $table->string('diproses_oleh');
        $table->timestamp('tglwktupdate');
        $table->text('catatanproses');
        $table->integer('biaya_proses');
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
