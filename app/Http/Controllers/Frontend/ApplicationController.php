<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends FrontendController
{

    public function index(){
        $this->data('categoryData',Category::all());
        $this->data('title',$this->makeTitle('Home'));
        return view($this->pagePath.'home.home',$this->data);
    }
    public function contact(){
        $this->data('title',$this->makeTitle('contact'));
        return view($this->pagePath.'contact.contact',$this->data);
    }

    //user login
    public function login(Request $request){
        if($request->isMethod('get')){
            return view($this->frontendPath.'users.login',$this->data);
        }
        if($request->isMethod('post')){
            $this->validate($request,[
                'username'=>'required',
                'password'=>'required'
            ]);
            $username=$request->username;
            $password=$request->password;
            echo $username.' '.$password;
            if(Auth::guard('web')->attempt(['username'=>$username,'password'=>$password])){
              return redirect()->intended('users');
            }else{
                return redirect()->back()->with('error',"Username and password do not match");
            }
        }
    }

    public function user(Request $request){
        return view($this->frontendPath.'users.index',$this->data);
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->intended('login');
    }
}
