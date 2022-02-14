<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->foreignId('plan_id')->nullable()->constrained('subscriptions')->nullOnDelete();
            $table->boolean('in_group')->default(false);
            $table->boolean('active_group')->default(false);
            $table->foreignId('group_id')->nullable()->constrained('groups')->nullOnDelete();
            $table->date('plan_start')->nullable();
            $table->date('plan_ended')->nullable();
            $table->string('plan')->nullable();
            $table->string('gender');
            $table->string('dob');
            $table->string('mobile');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
