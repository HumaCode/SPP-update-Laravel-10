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
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->foreignId('wali_bank_id')->nullable()->after('id');
            $table->foreignId('bank_sekolah_id')->nullable()->after('wali_bank_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropColumn('wali_bank_id');
            $table->dropColumn('bank_sekolah_id');
        });
    }
};
