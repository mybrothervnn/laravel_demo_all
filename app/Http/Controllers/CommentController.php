<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\Comment;

class CommentController extends Controller
{
    public function getxoa($id){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbaocomment','Đã xóa comment thành công');
    }
}
