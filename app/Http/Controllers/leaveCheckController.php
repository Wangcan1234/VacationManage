<?php
namespace App\Http\Controllers;
use App\leavetypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\leave;
use App\yearleave;
use App\member;
class leaveCheckController extends Controller
{
    public function manage(){
       $id= Session::get('id');
        if($id==null){
            return redirect('login');
        }else{
            $user2leave=leave::where('user2id','=',$id)->where('status','=','0')->get();
            return view('manage')->with('user2leave',$user2leave);
        }

    }

    public function shenqing(Request $request)
    {
        $numb=$request->numb;//同意不同意状态，同意为1不同意为2,未审批是0
        $leaveid=$request->leaveid;//申请单单号
        $leave=leave::find($leaveid);
        $leave->status=$numb;
        $leave->save();
        echo '处理完成';
        $num=Session::get('num');
        $num=$num-1;
        Session::put('num',$num);
        header("refresh:1;url=manage");
    }



    public function result()
    {

        $id=Session::get('id');
        if($id==null){
            return redirect('login');
        }else{
            Session::put('resultnum',0);
            $leave=leave::where('user1id','=',$id)->where('status','!=','0')->where('see','=',0)->get();
            $leave1=leave::where('user1id','=',$id)->where('status','!=','0')->where('see','!=',0)->paginate(10);
            foreach($leave as $item){
                $item->see=1;
                $item->save();
            }

            return view('result')->with('leave',$leave)->with('leave1',$leave1);
        }

    }

    public function getdays(Request $request)
    {
        $id=Session::get('id');
        if($id==null){
            return redirect('login');
        }
        else{
            $style=$request->style;
            if($style==null){
                echo '<script>alert("类型没有选择")</script>';
                header("refresh:0;url=searchleave");
            }
            else{
                $leavedays=0;
                $leaveT=leavetypes::where('leaveType','=',$style)->get();
                foreach($leaveT as $item){
                    $days=$item->leaveDays;
                }
                $leaved=leave::where('user1id','=',$id)->where('leavestyle','=',$style)->where('status','=',1)->get();
                foreach($leaved as $itme){
                    $leavedays=$itme->days+$leavedays;
                }

                $odddays= $days-$leavedays;
                return view('oldddays')->with('odddays',$odddays)->with('days',$days);
            }

            }

    }

    public function searchleave()
    {
        $id=Session::get('id');
        $level=Session::get('level');
        if($id==null){
            return redirect('login');
        }else{
            $leavetype=leavetypes::get();
            return view('searchleave')->with('leavetype',$leavetype);
        }

    }

    public function searchone(Request $request)
    {
        $id=Session::get('id');
        $level=Session::get('level');
        if($id==null){
            return redirect('login');
        }elseif($level<8){
            echo '<script>alert("权限不够")</script>';
        }
        else{
            $leavearr=array();
            $leavearr1=array();
            $leaveday=0;
            $i=0;
            $id=$request->id;
            $user=member::find($id);
            $month = $request->month;
            $leave= leave::where('user1id','=',$id)->where('status','=',1)->get();
            foreach($leave as $itim)
            {
                $leavedate=$itim->start;
                $data=strtotime($leavedate);
                $datanow=time();
                $yearnow=date('y',$datanow);
                $month1= date('m',$data);
                $leaveyear= date('y',$data);
                if($month==$month1&&$yearnow==$leaveyear){
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
            $leavetypes=leavetypes::get();
            $arrdays=[];

            foreach($leavetypes as $leavetype)
            {
                $typedays=0;
                $type=$leavetype->leaveType;
                foreach($leavearr1 as $leave){
                    if($type==$leave->leavestyle){
                        $typedays=$typedays+$leave->days;
                    }
                }
                $arrdays[$type]=$typedays;
            }

            return view('searchone')->with('leavearr1',$leavearr1)->with('leaveday',$leaveday)->with('user',$user)->with('month',$month)->with('arrdays',$arrdays)
                ->with('leavetypes',$leavetypes);
        }

    }

    public function seachmy(Request $request)
    {
        $id=Session::get('id');
        if($id==null){
            return redirect('login');
        }
        else{
            $month= $request->month;
            $leavearr=array();
            $leavearr1=array();
            $leaveday=0;
            $i=0;
            $leave= leave::where('user1id','=',$id)->where('status','=',1)->get();
            foreach($leave as $itim)
            {
                $leavedate=$itim->start;
                $data=strtotime($leavedate);
                $datanow=time();
                $yearnow=date('y',$datanow);
                $month1= date('m',$data);
                $leaveyear= date('y',$data);
                if($month==$month1&&$yearnow==$leaveyear){
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
            return view('searchmy')->with('leavearr1',$leavearr1)->with('leaveday',$leaveday)->with('month',$month);

        }

    }
    public function getleaveday(Request $request)
    {


        $id=Session::get('id');
        $level=Session::get('level');
        if($id==null){
            return redirect('login');
        }elseif($level<8){
            echo "权限不够";
            header("refresh:1;url=manage");
        }
        else{

            $idsearch=$request->id1;
            $search1=member::find($idsearch);;
            if($search1==null){
                echo '<script>alert("没有找到这个人")</script>';
                header("refresh:0;url=searchleave");
            }else{
                $searchname=$search1->username;
                $style=$request->style;
                $leavedays=0;
                if($style!='年假'){
                    $leaveT=leavetypes::where('leaveType','=',$style)->get();
                    foreach($leaveT as $item){
                        $days=$item->leaveDays;
                    }
                    $leaved=leave::where('user1id','=',$idsearch)->where('leavestyle','=',$style)->where('status','=',1)->get();
                    foreach($leaved as $itme){
                        $leavedays=$itme->days+$leavedays;
                    }

                    $odddays= $days-$leavedays;
                }else{
                    $user=member::find($idsearch);
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
                    $leaveyaer=leave::where('user1id','=',$idsearch)->where('leavestyle','=','年假')->where('status','=',1)->get();
                    foreach($leaveyaer as $item){
                        $leavedays = $item->days+$leavedays;
                    }
                    $odddays=$days-$leavedays;
                }
                return view('oldddays')->with('odddays',$odddays)->with('days',$days)->with('searchname',$searchname)->with('style',$style);
            }


            }


    }
}