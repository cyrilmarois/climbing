<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('firstname', 100)->nullable();
            $table->string('lastname', 100)->nullable();
            $table->string('gender', 20)->nullable(); // male, female, non_binary, other
            $table->date('birth_date')->nullable();
            $table->decimal('height', 5, 2)->nullable(); // en cm
            $table->decimal('weight', 5, 2)->nullable(); // en kg
            $table->text('description')->nullable();
            $table->enum('avatar_type', ['social', 'upload', 'default'])->default('default');
            $table->string('avatar_url', 500)->nullable(); // URL du avatar (réseaux sociaux)
            $table->string('avatar_path', 255)->nullable(); // Chemin local (stockage)
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
