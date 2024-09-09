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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_operator_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bus_class_id')->constrained()->cascadeOnDelete();
            $table->foreignId('from_destination_id')->constrained('destinations')->cascadeOnDelete();
            $table->foreignId('to_destination_id')->constrained('destinations')->cascadeOnDelete();
            $table->string('route');
            $table->enum('departure_day',
                ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']);
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->decimal('price', 19, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
