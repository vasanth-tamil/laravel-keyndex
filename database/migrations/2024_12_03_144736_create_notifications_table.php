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
            $table->string('image', 100)->nullable();
            $table->string('title');
            $table->text('message');
            $table->enum('type', ['global', 'group', 'single', 'task', 'project'])->default('global');
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('target_id')->nullable(); // ONLY USED FOR SINGLE NOTIFICATION
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
