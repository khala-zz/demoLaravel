<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\TheLoai;
use App\Models\Slide;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\User;

class PageController extends Controller
{
    //
    function __construct(){
    	$theloai = TheLoai::all();
    	$slide = Slide::all();
    	view() -> share('theloai',$theloai);
    	view() -> share('slide',$slide);

    	if(Auth::check()){
    		view() -> share('nguoidung',Auth::user());
    	}
    
    }
    public function trangchu(){

    	return view('pages/trangchu');

    }
    public function lienhe(){

    	return view('pages/lienhe');

    }

    public function loaitin($id){

    	$loaitin = LoaiTin::find($id);
    	$tintuc = TinTuc::where('idLoaiTin',$id) ->paginate(5);

    	return view('pages/loaitin',['loaitin' => $loaitin,'tintuc' => $tintuc]);

    }

    public function tintuc($id){

    	$tintuc = TinTuc::find($id);
    	$tinnoibat = TinTuc::where('NoiBat',1) -> take(4) ->get();
    	$tinlienquan = TinTuc::where('idLoaiTin',$tintuc -> idLoaiTin) -> take(4) ->get();
    	return view('pages/tintuc',['tintuc' => $tintuc,'tinnoibat' => $tinnoibat,'tinlienquan' => $tinlienquan]);

    }

    public function getDangnhap(){
    	return view('pages/dangnhap');
    }

    public function postDangnhap(Request $request){

    	$this -> validate($request,
            [
                'email' => 'required',
                'password' => 'required|min:3|max:32',
               
            ],
            [
                'email.required' => 'ban chua nhap email',
                'password.required' => 'ban chua nhap password',
                'password.min' => 'ten nguoi dung phai it nhat 3 ki tu',
                'password.max' => 'ten nguoi dung phai it nhat 3 ki tu',
                
            ]);
    	if(Auth::attempt(['email' => $request -> email,'password' => $request -> password])){
           
            return redirect('trangchu');
        }
        else {
            return redirect('dangnhap') -> with('thongbao','danh nhap ko thanh cong');
        }

    }
    public function Dangxuat(){
    	Auth::logout();
    	return redirect('trangchu');
    }

    public function getNguoidung(){

    	$user = Auth::user();

    	return view('pages.nguoidung',['taikhoan' => $user]);

    }

    public function postNguoidung(Request $request){
    	$this -> validate($request,
            [
                'name' => 'required|min:3',
               
            ],
            [
                'name.required' => 'ban chua nhap ten   nguoi dung',
                'name.min' => 'ten nguoi dung phai it nhat 3 ki tu',
                
            ]);
        $user = Auth::user();
        $user -> name = $request -> name;
        if($request -> changepassword == '1'){
            $this -> validate($request,
            [
                'password' => 'required|min:3|max:32',
                'password_again' => 'required|same:password',
            ],
            [
                'password.required' => 'ban chua nhap password',
                'password.min' => '  password phai co do dai tu 3 - 32 ki tu',
                'password.max' => '  password phai co do dai tu 3 - 32 ki tu',
                'password_again.required' => 'ban chua nhap lai mat khau',
                'password_again.same' => 'chua khop mat khau',
            ]);

            $user -> password = bcrypt($request -> password);
        }
       
       
        $user -> save();

        return redirect('nguoidung') -> with('thongbao','ban da sua thanh cong');
    	
    }

    public function getDangky(){

    	return view('pages.dangky');

    }

      public function postDangky(Request $request){

      	$this -> validate($request,
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3|max:32',
                'password_again' => 'required|same:password',
            ],
            [
                'name.required' => 'ban chua nhap ten   nguoi dung',
                'name.min' => 'ten nguoi dung phai it nhat 3 ki tu',
                'TieuDe.min' => 'ten   tin phai co do dai tu 3 - 100 ki tu',
               
                'email.required' => 'ban chua nhap email',
                'email.email' => 'sai dinh dang emaeil',
                'email.unique' => 'trung email',

                'password.required' => 'ban chua nhap password',
                'password.min' => '  password phai co do dai tu 3 - 32 ki tu',
                'password.max' => '  password phai co do dai tu 3 - 32 ki tu',
                'password_again.required' => 'ban chua nhap lai mat khau',
                'password_again.same' => 'chua khop mat khau',
            ]);
        $user = new User;

        $user -> name = $request -> name;
        $user -> email = $request -> email;
        $user -> password = bcrypt($request -> password);
        $user -> level = 0;
       
       
        $user -> save();

        return redirect('dangky') -> with('thongbao','ban da dang ky thanh cong');
    	
    }

    function timkiem(Request $request){

    	$tukhoa = $request -> tukhoa;
    	$tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orwhere('TomTat','like',"%$tukhoa%")->orwhere('NoiDung','like',"%$tukhoa%")->paginate(5);
    	return view('pages.timkiem',['tintuc' => $tintuc,'tukhoa' => $tukhoa]);

    }
}
