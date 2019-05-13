<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use App\TinTuc;

class UserController extends Controller
{
    public function getDanhSach(){
        $user = User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    	
    }
    public function getThem(){
        return view('admin.user.them');
    	
    }
    public function postThem(Request $req){
        $this->validate($req,[
            'name'=>'required|min:6|unique:user',
            'email'=>'required|email|unique:user,email',
            'password'=>'required|min:6|max:33',
            'passwordAgain'=>'required|same:password'
            ],[
            'name.required'=>'Bạn chưa nhập tên người dùng',
            'name.min'=>'Tên người dùng phải dài hơn 6 kí tự',
            'name.unique'=>'Tên người dùng đã tồn tại',
            'email.required'=>'Bạn chưa nhập email người dùng',
            'email.email'=>'Bạn chưa nhập đúng định dạng email',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Bạn chưa nhập password người dùng',
            'password.min'=>'Password phải dài hơn 6 kí tự',
            'password.max'=>'Password phải ngắn hơn 33 kí tự',
            'passwordAgain.required'=>'Bạn chưa nhập lại password người dùng',
            'passwordAgain.same'=>'Password nhập lại chưa đúng',
        ]);
        $user = new User;
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=bcrypt($req->password);
        $user->level=$req->quyen;
        $user->save();
        return redirect('admin/user/them')->with('thongbao',"Bạn đã thêm user thành công");
    
    }
    public function getSua($id){
    	$user = User::find($id);
    	return view('admin.user.sua',['user'=>$user]);

    }
    public function postSua(Request $req,$id){
    	$this->validate($req,[
            'name'=>'required|min:6'
            ],[
            'name.required'=>'Bạn chưa nhập tên người dùng',
            'name.min'=>'Tên người dùng phải dài hơn 6 kí tự'
        ]);
        $user = User::find($id);
        $user->name=$req->name;
        $user->level=$req->quyen;
        if($req->changePassword =="on"){
            $this->validate($req,[
                'password'=>'required|min:6|max:33',
                'passwordAgain'=>'required|same:password'
                ],[
                'password.required'=>'Bạn chưa nhập password người dùng',
                'password.min'=>'Password phải dài hơn 6 kí tự',
                'password.max'=>'Password phải ngắn hơn 33 kí tự',
                'passwordAgain.required'=>'Bạn chưa nhập lại password người dùng',
                'passwordAgain.same'=>'Password nhập lại chưa đúng',
            ]);
            $user->password=bcrypt($req->password);
        }
        $user->save();
        return redirect('admin/user/sua/'.$id)->with('thongbao',"Bạn đã sửa user thành công");     	
    }
    
    public function getXoa($id){
    	$user=User::find($id);
        $comment = Comment::where('idUser',$id)->count();
        
        if($comment != 0){
            return redirect('admin/user/danhsach')->with('thongbao',"Đã còn dữ liệu liên hệ tới user này nên không xóa được");
        }
        else{
            $user->delete();
            return redirect('admin/user/danhsach')->with('thongbao',"Bạn đã xóa user thành công");
        }
    }	

}
