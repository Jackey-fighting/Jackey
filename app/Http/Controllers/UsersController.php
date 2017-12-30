<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Mail;

class UsersController extends Controller
{   //进行中间件过滤
    public function __construct(){
        $this->middleware('auth', [
            'except'=>['show', 'create', 'store', 'index','confirmEmail']
        ]);
        $this->middleware('guest', [
            'only'=>['create']
        ]);
    }

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

        $this->sendEmailConfirmationTo($user);
       // Auth::login($user);//已注册的用户进行登录
    	session()->flash('success', 'This confirm_email is send to your email, please check it.');
    	return redirect()->route('users.show', compact('user')) ;
    }
    //用户编辑
    public function edit(User $user){

        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }
    //更新用户信息
    public function update(User $user,Request $request){
        /*$this->validate($request, [
            'name'=>'required|max:50',
            'password'=>'required|min:6|confirmed'
        ]);*/
        Validator::make($request->all(), [
            'name'=>'reuired|max:50',
            'password'=>'nullable|min:6|confirmed'
        ]);

        $this->authorize('update',$user);
        $data = [];
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $data['name'] = $request->name;
        $user->update($data);
        session()->flash('success', 'You have updated.');
        return redirect()->route('users.show', $user->id);
    }
    //展示所有的用户
    public function index(){
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }
    //删除用户
    public function destroy(User $user){
        $this->authorize('destroy',$user);
        $user->delete();
        session()->flash('success', 'You have deleted user');
        return back();
    }
    //邮箱发送方法
    protected function sendEmailConfirmationTo($user){
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'Jackey@163.com';
        $name = 'Jackey';
        $to   = $user->email;
        $subject = "Thanks for you to sign up in the site, please confirm in your email.";

        Mail::send($view, $data, function($message) use($from, $name, $to, $subject){
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }
    //邮箱验证方法
    public function confirmEmail($token){
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', 'Congratulatie you have activation succsee.');
        return redirect()->route('users.show', [$user]);
    }
}
