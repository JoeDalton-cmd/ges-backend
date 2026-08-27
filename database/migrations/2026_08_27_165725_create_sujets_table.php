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
    Schema::create('sujets', function (Blueprint $table) {
        $table->id();
        $table->foreignId('categorie_forum_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('titre');
        $table->text('contenu');
        $table->boolean('epingle')->default(false);
        $table->boolean('ferme')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sujets');
    }
};
