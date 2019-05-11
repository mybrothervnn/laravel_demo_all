<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TinTuc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TinTuc',function(Blueprint $table){
            $table->increments('id',10);
            $table->integer('idLoaiTin');
            $table->foreign('idLoaiTin')->references('id')->on('LoaiTin');
            $table->string('TieuDe',255);
            $table->string('TieuDeKhongDau');
            $table->string('TomTat');
            $table->text('NoiDung');
            $table->string('Hinh');
            $table->integer('NoiBat');
            $table->integer('SoLuotXem')->default(0);     
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
        Schema::drop('TinTuc');
    }
}
