<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->enum('system', ['french', 'yosemite', 'uiaa'])->default('french');
            $table->unsignedInteger('sort_order')->default(0); // pour trier les cotations
            $table->timestamps();

            $table->unique(['name', 'system']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
