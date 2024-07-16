<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('rent_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('companyID');
            $table->integer('projectID');
            $table->integer('flatID');
            $table->integer('renterID');
            $table->integer('rent');
            $table->string('from');
            $table->string('to');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rent_histories');
    }
};
