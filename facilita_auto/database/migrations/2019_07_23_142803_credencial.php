<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Credencial extends Migration
{
    public function up(){
        if(!Schema::hasTable('credencial')) {
            Schema::create('credencial', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome');
                $table->text('ClientID')->nullable();
                $table->text('ClientSecret')->nullable();
                $table->text('UrlAutenticacao')->nullable();
                $table->text('Endpoint')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(){
        Schema::dropIfExists('credencial');
    }
}
