<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->foreignId('club_id')->constrained('clubs')->cascadeOnDelete();
            $table->foreignId('grade_id')->nullable()->constrained('grades');
            $table->foreignId('color_id')->nullable()->constrained('colors');
            $table->string('line', 50)->nullable(); // Identifiant de la ligne (A, B, 1, Red, etc.)
            $table->unsignedInteger('order')->default(1); // Ordre des routes dans la ligne
            $table->enum('discipline', ['bloc', 'lead', 'speed'])->nullable(); // bloc, lead, speed
            $table->text('description')->nullable();
            $table->date('opening_date')->nullable();
            $table->date('closing_date')->nullable();
            $table->date('is_active')->nullable();
            $table->timestamps();

            $table->index('club_id');
            $table->index('is_active');
            $table->index(['line', 'order']); // Pour trier par ligne et ordre
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
