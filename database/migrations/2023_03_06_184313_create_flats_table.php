<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->integer('companyID');
            $table->integer('projectID');
            $table->integer('renterID')->nullable();
            $table->string('flatName');
            $table->double('rent',20,2);
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('flats');
    }
};
