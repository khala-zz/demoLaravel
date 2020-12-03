<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TheLoai;
use App\Models\LoaiTin;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach(){
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.danhsach',['loaitin' => $loaitin]);
    }
     //xoa
    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        $loaitin -> delete();
        return redirect('admin/loaitin/danhsach') -> with('thongbao','bạn đã xóa thành công');
    }
    public function getThem(){

        $theloai = TheLoai::all();

        return view('admin.loaitin.them',['theloai' => $theloai]);
        
    }
     public function postThem(Request $request){

        $this -> validate($request,
            [
                'Ten' => 'required|unique:LoaiTin,Ten|min:3|max:100',
                'TheLoai' => 'required'
            ],
            [
                'Ten.required' => 'ban chua nhap ten  loai tin',
                'Ten.unique' => 'ten  loai tin da ton tai',
                'Ten.min' => 'ten  loai tin phai co do dai tu 3 - 100 ki tu',
                'Ten.max' => 'ten  loai tin phai co do dai tu 3 - 100 ki tu',
                'TheLoai.required' => 'ban chua chon the loai',
            ]);
        $loaitin = new LoaiTin;

        $loaitin -> Ten = $request -> Ten;
        $loaitin -> TenKhongDau = changeTitle($request -> Ten);
        $loaitin ->idTheLoai = $request -> TheLoai;
        $loaitin -> save();

        return redirect('admin/loaitin/them') -> with('thongbao','them thanh cong');
        
    }
    public function getSua($id){
    	$loaitin = LoaiTin::find($id);
        $theloai = TheLoai::all();
    	return view('admin.loaitin.sua',['loaitin' => $loaitin,'theloai' => $theloai]);
    	
    }

    public function postSua(Request $request,$id){

     
     	$this -> validate($request,
    		[
    			'Ten' => 'required|unique:LoaiTin,Ten|min:3|max:100'
    		],
    		[
    			'Ten.required' => 'ban chua nhap ten the loai',
    			'Ten.unique' => 'ten loai tin da ton tai',
    			'Ten.min' => 'ten the loai phai co do dai tu 3 - 100 ki tu',
    			'Ten.max' => 'ten the loai phai co do dai tu 3 - 100 ki tu',
    		]);
        $loaitin = LoaiTin::find($id);
     	$loaitin -> Ten = $request -> Ten;
     	$loaitin -> TenKhongDau = changeTitle($request -> Ten);
        $loaitin -> idTheLoai = $request -> TheLoai;
     	$loaitin -> save();

     	return redirect('admin/loaitin/sua/'.$id) -> with('thongbao','sua thanh cong');
    	
    }

   
    
}
