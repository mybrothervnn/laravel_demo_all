<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
	protected $table='TheLoai';

    public function loaitin(){
    	return $this->hasMany('App\LoaiTin','idTheLoai','id');
    }    
    public function tintuc(){
    	// Từ 1 thể loại -> muốn lấy tất cả các tin tức thuộc thể loại đó -> lấy qua bảng trung gian
    	return $this->hasManyThrough('App\TinTuc','App\LoaiTin','idTheLoai','idLoaiTin','id');
    }
}
