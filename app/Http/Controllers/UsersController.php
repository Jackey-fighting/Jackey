<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UsersController extends Controller
{
    public function create(){
    	return view('users.create');
    }

    public function show(User $user){//对应 Route::get('users/{user}', 'UsersController@show')
    	return view('users.show', compact('user'));
    }
    //创建一个用户
    public function store(Request $request){
    	$this->validate($request, [
    		'name'=>'required|max:50',
    		'email'=>'required|email|unique:users|max:255',
    		'password'=>'required|min:6|confirmed'
    	]);

    	$user = User::create([
    		'name'=>$request->name,
    		'email'=>$request->email,
    		'password'=>bcrypt($request->password)
    	]);

        Auth::login($user);//已注册的用户进行登录
    	session()->flash('success', 'welcome to here, you will open the new trip.');
    	return redirect()->route('users.show', compact('user')) ;
    }

}
