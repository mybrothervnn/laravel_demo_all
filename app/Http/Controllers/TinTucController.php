<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;

class TinTucController extends Controller
{
    public function getdanhsach(){
    	// $dsTinTuc = TinTuc::take(50)->get();
        $dsTinTuc = TinTuc::all();
    	return view('admin.tintuc.danhsach',['dsTinTuc'=>$dsTinTuc]);
    }
    public function getthem(){
    	$theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
    	return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postthem(Request $req){
    	$this->validate($req,
    		['TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
             'idLoaiTin'=>'required',
             'TomTat'=>'required',
             'NoiDung'=>'required'
            ],
    		['TieuDe.required'=>'Tiêu đề không được để trống',
    		 'TieuDe.min'=>'Tiêu đề phải lớn hơn 3 ký tự',
    		 'TieuDe.unique'=>'Tiêu đề này đã được sử dụng rồi',
		 	 'TomTat.required'=>'Tóm tắt không được để trống',
             'NoiDung.required'=>'Nội dung không được để trống',
             'idLoaiTin.required'=>'Loại tin không được để trống'
    		]
    	);
    	$tintuc = new TinTuc;
    	$tintuc->TieuDe = $req->TieuDe;
    	$tintuc->TieuDeKhongDau = changeTitle($req->TieuDe);
    	$tintuc->idLoaiTin = $req->idLoaiTin;
        $tintuc->TomTat = $req->TomTat;
        $tintuc->NoiDung = $req->NoiDung;
        $tintuc->NoiBat = $req->NoiBat;
        $tintuc->SoLuotXem = 0;
        if ($req->hasFile('Hinh')) {
            $file = $req->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if($duoi !='png' && $duoi != 'jpg' && $duoi != 'jpeg' ){
                return redirect('admin/tintuc/them')->with('loi','Bạn chỉ được chọn file có đuôi là png, jpg, jpeg');  
            }

            $name = $file->getClientOriginalName();
            $hinh = str_random(4).'_'.$name;
            while (file_exists('upload/tintuc/'.$hinh)) {
                $hinh = str_random(4).'_'.$name;
            }
            $file->move('upload/tintuc/',$hinh);
            $tintuc->Hinh = $hinh;
        }else{
            $tintuc->Hinh = '';
        }

    	$tintuc->save();
    	return redirect('admin/tintuc/them')->with('thongbao','Đã thêm thành công');    	
    }
    public function getsua($id){
    	$tintuc = TinTuc::find($id);    	
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
    	return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postsua(Request $req,$id){
    	$this->validate($req,
            ['TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
             'idLoaiTin'=>'required',
             'TomTat'=>'required',
             'NoiDung'=>'required'
            ],
            ['TieuDe.required'=>'Tiêu đề không được để trống',
             'TieuDe.min'=>'Tiêu đề phải lớn hơn 3 ký tự',
             'TieuDe.unique'=>'Tiêu đề này đã được sử dụng rồi',
             'TomTat.required'=>'Tóm tắt không được để trống',
             'NoiDung.required'=>'Nội dung không được để trống',
             'idLoaiTin.required'=>'Loại tin không được để trống'
            ]
        );
        $tintuc = TinTuc::find($id);
        $tintuc->TieuDe = $req->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($req->TieuDe);
        $tintuc->idLoaiTin = $req->idLoaiTin;
        $tintuc->TomTat = $req->TomTat;
        $tintuc->NoiDung = $req->NoiDung;
        $tintuc->NoiBat = $req->NoiBat;
        $tintuc->SoLuotXem = 0;
        if ($req->Hinh != $tintuc->Hinh) {
            $file = $req->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if($duoi !='png' && $duoi != 'jpg' && $duoi != 'jpeg' ){
                return redirect('admin/tintuc/them')->with('loi','Bạn chỉ được chọn file có đuôi là png, jpg, jpeg');  
            }

            $name = $file->getClientOriginalName();
            $hinh = str_random(4).'_'.$name;
            while (file_exists('upload/tintuc/'.$hinh)) {
                $hinh = str_random(4).'_'.$name;
            }
            $file->move('upload/tintuc/',$hinh);
            unlink('upload/tintuc/'.$tintuc->Hinh);
            $tintuc->Hinh = $hinh;
        }

        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Đã sửa thành công'); 
    }
    public function getxoa($id){
    	$tintuc = TinTuc::find($id);
    	$saveTen = $tintuc->TieuDe;
    	$tintuc->delete();
    	return redirect('admin/tintuc/danhsach')->with('thongbao',"Bạn đã xóa tin tức: $saveTen thành công!");

    }
}
