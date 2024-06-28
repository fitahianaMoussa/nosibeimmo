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
        Schema::table('immobiliers', function (Blueprint $table) {
            if (!Schema::hasColumn('immobiliers', 'categorie_id')) {
                $table->foreignId('categorie_id')->nullable()->after('subcategory_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('immobiliers', function (Blueprint $table) {
            $table->dropColumn('categorie_id');
        });
    }
};
