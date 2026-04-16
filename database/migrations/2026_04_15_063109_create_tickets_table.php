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

            // 🔥 nomor ticket unik
            $table->string('ticket_no')->unique();

            // 🔥 informasi ticket
            $table->string('title');
            $table->text('description');

            // 🔥 kategori (biar bisa filter)
            $table->string('category')->nullable();

            // 🔥 status sesuai soal
            $table->enum('status', [
                'open',
                'on progress',
                'resolved',
                'closed'
            ])->default('open');

            $table->timestamps();
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