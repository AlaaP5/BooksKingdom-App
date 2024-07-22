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
        Schema::create('library_book', function (Blueprint $table) {
            $table->id();
            $table->foreignId('library_id')->constrained('libraries');
            $table->foreignId('book_id')->constrained('books');
            $table->foreignId('condition_id')->constrained('conditions');
            $table->integer('sign')->nullable();
            $table->integer('read_pages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_book');
    }
};
