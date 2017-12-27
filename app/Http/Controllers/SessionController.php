<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionController extends Controller
{
    public function create(){
    	return view('sessions.create');
    }

    //登录验证
    public function store(Request $request){
    	$credentials = $this->validate($request, [
    		'email'=>'required|email|max:255',
    		'password'=>'required|min:6'
    	]);
    	if (Auth::attempt($credentials, $request->has('remember'))) {
    		//登录成功的操作
    		session()->flash('success', 'Welcome to here!!!');
    		return redirect()->route('users.show', [Auth::user()]);
    	}else{
    		//登录失败的操作
    		session()->flash('danger', 'sorry, your email and password is wrong.');
    		return redirect()->back();
    	}
    }

    //退出
    public function destroy(){
    	Auth::logout();
    	session()->flash('success', 'you have quited!');
    	return redirect('login');
    }
}
