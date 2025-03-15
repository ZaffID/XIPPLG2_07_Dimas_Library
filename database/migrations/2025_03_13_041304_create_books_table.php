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
        Schema::create(table: 'books', callback: function (Blueprint $table): void{ 
            $table->id(); 
            $table->timestamps(); 
            $table->string(column: 'title'); 
            $table->string(column: 'writer'); 
            $table->foreignId(column: 'user_id')->constrained()->onDelete (action: 'cascade'); 
            $table->foreignId(column: 'category_id')->constrained()->onDelete(action: 'cascade'); 
            $table->string(column: 'publisher'); 
            $table->integer (column: 'year'); 
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
