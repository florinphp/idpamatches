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
            $table->foreignId('club_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('name');
            $table->string('level');
            $table->string('ps_slug');
            $table->string('ps_club_slug');
            $table->string('ps_id');

            $table->string('country');
            $table->string('region');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->string('geo_location');

            $table->integer('shooters_count')->nullable();
            $table->integer('rounds_count')->nullable();
            $table->integer('stages_count')->nullable();

            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('timezone')->nullable();

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
