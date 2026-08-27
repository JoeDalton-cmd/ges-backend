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
    Schema::create('demande_partenariats', function (Blueprint $table) {
        $table->id();
        $table->string('nom_organisation');
        $table->string('contact_nom');
        $table->string('email');
        $table->string('telephone')->nullable();
        $table->text('message');
        $table->string('statut')->default('nouvelle');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_partenariats');
    }
};
