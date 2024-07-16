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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->integer('clientID');
            $table->integer('projectID');
            $table->integer('flatID');
            $table->string('date');
            $table->double('amount');
            $table->string('transactionMethod')->nullable();
            $table->string('note')->nullable();
            $table->foreignId('createdByID');
            $table->string('createdByName');
            $table->integer('status');
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
        Schema::dropIfExists('collections');
    }
};
