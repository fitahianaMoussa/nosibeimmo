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
        Schema::create('immobiliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcategory_id')->constrained('subcategories')->onDelete('cascade');
            $table->string('titre');
            $table->decimal('prix', 15, 2);
            $table->decimal('surface', 10, 2);
            $table->string('reference');
            $table->text('description')->nullable();
            $table->string('images_couverture')->nullable();
            $table->boolean('electricite')->nullable()->default(false);
            $table->boolean('eau')->nullable()->default(false);
            $table->string('situation_juridique')->nullable();
            $table->boolean('vue_sur_la_mer')->nullable()->default(false);
            $table->boolean('plage')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('immobiliers');
    }
};
