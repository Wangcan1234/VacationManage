<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\member;
use App\leave;
use App\leavetypes;
use App\yearleave;
use Illuminate\Support\Facades\Session;

class userController extends Controller
{
    public function search(Request $request){
        if(Session::get('id')==null){
            return redirect('login');
        }else{
            $name=$request->name;
            $use=member::where('username','=',$name)->get();
            return view('search')->with('user',$use);

        }

    }

    public function leave(Request $request){

        if(Session::get('id')==null)
        {
            return redirect('login');
        }
        else{
            $level=Session::get('level');
            $leavetypes=leavetypes::get();
            $Charge=member::where('level','>',$level)->get();
            return view('leave')->with('charge',$Charge)->with('leavetypes',$leavetypes);
        }

    }
    public function checkLevel(Request $request){
        $id=Session::get('id');
        $ldays=$request->days;
        if($request->holiday=='年假')
        {
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
        }
        else{
            $leavedays=0;
            $style=$request->holiday;
            $leaved=leave::where('user1id','=',$id)->where('leavestyle','=',$style)->where('status','=',1)->get();
            foreach($leaved as $itme){
                $leavedays=$itme->days+$leavedays;
            }
            $leaveT=leavetypes::where('leaveType','=',$style)->get();
            foreach($leaveT as $item){
                $days=$item->leaveDays;
            }
            $odddays= $days-$leavedays;
        }
        $odddays=$odddays-$ldays;
        if($odddays>=0)
        {
            $leave=new leave();
            $id2= $request->id2;
            $leave->user1id=$request->id1;
            $leave->user1name=$request->username;
            $leave->user2id=$id2;
            $user2=member::find($id2);
            $user2name=$user2->username;
            $leave->user2name=$user2name;
            $leave->leavestyle=$request->holiday;
            $leave->start=$request->start;
            $leave->end=$request->end;
            $leave->days=$request->days;
            $leave->id=time();
            $leave->status=0;
            $leave->see=0;
            $leave->save();
            echo '提交成功';
        }
        else
        echo '所选假期类型剩余天数不够,请重新选择...';
       header("refresh:1;url=leave");
    }

    public function deleteuser(Request $request)
    {
        $id=$request->id;
        member::find($id)->delete();
        echo '<script>alert("删除成功")</script>';
        header("refresh:0;url=usermanage");
    }

    public function resetpass(Request $request)
    {
        if(Session::get('level')<7)
        {
            echo '<script>alert("权限不够,不可以访问")</script>';
            header("refresh:0;url=goods");
        }
        else{
            $id=$request->id;
            $user=member::find($id);
            $user->password=md5(123456);
            $user->update();
            echo '<script>alert("密码重置成功")</script>';
            header("refresh:0;url=goods");
        }


    }
}