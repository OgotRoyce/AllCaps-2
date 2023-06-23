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
        Schema::create('output', function (Blueprint $table) {
            $table->id();
            $table->string('task_code')->nullable();
            $table->string('activity_code')->nullable();
            $table->string('student_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('adviser_id')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('due_date')->nullable();
            $table->string('attachments')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('output');
    }
};
