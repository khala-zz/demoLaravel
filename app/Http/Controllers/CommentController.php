<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;


use App\Models\Comment;

use App\Models\Tintuc;

class CommentController extends Controller
{
    //
   
     //xoa
    public function getXoa($id,$idTinTuc){
        $comment = Comment::find($id);
        $comment -> delete();
        return redirect('admin/tintuc/sua/'.$idTinTuc) -> with('thongbao','bạn đã xóa comment thành công');
    }

    public function postBinhLuan(Request $reques,$id){

    	$idTinTuc = $id;

    	$tintuc = Tintuc::find($id);

    	$comment = new Comment();

    	$comment -> idTinTuc = $idTinTuc;
    	$comment -> idUser = Auth::user() -> id;
    	$comment -> NoiDung = $reques -> noidung;

    	$comment -> save();

    	return redirect('tintuc/'.$idTinTuc.'/'.$tintuc -> TieuDeKhongDau.'.html') -> with('thongbao','post comment thanh cong');


    }
    

   
    
}
