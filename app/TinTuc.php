<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LoaiTin;

class TinTuc extends Model
{
    protected $table='TinTuc';
    function loaitin(){
    	return $this->hasOne('App\LoaiTin','id','idLoaiTin');
    }
    // function theloai(){
    // 	return $this->hasOneThrough('App\TheLoai','App\LoaiTin','idTheLoai','idLoaiTin','id');
    // }
    function comment(){
    	return $this->hasMany('App\Comment','idTinTuc','id');
    }
}
