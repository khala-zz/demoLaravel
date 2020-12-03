<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TheLoai;

class TheLoaiController extends Controller
{
    //
    public function getDanhSach(){
    	$theloai = TheLoai::all();
    	return view('admin.theloai.danhsach',['theloai' => $theloai]);
    }
    public function getSua($id){
    	$theloai = TheLoai::find($id);
    	return view('admin.theloai.sua',['theloai' => $theloai]);
    	
    }

    public function postSua(Request $request,$id){

     	$theloai = TheLoai::find($id);
     	$this -> validate($request,
    		[
    			'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
    		],
    		[
    			'Ten.required' => 'ban chua nhap ten the loai',
    			'Ten.unique' => 'ten the loai da ton tai',
    			'Ten.min' => 'ten the loai phai co do dai tu 3 - 100 ki tu',
    			'Ten.max' => 'ten the loai phai co do dai tu 3 - 100 ki tu',
    		]);
     	$theloai -> Ten = $request -> Ten;
     	$theloai -> TenKhongDau = changeTitle($request -> Ten);
     	$theloai -> save();

     	return redirect('admin/theloai/sua/'.$id) -> with('thongbao','sua thanh cong');
    	
    }

    //xoa
    public function getXoa($id){
    	$theloai = TheLoai::find($id);
    	$theloai -> delete();
    	return redirect('admin/theloai/danhsach') -> with('thongbao','bạn đã xóa thành công');
    }
    public function getThem(){

    	return view('admin.theloai.them');
    	
    }
     public function postThem(Request $request){

    	$this -> validate($request,
    		[
    			'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
    		],
    		[
    			'Ten.required' => 'ban chua nhap ten the loai',
    			'Ten.unique' => 'ten the loai da ton tai',
    			'Ten.min' => 'ten the loai phai co do dai tu 3 - 100 ki tu',
    			'Ten.max' => 'ten the loai phai co do dai tu 3 - 100 ki tu',
    		]);
    	$theloai = new TheLoai;

    	$theloai -> Ten = $request -> Ten;
    	$theloai -> TenKhongDau = changeTitle($request -> Ten);
    	$theloai -> save();

    	return redirect('admin/theloai/them') -> with('thongbao','them thanh cong');
    	
    }
}
