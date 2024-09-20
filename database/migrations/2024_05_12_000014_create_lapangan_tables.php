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
        Schema::create('lapangan_tables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('deskripsi');
            $table->integer('panjang');
            $table->integer('lebar');
            $table->integer('jarijari');
            $table->string('material');
            $table->string('image')->nullable();
            $table->integer('harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapangan_tables');
    }
};
