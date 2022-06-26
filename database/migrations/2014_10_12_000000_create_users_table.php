<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('identification')->unique()->nullable();
            $table->string('last_name')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('profile_photo')->nullable();
            $table->integer('status')->nullable();
            $table->integer('sidebar')->nullable();
            $table->integer('theme')->nullable();
            $table->rememberToken(); //verificar usuario?
            $table->timestamps(); // para fechas de created y updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
