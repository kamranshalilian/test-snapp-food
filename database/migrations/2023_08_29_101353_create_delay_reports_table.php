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
        Schema::create('delay_reports', function (Blueprint $table) {
            $table->ulid("id")->unique();
            $table->integer("delay_time");
            $table->foreignUlid("agent_id")->nullable()->references("id")->on("agents");
            $table->foreignUlid("order_id")->references("id")->on("orders");
            $table->foreignUlid("vendor_id")->references("id")->on("vendors");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delay_reports');
    }
};
