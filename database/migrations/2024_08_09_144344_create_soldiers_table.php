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
        Schema::create('soldiers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('recruitment_id')->index()->nullable();
            $table->string('recruitment')->nullable()->comment("recruitment inside military");
            $table->string('forces')->nullable();
            $table->string('military_number')->nullable();
            $table->string('three_digit_n_umber')->nullable();
            $table->date('join_date')->nullable();
            $table->string('weapon')->nullable();
            $table->string('trained_duty')->nullable();
            $table->string('service_duration')->nullable();
            $table->string('medical_level')->nullable();
            $table->string('cultural_level')->nullable();
            $table->string('qualification')->nullable();
            $table->string('profession_before_recruitment')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('religion')->nullable();
            $table->enum('marital_status', ['married', 'single', 'divorced'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('governorate_of_birth')->nullable();
            $table->string('national_number')->nullable();
            $table->string('governorate')->nullable();
            $table->date('date_of_end_of_service')->nullable();
            $table->unsignedBigInteger('point_id')->index()->nullable();
            $table->string('job')->nullable()->comment("recruitment outside military");
            $table->enum('rank', ['soldiers', 'non_commissioned_officers', 'officers'])->nullable();
            $table->string('military_rank')->nullable();
            $table->boolean('secret_governor')->default(0);
            $table->boolean('signal_governor')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solders');
    }
};
