<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('companyid');
            $table->integer('roleid');
            $table->string('name',50)->nullable();
            $table->string('address',100)->nullable();
            $table->string('email')->unique();
            $table->string('contact_no',30)->nullable();
            $table->string('reference_by',50)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('assignedProjects',30)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
