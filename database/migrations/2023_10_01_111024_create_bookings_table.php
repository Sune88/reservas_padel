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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string("payment_id")->nullable(true);
            $table->foreignId("user_id")
                ->constrained("users");
            $table->foreignId("paddle_court_id")
                ->constrained("paddle_courts")
                ->onDelete("cascade");
            $table->foreignId("booking_state_id")
                ->constrained("booking_states")
                ->onDelete("cascade");
            $table->date("date");

            $table->time("hour_start");
            $table->time("hour_end");
            $table->decimal("total_amount",10,2);
            $table->tinyInteger("paid");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oders');
    }
};
