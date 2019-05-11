<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LoaiTin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LoaiTin', function (Blueprint $table) {
            $table->increments('id');          
            $table->string('Ten');
            $table->string('TenKhongDau')->nullable();            
            $table->timestamps();
            
            $table->integer('idTheLoai')->unsigned();               
            $table->foreign('idTheLoai')->references('id')->on('TheLoai'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('LoaiTin');
    }
}
