<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('renters', function (Blueprint $table) {
            $table->id();
            $table->integer('companyID');
            $table->integer('projectID');
            $table->string('name',50);
            $table->string('contact',30);
            $table->string('email',50)->unique();
            $table->string('address',100)->nullable();
            $table->string('password');
            $table->double('advance',20,2);
            $table->double('prevBal',20,2)->default(0);
            $table->string('note',50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('renters');
    }
};
