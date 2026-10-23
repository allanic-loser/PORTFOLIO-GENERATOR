<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->string('profile_picture')->nullable();
            $table->string('email');
            $table->string('contact_number', 50)->nullable();

            $table->text('address')->nullable();
            $table->text('about_me')->nullable();
            $table->text('education')->nullable();
            $table->text('skills')->nullable();
            $table->text('projects')->nullable();
            $table->text('work_experience')->nullable();
            $table->text('social_links')->nullable();

            $table->string('template', 50)->default('simple');

            // Supabase user ID, retained for existing session authentication.
            $table->string('user_id');
            $table->string('visitor_id')->nullable();

            // The model does not automatically manage timestamps.
            $table->timestamp('created_at')->useCurrent();

            $table->index(['user_id', 'created_at']);
            $table->index('visitor_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};