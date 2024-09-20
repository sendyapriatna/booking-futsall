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
        Schema::create('booking_tables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('invoice');
            $table->string('nama');
            $table->string('tanggal_booking');
            $table->integer('no_lapang');
            $table->integer('total_jam');
            $table->integer('total_harga');
            $table->string('status');
            $table->string('jadwal_array')->nullable();
            $table->enum('booked', ['0', '1'])->default('0');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('jadwal_id')->nullable();
            $table->unsignedBigInteger('lapang_id')->nullable();



            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('jadwal_id')->references('id')->on('jadwal_tables');
            $table->foreign('lapang_id')->references('id')->on('lapangan_tables');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_tables');
    }
};
