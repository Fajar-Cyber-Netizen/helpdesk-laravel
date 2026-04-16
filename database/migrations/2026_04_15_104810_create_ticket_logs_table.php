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
        Schema::create('ticket_logs', function (Blueprint $table) {
            $table->id();

            // 🔥 relasi ke ticket
            $table->foreignId('ticket_id')
                  ->constrained()
                  ->onDelete('cascade');

            // 🔥 status lama & baru
            $table->string('old_status');
            $table->string('new_status');

            // 🔥 catatan dari IT Support
            $table->text('note');

            $table->timestamps();

            $table->string('actor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_logs');
    }
};