<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('type', 50)->nullable();       // competitions, exhibitions, ...
            $table->string('division', 50)->nullable();       // open, national, regional...
            $table->enum('discipline', ['bloc', 'lead', 'speed'])->nullable(); // bloc, lead, speed
            $table->date('date');
            $table->string('city', 100)->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->foreignId('club_id')->nullable()->constrained('clubs');
            $table->timestamps();

            $table->index('date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
