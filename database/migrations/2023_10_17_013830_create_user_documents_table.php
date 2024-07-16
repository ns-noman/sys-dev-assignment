<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_documents', function (Blueprint $table) {
            $table->id();
            $table->integer('userID');
            $table->string('image');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('user_documents');
    }
};
