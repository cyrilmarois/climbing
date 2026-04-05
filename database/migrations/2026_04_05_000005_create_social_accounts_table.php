<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('provider', 50); // google, github, facebook, twitter, apple
            $table->string('provider_id', 255)->unique();
            $table->string('email', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->text('access_token')->nullable();
            $table->text('refresh_token')->nullable();
            $table->timestamp('token_expires_at')->nullable();
            $table->json('profile_data')->nullable(); // Données additionnelles du profil social
            $table->timestamps();

            $table->unique(['user_id', 'provider']);
            $table->index('provider');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_accounts');
    }
};
