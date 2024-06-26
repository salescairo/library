<?php

use App\Models\Book;
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
        Schema::create('book_outputs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identification');
            $table->date('return_date')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->foreignId('book_id')->references('id')->on('books');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_outputs');
    }
};
