<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('basic_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('companyID');
            $table->string('title',50);
            $table->string('email',50);
            $table->string('phone',30);
            $table->string('address',50);
            $table->string('logo',30);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('basic_infos');
    }
};
