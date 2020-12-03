<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\Comment;

class TinTucController extends Controller
{
    //
    public function getDanhSach(){
    	$tintuc = TinTuc::orderBy('id','DESC')-> get();
    	return view('admin.tintuc.danhsach',['tintuc' => $tintuc]);
    }
     //xoa
    public function getXoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc -> delete();
        return redirect('admin/tintuc/danhsach') -> with('thongbao','bạn đã xóa thành công');
    }
    public function getThem(){

        $loaitin = LoaiTin::all();
        $theloai = TheLoai::all();

        return view('admin.tintuc.them',['loaitin' => $loaitin,'theloai' => $theloai]);
        
    }
     public function postThem(Request $request){

        $this -> validate($request,
            [
                'TieuDe' => 'required|unique:TinTuc,TieuDe|min:3',
                'LoaiTin' => 'required',
                'TomTat' => 'required',
                'NoiDung' => 'required'
            ],
            [
                'TieuDe.required' => 'ban chua nhap ten   tin tuc',
                'TieuDe.unique' => 'ten  tin da ton tai',
                'TieuDe.min' => 'ten   tin phai co do dai tu 3 - 100 ki tu',
               
                'LoaiTin.required' => 'ban chua chon  loai tin',
                'TomTat.required' => 'ban chua  nhap TomTat',
                'NoiDung.required' => 'ban chua Nhap Noi Dung',
            ]);
        $tintuc = new TinTuc;

        $tintuc -> TieuDe = $request -> TieuDe;
        $tintuc -> TieuDeKhongDau = changeTitle($request -> TieuDe);
        $tintuc -> idLoaiTin = $request -> LoaiTin;
        $tintuc -> TomTat = $request -> TomTat;
        $tintuc -> NoiDung = $request -> NoiDung;
        $tintuc -> SoLuotXem = 0;
        if($request -> hasFile('Hinh')){

            $file = $request -> file('Hinh');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect('admin/tintuc/them') -> with('thongbao','khong dung hinh quy dinh');
            }
            $name = $file -> getClientOriginalName();
            $hinh = Str::random(4).'_'.$name;
            //kiem tra lai xem co trunh file ko
            while (file_exists('upload/tintuc/'.$hinh)) {
                $hinh = Str::random(4).'_'.$name;   
            }
            $file -> move('upload/tintuc/',$hinh);

            $tintuc -> Hinh = $hinh;
        }
        else{
            $tintuc -> Hinh ='';
        }
        $tintuc -> save();

        return redirect('admin/tintuc/them') -> with('thongbao','them thanh cong');
        
    }
    public function getSua($id){
    	$tintuc = TinTuc::find($id);
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
    	return view('admin.tintuc.sua',['tintuc' => $tintuc,'theloai' => $theloai,'loaitin' => $loaitin]);
    	
    }

    public function postSua(Request $request,$id){

     
     	$tintuc = TinTuc::find($id);
       $this -> validate($request,
            [
                'TieuDe' => 'required|unique:TinTuc,TieuDe|min:3',
                'LoaiTin' => 'required',
                'TomTat' => 'required',
                'NoiDung' => 'required'
            ],
            [
                'TieuDe.required' => 'ban chua nhap ten   tin tuc',
                'TieuDe.unique' => 'ten  tin da ton tai',
                'TieuDe.min' => 'ten   tin phai co do dai tu 3 - 100 ki tu',
               
                'LoaiTin.required' => 'ban chua chon  loai tin',
                'TomTat.required' => 'ban chua  nhap TomTat',
                'NoiDung.required' => 'ban chua Nhap Noi Dung',
            ]);
        

        $tintuc -> TieuDe = $request -> TieuDe;
        $tintuc -> TieuDeKhongDau = changeTitle($request -> TieuDe);
        $tintuc -> idLoaiTin = $request -> LoaiTin;
        $tintuc -> TomTat = $request -> TomTat;
        $tintuc -> NoiDung = $request -> NoiDung;
        $tintuc -> SoLuotXem = 0;
        if($request -> hasFile('Hinh')){

            $file = $request -> file('Hinh');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect('admin/tintuc/them') -> with('thongbao','khong dung hinh quy dinh');
            }
            $name = $file -> getClientOriginalName();
            $hinh = Str::random(4).'_'.$name;
            //kiem tra lai xem co trunh file ko
            while (file_exists('upload/tintuc/'.$hinh)) {
                $hinh = Str::random(4).'_'.$name;   
            }
            $file -> move('upload/tintuc/',$hinh);
            unlink('upload/tintuc/'.$tintuc -> Hinh);

            $tintuc -> Hinh = $hinh;
        }
     
        $tintuc -> save();


     	return redirect('admin/tintuc/sua/'.$id) -> with('thongbao','sua thanh cong');
    	
    }

   
    
}
