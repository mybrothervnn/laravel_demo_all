<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    public function getdanhsach(){
    	$dsTheLoai = TheLoai::all();
    	return view('admin.theloai.danhsach',['dsTheLoai'=>$dsTheLoai]);
    }
    public function getthem(){
    	return view('admin.theloai.them');
    }
    public function postthem(Request $req){
    	$this->validate($req,
    		['Ten'=>'required|min:3|max:30|unique:TheLoai,Ten'],
    		['required'=>'Tên không được để trống',
    		 'min'=>'Tên phải lớn hơn 3 ký tự',
    		 'max'=>'Tên phải nhỏ 30 ký tự',
		 	 'unique'=>'Tên này đã được sử dụng, vui lòng chọn tên khác !'
    		]
    	);
    	$theloai = new TheLoai;
    	$theloai->Ten = $req->Ten;
    	$theloai->TenKhongDau = changeTitle($req->Ten);
    	$theloai->save();
    	return redirect('admin/theloai/them')->with('thongbao','Đã thêm thành công');    	
    }
    public function getsua($id){
    	$theloai = TheLoai::find($id);
    	return view('admin.theloai.sua',['theloai'=>$theloai]);
    }
    public function postsua(Request $req,$id){
    	$this->validate($req,
    		['Ten'=>'required|min:3|max:30|unique:TheLoai,Ten'],
    		['required'=>'Tên không được để trống',
    		 'min'=>'Tên phải lớn hơn 3 ký tự',
    		 'max'=>'Tên phải nhỏ 30 ký tự',
		 	 'unique'=>'Tên này đã được sử dụng, vui lòng chọn tên khác !'
    		]
    	);
    	$theloai = TheLoai::find($id);
    	$saveTen = $theloai->Ten;
    	$theloai->Ten = $req->Ten;
    	$theloai->TenKhongDau = changeTitle($req->Ten);
    	$theloai->save();
    	return redirect('admin/theloai/sua/'.$id)->with('thongbao',"Bạn đã sửa thành công $saveTen -> $theloai->Ten .");
    }
    public function getxoa($id){
    	$theloai = TheLoai::find($id);
    	$saveTen = $theloai->Ten;
    	$theloai->delete();
    	return redirect('admin/theloai/danhsach')->with('thongbao',"Bạn đã xóa thể loại: $saveTen thành công!");

    }
}
