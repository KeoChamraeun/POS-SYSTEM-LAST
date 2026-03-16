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
        Schema::create('staff_movements', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('first_name')->nullable(true);
            $table->string('last_name')->nullable(true);
            $table->string('gender')->nullable(true);
            $table->string('status')->nullable(true);
            $table->timestamp('joined_date')->nullable();
            $table->foreignId('company_id')->nullable(true);
            $table->foreignId('organization_id')->nullable(true);
            $table->foreignId('position_id')->nullable(true);
            $table->foreignId('user_id')->nullable(true);
            $table->float('salary', 8, 2)->default(0);
            $table->string('image')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_movements');
    }
};
