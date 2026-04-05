<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('route_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->constrained('routes')->cascadeOnDelete();
            $table->foreignId('user_profile_id')->constrained('user_profiles')->cascadeOnDelete();
            $table->foreignId('custom_grade_id')->nullable()->constrained('grades'); // cotation perso
            $table->unsignedInteger('tries')->nullable();
            $table->unsignedTinyInteger('rating')->nullable(); // 1 à 5
            $table->timestamps();

            $table->index('user_profile_id');
            $table->index('route_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('route_records');
    }
};
