@extends('comment.layout')
@section('content')
    <div class="content" style="color:white;">
        @if(!isset($searchname))
        <div style="font-size: 30px;padding: 10%">
            此类型假期一共有{{$days}}天，您的剩余天数为:{{$odddays}}天。
        </div>
            @else
            <div style="font-size: 30px;padding: 10%">
                您查询的用户为<b>{{$searchname}}</b><br><br><br>他的{{$style}}一共有{{$days}}天,剩余{{$odddays}}天
            </div>
            @endif
    </div>
@stop