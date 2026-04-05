<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('address', 255)->nullable(); // Adresse complète
            $table->string('city', 100)->nullable();
            $table->string('zipcode', 10)->nullable();
            $table->foreignId('country_id')->constrained('countries');
            $table->decimal('latitude', 10, 8)->nullable(); // Latitude (-90 à 90)
            $table->decimal('longitude', 11, 8)->nullable(); // Longitude (-180 à 180)
            $table->date('creation_date')->nullable();
            $table->timestamps();

            // Index pour les requêtes géospatiales
            $table->index(['latitude', 'longitude']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
