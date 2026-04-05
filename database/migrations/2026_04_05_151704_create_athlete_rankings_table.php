<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('athlete_rankings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('athlete_id')->constrained('athletes')->cascadeOnDelete();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->unsignedInteger('rank')->nullable();
            $table->decimal('score', 10, 2)->nullable();
            $table->timestamps();

            $table->unique(['athlete_id', 'event_id']);
            $table->index('athlete_id');
            $table->index('event_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('athlete_rankings');
    }
};
