<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('route_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->constrained('routes')->cascadeOnDelete();
            $table->foreignId('user_profile_id')->constrained('user_profiles')->cascadeOnDelete();
            $table->text('text');
            $table->foreignId('parent_id')->nullable()->constrained('route_comments')->cascadeOnDelete(); // Pour les réponses
            $table->timestamps();

            $table->index('route_id');
            $table->index('user_profile_id');
            $table->index('parent_id');
            $table->index(['route_id', 'created_at']); // Pour tri rapide des commentaires
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('route_comments');
    }
};
