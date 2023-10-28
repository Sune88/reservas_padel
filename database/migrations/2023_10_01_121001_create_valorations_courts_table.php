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
        Schema::create('valorations_courts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("paddle_court_id")
                ->constrained("paddle_courts");
            $table->foreignId("user_id")
                ->constrained("users");
            $table->text("comment");
            $table->decimal("rate",8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_courts');
    }
};
