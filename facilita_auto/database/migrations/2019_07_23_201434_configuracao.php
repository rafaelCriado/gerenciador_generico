<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Configuracao extends Migration
{
   
    public function up(){
        if(!Schema::hasTable('configuracao')) {
            Schema::create('configuracao', function (Blueprint $table) {
                $table->increments('id');
                $table->decimal('taxa_servico',10,2);
                $table->timestamps();
            });
        }
    }

   
    public function down()
    {
        Schema::dropIfExists('configuracao');
    }
}
