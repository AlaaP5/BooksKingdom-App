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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('content');
            $table->foreignId('author_id')->constrained('authors');
            $table->foreignId('type_id')->constrained('types');
            $table->foreignId('status_id')->constrained('statuses');
            $table->date('date_publication');
            $table->string('description');
            $table->string('image');
            $table->float('evaluation')->nullable();
            $table->integer('price');
            $table->integer('pages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
