<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->ulid("id")->unique();
            $table->string("code");
            $table->unsignedInteger("time_delivery");
            $table->unsignedInteger("time_daley")->default(0);
            $table->foreignUlid("vendor_id")->references("id")->on("vendors");
            $table->foreignUlid("trip_id")->nullable()->references("id")->on("trips");
            $table->foreignUlid("agent_id")->nullable()->references("id")->on("agents");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
