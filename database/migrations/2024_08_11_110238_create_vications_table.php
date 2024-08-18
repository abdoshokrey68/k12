<?php

use App\Models\Soldier;
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
        Schema::create('vications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Soldier::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('stay')->nullable();
            $table->date('return')->nullable();
            $table->enum('type', ['leave', 'leave_extension'])->default('leave');
            $table->boolean('emergency')->default(0);
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vications');
    }
};
