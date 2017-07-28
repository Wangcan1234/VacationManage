<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\member;
use Illuminate\Support\Facades\Input;

class resitController extends Controller
{
    public function resit()
    {
        return view('resit');
    }

    public function firstResit(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->input('member');
            $password = $data['password'];
            $password1 =$data['password1'];
            $id = $data['id'];
           $phone= $data['phone'];
            $user=member::find($id);
           /* dd($user);*/
            if (strlen($id) != 4) {
                return redirect()->back()->withInput();
            } elseif
             ($password !== $password1) {
                return redirect()->back()->withInput();
            }elseif(!is_numeric($id)&&is_numeric($phone)){
                return redirect()->back()->withInput();
            } else {

                $member = new member();
                $password = md5($password);
                $member->username = $data['username'];
                $member->id = $data['id'];
                $member->password = $password;
                $member->sex = $data['sex'];
                $member->level = $data['level'];
                $member->phone = $data['phone'];
                $member->team = $data['team'];
                $member->save();
                echo "<h3>注册成功，3秒后返回首页...</h3>";
                header("refresh:3;url=goods");
            }


        }
    }

    public function checkid()
    {
        $input=Input::all();
        $id=$input['id'];
        $user=member::find($id);
        if($user==null){
            $data=0;
            return $data;
        }
        else{
            $data=1;
            return $data;
        }
    }
}