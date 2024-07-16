<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('expense_heads', function (Blueprint $table) {
            $table->id();
            $table->integer('companyID');
            $table->string('name',50);
            $table->integer('code',20)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expense_heads');
    }
};
