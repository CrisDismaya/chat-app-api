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
        Schema::create('group_chat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('path')->nullable();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_chat', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('group_chat');
    }
};
