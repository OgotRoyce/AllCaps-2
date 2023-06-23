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
        Schema::create('adviser', function (Blueprint $table) {
            $table->id();
            $table->string('adviser_id');
            $table->string('first_name', 96);
            $table->string('last_name', 96);
            $table->string('email', 96)->unique();
            $table->string('program')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('adviser');
    }
};
