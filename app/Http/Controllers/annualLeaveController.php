<?php
namespace App\Http\Controllers;
use App\leave;
use App\yearleave;
use Illuminate\Support\Facades\Session;
use App\member;
class annualLeaveController extends Controller
{
    public function annualLeave(){
        $id=Session::get('id');
        if($id==null){
           return redirect('login');
        }
        else{
            $user=member::find($id);
            $yearleave=yearleave::find(1);
            $time=$user->created_at;
            $zero1=strtotime (date("y-m-d h:i:s")); //当前时间  ,注意H 是24小时 h是12小时
            $zero2=strtotime ($time);  //过年时间，不能写2014-1-21 24:00:00  这样不对
            $workday=ceil(($zero1-$zero2)/86400);
            $num=ceil($workday/365);
            if($num<=1){
                $days=$yearleave->onelow;
            }elseif($num<=4){
                $days=$yearleave->fourlow;
            }elseif($num<=9){
                $days=$yearleave->ninelow;
            }elseif($num<=15){
                $days=$yearleave->fifttenlow;
            }
            else{
                $days=$yearleave->sixteenup;
            }
            $leavedays=0;
            $leaveyaer=leave::where('user1id','=',$id)->where('leavestyle','=','年假')->where('status','=',1)->get();
            foreach($leaveyaer as $item){
                $leavedays = $item->days+$leavedays;
            }
            $odddays=$days-$leavedays;
            return view('annualLeave')->with('odddays',$odddays)->with('leaveyaer',$leaveyaer)->with('days',$days);
        }

    }
}