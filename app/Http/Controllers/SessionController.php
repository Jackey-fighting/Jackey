<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionController extends Controller
{
	//只显示登录，注册的页面给游客
	public function __construct(){
		$this->middleware('guest', [
			'only'=>['create']
		]);
	}

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
            if (Auth::user()->activated) {
                //登录成功的操作
                session()->flash('success', 'Welcome to here!!!');
                //redirect()->intended()这是返回上次访问的地方，避免再次登录，如果上次没有，则默认填写的地址
                return redirect()->intended(route('users.show', [Auth::user()]));
            }else{
                session()->flash('warning', 'You haven`t signed up ,please confirm email that have send to you.');
                return redirect('/');
            }
    		
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
