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
        Schema::create('contact', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_request_id');
            $table->unsignedBigInteger('user_confirm_id');
            $table->string('name');
            $table->string('email');
            $table->string('message')->nullable();
            $table->enum('is_accept', [0, 1, 2])->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_request_id')->references('id')->on('users')->onDelete('NO ACTION');
            $table->foreign('user_confirm_id')->references('id')->on('users')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('contact');
    }
};
