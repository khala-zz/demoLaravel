<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\View;

use App\Models\User;

class UserController extends Controller
{
    //
    public function getDanhSach(){
    	$user = User::all();
    	return view('admin.user.danhsach',['user' => $user]);
    }
     //xoa
    public function getXoa($id){
        $user = User::find($id);
        $user -> delete();
        return redirect('admin/user/danhsach') -> with('thongbao','bạn đã xóa thành công');
    }
    public function getThem(){
        return view('admin.user.them');
        
    }
     public function postThem(Request $request){

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
        $user -> level = $request -> level;
       
       
        $user -> save();

        return redirect('admin/user/them') -> with('thongbao','them thanh cong');
        
    }
    public function getSua($id){
    	$user = User::find($id);
       
    	return view('admin.user.sua',['user' => $user]);
    	
    }

    public function postSua(Request $request,$id){

     
     	$this -> validate($request,
            [
                'name' => 'required|min:3',
               
            ],
            [
                'name.required' => 'ban chua nhap ten   nguoi dung',
                'name.min' => 'ten nguoi dung phai it nhat 3 ki tu',
                
            ]);
        $user = User::find($id);

        $user -> name = $request -> name;
        
        $user -> level = $request -> level;

        if($request -> changePassword == 'on'){
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


     	return redirect('admin/user/sua/'.$id) -> with('thongbao','sua thanh cong');
    	
    }

    public function getdangnhapAdmin(){
        return view('admin.login');
    }

    public function postdangnhapAdmin(Request $request){

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
           
            return redirect('admin/theloai/danhsach');
        }
        else {
            return redirect('admin/dangnhap') -> with('thongbao','danh nhap ko thanh cong');
        }

    }

    public function getdangxuatAdmin(){

        Auth::logout();
        return redirect('admin/dangnhap');
    }

   
    
}
