<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('club_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('location');
            $table->string('country');
            $table->string('level');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('stages')->nullable();
            $table->integer('rounds')->nullable();
            $table->integer('shooters')->nullable();
            $table->decimal('price', 6)->nullable();
            $table->string('currency')->nullable();
            $table->string('registration_link')->nullable();
            $table->string('registration_start_date')->nullable();
            $table->string('result_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions');
    }
};
