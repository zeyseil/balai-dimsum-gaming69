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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kostumer_id')->constrained('kostumer')->onDelete('cascade');
            $table->foreignid('menu_id')->constrained('menu')->onDelete('cascade');
            $table->date(('tanggal_pesanan'));
            $table->decimal('total_harga',10,2);
            $table->string('status_pesanan',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
