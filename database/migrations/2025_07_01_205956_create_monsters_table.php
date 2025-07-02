<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('monsters', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->integer('health');
        $table->integer('max_health');
        $table->integer('attack');
        $table->integer('defense');
        $table->integer('gold_reward');
        $table->string('image');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monsters');
    }
};
