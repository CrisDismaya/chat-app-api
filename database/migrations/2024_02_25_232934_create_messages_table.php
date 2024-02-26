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
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sender_id');                    // user id how send the message
            $table->bigInteger('receiver_id')->nullable();              // user id how receive the message
            $table->unsignedBigInteger('group_chat_id')->nullable();
            $table->text('message');
            $table->enum('is_delete', [0, 1, 2])->default(0);           // (0 - no changes) : (1 - delete only me) : (2 - delete all)
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('group_chat_id')->references('id')->on('group_chat')->onDelete('NO ACTION');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('messages');
    }
};
