<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    public function getDanhSach(){
    	$slide = Slide::all();
    	return view('admin.slide.danhsach',['slide'=>$slide]);
    }
    public function getThem(){
        return view('admin.slide.them');
    }
    public function postThem(Request $request){
        
        $this->validate($request,[
        	'Ten' => 'required',
        	'NoiDung' => 'required',
        	],[
        		'Ten.required' => 'Bạn chưa nhập tên',
        		'NoiDung.required'=>'Bạn chưa nhập nội dung']);
        $slide = new Slide;
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link'))
        	$slide->link = $request->link;
        
        if ($request->hasFile('Hinh')) {
        	$file = $request->file('Hinh');  // lấy cả file 
        	$duoi = $file->getClientOriginalExtension(); //.jpg
        	if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
        		return redirect('admin/slide/them')->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
        	}
        	$name = $file->getClientOriginalName();
        	$Hinh = str_random(4)."_".$name;
        	while(file_exists("upload/slide/".$Hinh)){
        		$Hinh = str_ramdom(4)."_".$name;
        	}
        	$file->move("upload/slide",$Hinh);
        	$slide->Hinh = $Hinh;
        }
        else{
        	$slide->Hinh = "";
        }
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','Thêm thành công');

    }   
    public function getSua($id) {
        $slide = Slide::find($id);
        return view('admin.slide.sua',['slide'=>$slide]);
    }
    public function postSua(Request $request,$id) {
        $this->validate($request,[
        	'Ten' => 'required',
        	'NoiDung' => 'required',
        	],[
        		'Ten.required' => 'Bạn chưa nhập tên',
        		'NoiDung.required'=>'Bạn chưa nhập nội dung']);
        $slide = Slide::find($id);
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link'))
        	$slide->link = $request->link;
        
        if ($request->hasFile('Hinh')) {
        	$file = $request->file('Hinh');
        	$duoi = $file->getClientOriginalExtension();
        	if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
        		return redirect('admin/slide/them')->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
        	}
        	$name = $file->getClientOriginalName();
        	$Hinh = str_random(4)."_".$name;
        	while(file_exists("upload/slide/".$Hinh)){
        		$Hinh = str_random(4)."_".$name;
        	}
        	unlink("upload/slide/".$slide->Hinh);
        	$file->move("upload/slide",$Hinh);
        	$slide->Hinh = $Hinh;
        }
        
        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa thành công');
        
        
    }
    function getXoa($id){
    	$slide = Slide::find($id);
    	$slide->delete();

    	return redirect('admin/slide/danhsach')->with('thongbao','Xóa thành công');
    }
}
