<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;

class PagesController extends Controller
{
	function __construct(){
		$theloai = TheLoai::all();
		view()->share('theloai',$theloai);
        $slide = Slide::all();
        view()->share('slide',$slide);
	}
    function trangchu(){    	
    	
    	return view('pages.trangchu');
    }
    function lienhe(){
    	return view('pages.lienhe');
    }
    function loaitin($idLoaiTin){
        $loaitin = LoaiTin::find($idLoaiTin);
        $tintuc = TinTuc::where('idLoaiTin',$idLoaiTin)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
    function tintuc($id){

        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }
}
