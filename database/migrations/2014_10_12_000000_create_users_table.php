<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('type')->default('staff');
            $table->foreignId('role_id')->nullable(true);
            $table->foreignId('company_id')->nullable(true);
            $table->string('username');
            $table->string('profile')->nullable();
            $table->string('dialing_code')->default('+855');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verify_code')->nullable();
            $table->string('password')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('banned')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};