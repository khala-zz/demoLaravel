<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
//kiemn tra user dang nhap
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct(){
    	//$this -> Dangnhap();
    	//view() -> share('khala',$this -> user());
    	$this->middleware(function ($request, $next) {
            $this -> Dangnhap();
            return $next($request);
        });

    }

    function Dangnhap(){
    		
    		$user = Auth::user();
    		if(Auth::check() == true){
    			
    			view() -> share('khala',$user);
    		}
    		else{
    			
    			view() -> share('khala','chua dang nhap');
    		}

    		
    	
    }

    public function user()
    {
        return Auth::user();
    }
}
