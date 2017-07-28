<?php

namespace App\Http\Controllers;
use illuminate\http\request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\goods;
use App\member;
use App\leave;

/**
* 
*/
class MemberController extends Controller
{
	
	public function request1(Request $request)
	{
	
		echo $request->input('name');
		echo $request->input('sex','男');
	}
	public function session1(Request $request){
		$id=$request->id;
		$request->session()->put('id',$id);
	}
	public function activity0(){


	}
	public function activity1(){

          echo '活动进行中，谢谢参与。。';
	}
	public function activity2(){
       echo '活动即将结束，抓紧时间';
	}
	public function mail(){

		for($i=1;$i<20;$i++)
		{
			Mail::raw('我是王灿，我在用我在用我的代码向你表达爱意。。。',function($message){
				$message->from('m18031885616@163.com','邮件');
				$message->subject('邮件主题');
				$message->to('407197460@qq.com');
				sleep(2);
			});
		}

		echo 'success';

		/*Mail::send('mail',[],function($message){
			$message->to('407197460@qq.com');
		});*/
	}
	public function upload(Request $request){
		if($request->isMethod('post')){
			$file=$request->file('file');
			if($file->isValid()){
				//原文件名
				$originalName=$file->getClientOriginalName();
				//扩展名
				$ext=$file->getClientOriginalExtension();
				//mimetype
				$type=$file->getClientMimeType();
				//临时绝对路径
				$realPath=$file->getRealPath();
				$filename=date('y-m-d-h-i-s').'.'.$ext;
				$bool=Storage::disk('uploads')->put($filename,file_get_contents($realPath));
				echo($bool);

			}

		}

		return view('index');
	}
	public function goods(Request $request){
		$user2id=Session::get('id');
		$leave=leave::where('user2id','=',$user2id)->where('status','=','0')->get();
		$num=count($leave);
		$request->session()->put('num',$num);
		$id=Session::get('id');
		$leave2=leave::where('user1id','=',$id)->where('status','!=','0')->where('see','=',0)->get();
		$resultnum=count($leave2);
		Session::put('resultnum',$resultnum);
		return view('index')->with('leave',$leave);
	}
	public function member(){
		$member=member::find('王灿');
		$arr=$member->attributes;
		dd($member);
		dd($arr);

	}
}