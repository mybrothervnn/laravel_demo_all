<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;

class LoaiTinController extends Controller
{
    public function getdanhsach(){
    	$dsLoaiTin = LoaiTin::all();
    	return view('admin.loaitin.danhsach',['dsLoaiTin'=>$dsLoaiTin]);
    }
    public function getthem(){
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.them',['theloai'=>$theloai]);
    }
    public function postthem(Request $req){
    	$this->validate($req,
    		['Ten'=>'required|min:3|max:30|unique:LoaiTin,Ten'],
    		['required'=>'Tên không được để trống',
    		 'min'=>'Tên phải lớn hơn 3 ký tự',
    		 'max'=>'Tên phải nhỏ 30 ký tự',
		 	 'unique'=>'Tên này đã được sử dụng, vui lòng chọn tên khác !'
    		]
    	);
    	$loaitin = new LoaiTin;
    	$loaitin->Ten = $req->Ten;
    	$loaitin->TenKhongDau = changeTitle($req->Ten);
    	$loaitin->idTheLoai = $req->idTheLoai;
    	$loaitin->save();
    	return redirect('admin/loaitin/them')->with('thongbao','Đã thêm thành công');    	
    }
    public function getsua($id){
    	$loaitin = LoaiTin::find($id);
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postsua(Request $req,$id){
    	$this->validate($req,
    		['Ten'=>'required|min:3|max:30'],
    		['required'=>'Tên không được để trống',
    		 'min'=>'Tên phải lớn hơn 3 ký tự',
    		 'max'=>'Tên phải nhỏ 30 ký tự'
    		]
    	);
    	$loaitin = LoaiTin::find($id);
    	$saveTen = $loaitin->Ten;
    	$loaitin->Ten = $req->Ten;
    	$loaitin->TenKhongDau = changeTitle($req->Ten);
    	$loaitin->idTheLoai = $req->idTheLoai;
    	$loaitin->save();
    	return redirect('admin/loaitin/sua/'.$id)->with('thongbao',"Bạn đã sửa thành công $saveTen -> $loaitin->Ten .");
    }
    public function getxoa($id){
    	$loaitin = LoaiTin::find($id);
    	$saveTen = $loaitin->Ten;
    	$loaitin->delete();
    	return redirect('admin/loaitin/danhsach')->with('thongbao',"Bạn đã xóa loại tin: $saveTen thành công!");

    }
}
