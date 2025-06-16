<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('id_citizen', 20)->unique()->nullable();    //CMND/CCCD
            $table->dateTime('birth_day')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('email')->nullable()->unique();
            $table->text('address')->nullable();
            $table->string('phone', 15)->unique()->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};