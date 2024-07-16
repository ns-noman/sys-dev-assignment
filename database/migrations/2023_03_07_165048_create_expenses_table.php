<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('projectID');
            $table->string('projectName');
            $table->string('expenseHeadID');
            $table->string('expenseHeadName');
            $table->double('amount');
            $table->string('note')->nullable();
            $table->string('date');
            $table->integer('createdByID');
            $table->string('createdByName');
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
        Schema::dropIfExists('expenses');
    }
};
