<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

class monthSumController extends Controller
{
    public function monthSum(){

        if(Session::get('id')==null){
            return redirect('login');
        }
        else{
        return view('monthSum');
        }
    }
}