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
        Schema::create('flat_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clientID')->constrained('clients');
            $table->string('clientName');
            $table->foreignId('projectID')->constrained('projects');
            $table->string('projectName');
            $table->foreignId('flatID')->constrained('flats');
            $table->string('flatName');
            $table->double('bookingAmount');
            $table->double('totalPrice');
            $table->double('installmentTotal');
            $table->integer('numOfInstallment');
            $table->double('perInstallment');
            $table->string('date');
            $table->string('instStartingDate');
            $table->string('note')->nullable();
            $table->foreignId('createdByID')->constrained('users');
            $table->string('createdByName');
            $table->tinyInteger('resale')->default(0);
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
        Schema::dropIfExists('flat_sales');
    }
};
