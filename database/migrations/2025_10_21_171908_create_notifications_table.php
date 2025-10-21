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
            $table->string('type'); // e.g., 'course_created', 'user_registered'
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Who should see this
            $table->text('title'); // Notification title
            $table->text('message'); // Notification message
            $table->string('link')->nullable(); // Link to relevant page
            $table->boolean('is_read')->default(false);
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
