<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\leavetypes;
use App\yearleave;
use App\member;
use Illuminate\Support\Facades\Session;

class setUpController extends Controller
{
    public function setUp(){
        $leavetypes=leavetypes::get();
       $yearleave=yearleave::get();
        return view('setUp')->with('leavetypes',$leavetypes)
            ->with('yearleave',$yearleave);
    }

    public function setuptypes(Request $request)
    {
        $leavetypes=new leavetypes();
        $leaveType=$request->leaveType;
        $leaveDays=$request->leaveDays;
        $leaveT=leavetypes::where('leaveType','=',$leaveType)->get();
        foreach($leaveT as $itim)
        {
            $itim->leaveDays=$leaveDays;
            $itim->save();
            echo '设置成功';
            header("refresh:2;url=setUp");
            exit();

        }
        $leavetypes->leaveType=$leaveType;
        $leavetypes->leaveDays=$leaveDays;
        $leavetypes->save();
        echo '设置成功 ';
        header("refresh:1;url=setUp");

    }

    public function yearleave(Request $request)
    {
        $yearL=yearleave::get();
        if(count($yearL)!=0)
        {
            foreach($yearL as $itim){
                $itim->id=1;
                $itim->onelow=$request->onelow;
                $itim->fourlow=$request->fourlow;
                $itim->ninelow=$request->ninelow;
                $itim->fifteenlow=$request->fifteenlow;
                $itim->sixteenup=$request->sixteenup;
                $itim->save();
            }
        }else{
            $yearleave=new yearleave();
            $yearleave->id=1;
            $yearleave->onelow=$request->onelow;
            $yearleave->fourlow=$request->fourlow;
            $yearleave->ninelow=$request->ninelow;
            $yearleave->fifteenlow=$request->fifteenlow;
            $yearleave->sixteenup=$request->sixteenup;
            $yearleave->save();
        }

        echo '设置完成';
        header("refresh:1;url=setUp");
    }

    public function changeyear(Request $request)
    {
        $leaveT=$request->leaveType;
        $leaveD=$request->leaveDays;
        $yearL=yearleave::get();
        foreach($yearL as $itim){
            $itim->$leaveT=$leaveD;
            $itim->id=1;
            $itim->save();
        }
        echo '更新成功';
        header("refresh:1;url=setUp");
    }

    public function deleteleave(Request $request)
    {
        $delete=$request->deleteleave;
        $deletetype=leavetypes::where('leaveType','=',$delete)->get();
        foreach($deletetype as $item)
            $item->delete();
        echo '删除成功';
        header("refresh:1;url=setUp");
    }

    public function usermanage()
    {
        $lev= Session::get('level');
        $name=Session::get('name');
         $name;
        if($lev<8)
        {
            echo '<script>alert("权限不够不可访问。")</script>';
            echo '正在前往首页...';
            header("refresh:2;url=goods");
        }
        elseif($name==null)
        {
            echo '<script>alert("请先登录。")</script>';
            echo '正在前往首页...';
            header("refresh:2;url=goods");
        }
        else{
            $user=member::where('level','<',$lev)->get();
            return view('usermanage')->with('user',$user);
        }

    }

}