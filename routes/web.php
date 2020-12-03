<?php

use Illuminate\Support\Facades\Route;

//use App\Models\Theloai;

use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\LoaiTinController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dangnhap',[UserController::class,'getdangnhapAdmin']);
Route::post('admin/dangnhap',[UserController::class,'postdangnhapAdmin']);
Route::get('admin/logout',[UserController::class,'getdangxuatAdmin']);

Route::prefix('admin') -> middleware('adminLogin')-> group(function(){
	//Route::get('danhsach',[TheLoaiController::class,'getDanhSach'])->name('danhsach');
	//nhom duong dan the loai,admin/theloai/dansach
	Route::prefix('theloai') -> group(function(){
		Route::get('danhsach',[TheLoaiController::class,'getDanhSach']);
		Route::get('them',[TheLoaiController::class,'getThem']);
		Route::post('them',[TheLoaiController::class,'postThem']);

		Route::get('sua/{id}',[TheLoaiController::class,'getSua']);
		Route::post('sua/{id}',[TheLoaiController::class,'postSua']);
		Route::post('xoa/{id}',[TheLoaiController::class,'getXoa']);
	});
	//nhom duong dan loai tin
	Route::prefix('loaitin') -> group(function(){
		Route::get('danhsach',[LoaiTinController::class,'getDanhSach']);
		Route::get('them',[LoaiTinController::class,'getThem']);
		Route::post('them',[LoaiTinController::class,'postThem']);

		Route::get('sua/{id}',[LoaiTinController::class,'getSua']);
		Route::post('sua/{id}',[LoaiTinController::class,'postSua']);
		Route::get('xoa/{id}',[LoaiTinController::class,'getXoa']);
	});
	//nhom duong dan tin tuc
	Route::prefix('tintuc') -> group(function(){
		Route::get('danhsach',[TinTucController::class,'getDanhSach']);
		Route::get('them',[TinTucController::class,'getThem']);
		Route::post('them',[TinTucController::class,'postThem']);
		Route::get('sua/{id}',[TinTucController::class,'getSua']);
		Route::post('sua/{id}',[TinTucController::class,'postSua']);

		Route::get('xoa/{id}',[TinTucController::class,'getXoa']);
	});

	//nhom duong dan comment
	Route::prefix('comment') -> group(function(){
		Route::get('xoa/{id}/{idTintuc}',[CommentController::class,'getXoa']);
	});

	//nhom duong dan slide
	Route::prefix('slide') -> group(function(){
		Route::get('danhsach',[SlideController::class,'getDanhSach']);
		Route::get('them',[SlideController::class,'getThem']);
		Route::post('them',[SlideController::class,'postThem']);
		Route::get('sua/{id}',[SlideController::class,'getSua']);
		Route::post('sua/{id}',[SlideController::class,'postSua']);

		Route::get('xoa/{id}',[SlideController::class,'getXoa']);
	});

	//nhom duong dan user
	Route::prefix('user') -> group(function(){
		Route::get('danhsach',[UserController::class,'getDanhSach']);
		Route::get('them',[UserController::class,'getThem']);
		Route::post('them',[UserController::class,'postThem']);
		Route::get('sua/{id}',[UserController::class,'getSua']);
		Route::post('sua/{id}',[UserController::class,'postSua']);

		Route::get('xoa/{id}',[UserController::class,'getXoa']);
	});

	//nhom ajax

	Route::prefix('ajax') -> group(function(){
		Route::get('loaitin/{idTheLoai}',[AjaxController::class,'getLoaiTin']);
	});
});

// front end

Route::get('trangchu',[PageController::class,'trangchu']);
Route::get('lienhe',[PageController::class,'lienhe']);
Route::get('loaitin/{id}/{TenKhongDau}.html',[PageController::class,'loaitin']);
Route::get('tintuc/{id}/{TieuDeKhongDau}.html',[PageController::class,'tintuc']);

Route::get('nguoidung',[PageController::class,'getNguoidung']);
Route::post('nguoidung',[PageController::class,'postNguoidung']);

//dang ky

Route::get('dangky',[PageController::class,'getDangky']);
Route::post('dangky',[PageController::class,'postDangky']);

//danh nhap
Route::get('dangnhap',[PageController::class,'getDangnhap']);
Route::post('dangnhap',[PageController::class,'postDangnhap']);
Route::get('dangxuat',[PageController::class,'Dangxuat']);
Route::post('comment/{id}',[CommentController::class,'postBinhLuan']);

// tim kiem

Route::post('timkiem/',[PageController::class,'timkiem']);
Route::get('timkiem/',[PageController::class,'timkiem']);




