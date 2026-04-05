<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_clubs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_profile_id')->constrained('user_profiles')->cascadeOnDelete();
            $table->foreignId('club_id')->constrained('clubs')->cascadeOnDelete();
            $table->date('registered_at')->default(now());
            $table->timestamp('created_at')->useCurrent();

            $table->unique(['user_profile_id', 'club_id']);
            $table->index('user_profile_id');
            $table->index('club_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_clubs');
    }
};
