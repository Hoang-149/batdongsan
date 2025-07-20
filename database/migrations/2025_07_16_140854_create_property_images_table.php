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
        Schema::create('property_images', function (Blueprint $table) {
            $table->id('image_id');
            $table->integer('property_id');
            $table->string('image_url');
            $table->timestamps();

            $table->foreign('property_id')
                ->references('property_id')
                ->on('Properties')
                ->onDelete('cascade');
        });
        // // Remove image_url from Properties table
        // Schema::table('Properties', function (Blueprint $table) {
        //     $table->dropColumn('image_url');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('PropertyImages');

        // Restore image_url column in Properties table
        Schema::table('Properties', function (Blueprint $table) {
            $table->string('image_url')->nullable()->after('area');
        });
    }
};
