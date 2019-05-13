<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\TheLoai;
use App\LoaiTin;

Route::get('/',function(){
	return view('trangchu');
});

// Route::get('/', function () {
//     return view('index');
// });
Route::get('theloai_get_loai_tin_test',function (){
	$theloai = TheLoai::find(1);
	$tinList = $theloai->tintuc;
	$i=1;
	foreach ($tinList as $tin) {		
		echo $i." - ". $tin->TieuDe."</br>";
		$i++;
	}

});

Route::group(['prefix'=>'admin'],function(){
	// Thể loại
	Route::group(['prefix'=>'theloai'],function(){
		Route::get('danhsach','TheLoaiController@getdanhsach');

		Route::get('them','TheLoaiController@getthem');
		Route::post('postthem','TheLoaiController@postthem');

		Route::get('sua/{id}','TheLoaiController@getsua');
		Route::post('postsua/{id}','TheLoaiController@postsua');

		Route::get('xoa/{id}','TheLoaiController@getxoa');
	});	
	// Loại tin
	Route::group(['prefix'=>'loaitin'],function(){
		Route::get('danhsach','LoaiTinController@getdanhsach');

		Route::get('them','LoaiTinController@getthem');
		Route::post('postthem','LoaiTinController@postthem');

		Route::get('sua/{id}','LoaiTinController@getsua');
		Route::post('postsua/{id}','LoaiTinController@postsua');

		Route::get('xoa/{id}','LoaiTinController@getxoa');
	});	
	//Tin tức
	Route::group(['prefix'=>'tintuc'],function(){
		Route::get('danhsach','TinTucController@getdanhsach');

		Route::get('them','TinTucController@getthem');
		Route::post('postthem','TinTucController@postthem');

		Route::get('sua/{id}','TinTucController@getsua');
		Route::post('postsua/{id}','TinTucController@postsua');

		Route::get('xoa/{id}','TinTucController@getxoa');
	});
	//Comment
	Route::group(['prefix'=>'comment'],function(){
		Route::get('xoa/{id}','CommentController@getxoa');
	})	;

	Route::group(['prefix'=>'ajax'],function(){
		Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
	})	;	
	//User
	Route::group(['prefix'=>'user'],function(){
 		Route::get('danhsach','UserController@getDanhSach');

 		Route::get('sua/{id}','UserController@getSua');
 		Route::post('sua/{id}','UserController@postSua');

 		Route::get('them','UserController@getThem');
 		Route::post('postthem','UserController@postThem');

 		Route::get('xoa/{id}','UserController@getXoa');
	});
	//Slide
	Route::group(['prefix'=>'slide'],function(){
		Route::get('danhsach','SlideController@getDanhsach');

		Route::get('sua/{id}','SlideController@getSua');
		Route::post('sua/{id}','SlideController@postSua');

		Route::get('them','SlideController@getThem');
		Route::post('them','SlideController@postThem');

		Route::get('xoa/{id}','SlideController@getXoa');
	});
});

//Phần hiển thị trang chủ
//https://www.youtube.com/watch?v=FO4RS_F0oIw&list=PLzrVYRai0riQ-K705397wDnlhhWu-gAUh&index=66
Route::get('trangchu','PagesController@trangchu');
Route::get('lienhe','PagesController@lienhe');
Route::get('loaitin/{idLoaiTin}/{tenkhongdau}.html','PagesController@loaitin');
Route::get('tintuc/{id}/{tenkhongdau}.html','PagesController@tintuc');
