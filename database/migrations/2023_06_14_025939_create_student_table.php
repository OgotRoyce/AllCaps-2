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
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('account_code');
            $table->string('student_id')->nullable();
            $table->string('first_name', 96);
            $table->string('last_name', 96);
            $table->string('email', 96)->unique();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('adviser_id')->nullable();
            $table->string('status')->default('pending');
            $table->string('group_name')->nullable();
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
        Schema::dropIfExists('student');
    }
};
