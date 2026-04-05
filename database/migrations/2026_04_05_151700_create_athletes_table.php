<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ifsc_id')->unique();
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->date('birthday')->nullable();
            $table->unsignedSmallInteger('height')->nullable();
            $table->unsignedInteger('federation_id')->nullable();
            $table->string('photo_url', 500)->nullable();
            $table->timestamps();

            $table->index('lastname');
            $table->index('country_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('athletes');
    }
};
