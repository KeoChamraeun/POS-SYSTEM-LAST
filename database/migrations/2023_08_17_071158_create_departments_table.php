<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('slug');
            $table->json('languages');
            $table->longText('icon')->nullable(true);
            $table->integer('sort');
            $table->string('type')->nullable(true);
            $table->longText('description')->nullable(true);
            $table->boolean('status')->default(0);
            $table->foreignId('parent_id')->nullable(true);
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
        Schema::dropIfExists('departments');
    }
};
