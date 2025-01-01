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
        Schema::create('keyndex_templates', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('identifier')->unique();
            $table->text('structure');
            $table->text('default_content')->nullable();
            $table->enum('content_type', ['json', 'html', 'markdown'])->default('json');
            $table->decimal('version');
            $table->boolean('status')->defalt(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keyndex_templates');
    }
};
