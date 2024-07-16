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
        Schema::create('post_updates', function (Blueprint $table) {
            $table->id();
            $table->integer('postID');
            $table->integer('updateNo');
            $table->string('title');
            $table->string('description1',500);
            $table->string('description2',500);
            $table->string('description3',500);
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
        Schema::dropIfExists('post_updates');
    }
};
