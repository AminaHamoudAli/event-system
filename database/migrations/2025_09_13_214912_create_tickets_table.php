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
        Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
        $table->foreignId('attendee_id')->nullable()->constrained('users')->onDelete('set null');
        $table->string('ticket_type')->default('general');
        $table->decimal('price', 8, 2);
        $table->enum('status', ['available','sold'])->default('available');
        $table->timestamps();

        $table->index(['event_id', 'attendee_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
