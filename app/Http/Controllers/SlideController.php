<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;


use App\Models\Slide;

class SlideController extends Controller
{
    //
    public function getDanhSach(){
    	$slide = Slide::all();
    	return view('admin.slide.danhsach',['slide' => $slide]);
    }
     //xoa
    public function getXoa($id){
        $slide = Slide::find($id);
        $slide -> delete();
        return redirect('admin/slide/danhsach') -> with('thongbao','bạn đã xóa thành công');
    }
    public function getThem(){

        return view('admin.slide.them');
        
    }
     public function postThem(Request $request){

        $this -> validate($request,
            [
                'Ten' => 'required',
               
                'NoiDung' => 'required'
            ],
            [
                'Tenrequired' => 'ban chua nhap ten   tin tuc',
               
                'NoiDung.required' => 'ban chua Nhap Noi Dung',
            ]);
        $slide = new Slide;

        $slide -> Ten = $request -> Ten;
        $slide -> NoiDung = $request -> NoiDung;
        if($request -> has('link'))
            $slide -> link = $request -> link;
        if($request -> hasFile('Hinh')){

            $file = $request -> file('Hinh');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect('admin/slide/them') -> with('thongbao','khong dung hinh quy dinh');
            }
            $name = $file -> getClientOriginalName();
            $hinh = Str::random(4).'_'.$name;
            //kiem tra lai xem co trunh file ko
            while (file_exists('upload/slide/'.$hinh)) {
                $hinh = Str::random(4).'_'.$name;   
            }
            $file -> move('upload/slide/',$hinh);

            $slide -> Hinh = $hinh;
        }
        else{
            $slide -> Hinh ='';
        }
        $slide -> save();

        return redirect('admin/slide/them') -> with('thongbao','them thanh cong');
        
    }
    public function getSua($id){
    	$slide = Slide::find($id);
    	return view('admin.slide.sua',['slide' => $slide]);
    	
    }

    public function postSua(Request $request,$id){

     
     	$this -> validate($request,
            [
                'Ten' => 'required',
               
                'NoiDung' => 'required'
            ],
            [
                'Tenrequired' => 'ban chua nhap ten   tin tuc',
               
                'NoiDung.required' => 'ban chua Nhap Noi Dung',
            ]);
        $slide = Slide::find($id);

        $slide -> Ten = $request -> Ten;
        $slide -> NoiDung = $request -> NoiDung;
        if($request -> has('link'))
            $slide -> link = $request -> link;
        if($request -> hasFile('Hinh')){

            $file = $request -> file('Hinh');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect('admin/slide/them') -> with('thongbao','khong dung hinh quy dinh');
            }
            $name = $file -> getClientOriginalName();
            $hinh = Str::random(4).'_'.$name;
            //kiem tra lai xem co trunh file ko
            while (file_exists('upload/slide/'.$hinh)) {
                $hinh = Str::random(4).'_'.$name;   
            }
            unlink('upload/slide/'. $slide -> Hinh);
            $file -> move('upload/slide/',$hinh);

            $slide -> Hinh = $hinh;
        }
     
        $slide -> save();

        return redirect('admin/slide/sua/'.$id) -> with('thongbao','sua thanh cong');
    	
    }

   
    
}
