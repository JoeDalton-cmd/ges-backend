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
    Schema::create('formations', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->text('description');
        $table->string('duree');
        $table->unsignedInteger('prix');
        $table->date('date_debut')->nullable();
        $table->string('lieu')->nullable();
        $table->unsignedInteger('places_disponibles')->nullable();
        $table->string('formateur')->nullable();
        $table->string('statut')->default('brouillon');
        $table->string('image')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
