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
        Schema::create('group_chat_member', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('group_chat_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('group_chat_id')->references('id')->on('group_chat')->onDelete('NO ACTION');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_chat_member', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('group_chat_member');
    }
};
