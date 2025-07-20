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
        Schema::table('Properties', function (Blueprint $table) {
            $table->timestamp('vip_expires_at')->nullable()->after('is_verified')->comment('Expiration date for VIP status');
        });
    }

    public function down()
    {
        Schema::table('Properties', function (Blueprint $table) {
            $table->dropColumn('vip_expires_at');
        });
    }
};
