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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sender_id");
            $table->foreign("sender_id")->references("id")->on("users")->onDelete('cascade');
            $table->unsignedBigInteger("receiver_id");
            $table->foreign("receiver_id")->references("id")->on("users")->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('text');
            $table->string('status')->default('unread');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solutions');
    }
};
