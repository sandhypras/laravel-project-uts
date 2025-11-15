<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
    $table->id();
    $table->string('nim')->unique();
    $table->string('nama', 150);
    $table->string('email')->unique();
    $table->string('no_hp', 20);
    $table->string('program_studi', 100);
    $table->unsignedTinyInteger('semester');
    $table->decimal('ipk', 3, 2)->default(0);
    $table->enum('status', ['aktif', 'cuti', 'lulus', 'dropout'])->default('aktif');
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
