<?php
namespace App\Http\Controllers;
use App\member;
use Illuminate\Support\Facades\Session;

class personalInfoController extends Controller
{
    public function personalInfo(){
        $id=Session::get('id');
        if($id==null){
            return redirect('login');
        }
        $user=member::find($id);
        return view('personalInfo')->with('user',$user);
    }
}