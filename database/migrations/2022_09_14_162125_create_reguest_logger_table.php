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
    public function up(){
        Schema::create('reguest_logger', function (Blueprint $table) {
            $table->id();
            $table->string('method');
            $table->string('url');
            $table->json('parameters')->nullable();
            $table->json('body')->nullable();
            $table->string('received_at');
            $table->string('ip');
            $table->string('status_code');
            $table->string('agent')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('reguest_logger');
    }
};
