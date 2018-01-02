<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Status;

class StatusesController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    //进行创建一条微博
    public function store(Request $request){
    	$this->validate($request, [
    		'content'=>'required|max:140'
    	]);

    	Auth::user()->statuses()->create([
    		'content'=>$request->content
    	]);
        session()->flash('success', 'Release success.');
    	return redirect()->back();
    }
    //删除一条微博
    public function destroy(Status $status){//Laravel的隐形查询，会自动的找回一个模型实例
        $this->authorize('destroy', $status);
        $status->delete();
        session()->flash('success', 'You have delete the data of microblogging.');
        return redirect()->back();
    }
}
