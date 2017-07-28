<?php
namespace App\Http\Controllers;
use App\leavetypes;
use App\leave;
use App\member;
use Illuminate\Support\Facades\Session;

class monthController extends Controller
{
    public function month(){
        if(Session::get('id')==null){
            return redirect('login');
        }
        else{
            $leavearr=array();
            $leavearr1=array();
            $leaveday=0;
            $i=0;
            $id=Session::get('id');
            $leave= leave::where('user1id','=',$id)->where('status','=',1)->get();
            $datanow=time();
            $monthnow= date('m',$datanow);
            foreach($leave as $itim)
            {
                $leavedate=$itim->start;
                $data=strtotime($leavedate);


                $yearnow=date('y',$datanow);
                $leavemonth= date('m',$data);
                $leaveyear= date('y',$data);
                if($monthnow==$leavemonth&&$yearnow==$leaveyear){
                    $leavearr[$i]=$itim->id;
                    $leaveday=$itim->days+$leaveday;
                    $i++;
                }

            }
            $i=0;
            foreach($leavearr as $item){
                $leave2=leave::find($item);
                $leavearr1[$i]=$leave2;
                $i++;
            }
            return view('month')->with('leavearr1',$leavearr1)->with('monthnow',$monthnow)->with('leaveday',$leaveday);
        }

    }
}