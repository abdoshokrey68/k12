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
        Schema::create('penalties', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Soldier::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('date_of_the_crime')->nullable();
            $table->string('text_of_the_crime')->nullable();
            $table->string('penalty_imposed')->nullable();
            $table->string('penalty_order')->nullable();
            $table->date('started_from')->nullable();
            $table->date('ends_in')->nullable();
            $table->string('statement')->nullable(); // حبس && حجز
            $table->string('orders_item_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalties');
    }
};
