<?php
namespace App\Http\Controllers;

use App\leavetypes;
use Illuminate\Http\Request;
use App\member;
use App\yearleave;
use App\leave;
use Illuminate\Support\Facades\Session;

class loginController extends Controller
{
    public function login(){
        return view('login');
    }
    public function check(Request $request){
        $id=$request->id;
        $user=member::find($id);
        $password1=$request->password;
        $password1=md5($password1);
        $password=$user['password'];
        $name= $user['username'];
        $level=$user['level'];

       if($user==null)
       {
           echo '用户不存在';
           header("refresh:1;url=login");
       }
        elseif($password1==$password){
            $request->session()->put('name',$name);
            $request->session()->put('level',$level);
            $request->session()->put('id',$id);
            echo '<script>alert("登录成功");</script>';
            header("refresh:0;url=goods");
        }
        else{
            echo '密码不正确';
            header("refresh:1;url=login");
        }



    }

    public function out(Request $request)
    {
        $request->session()->forget('name');
        $request->session()->forget('level');
        $request->session()->forget('id');
        header("refresh:0;url=goods");
    }

    public function changepassword(Request $request)
    {
        $oldpass=md5($request->oldpass);
        $newpass=$request->newpass;
        $userid=Session::get('id');
        $phone=$request->phone;
        $user=member::find($userid);
        $password=$user->password;
        if($oldpass==$password){
            $user->password=md5($newpass);
            $user->phone=$phone;
            $user->save();
            echo '修改成功,正在返回...';
            header("refresh:2;url=personalInfo");
        }
        else{
            echo '<script>alert("旧密码输入有误")</script>';
            header("refresh:2;url=personalInfo");
        }

    }

}