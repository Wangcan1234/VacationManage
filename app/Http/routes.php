<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::any('request1','MemberController@request1');
Route::group(['middleware'=>['web']],function(){
    Route::any('check','loginController@check');
    Route::any('goods','MemberController@goods');
    Route::any('/','MemberController@goods');


});
Route::any('mail','MemberController@mail');
Route::any('upload','MemberController@upload');

Route::any('annualLeave','annualLeaveController@annualLeave');
Route::any('month','monthController@month');
Route::any('personalInfo','personalInfoController@personalInfo');
Route::any('monthSum','monthSumController@monthSum');
Route::any('login','loginController@login');
Route::any('resit','resitController@resit');

Route::any('firstResit','resitController@firstResit');
Route::any('checkid','resitController@checkid');
Route::any('failResit','resitController@failResit');
Route::any('search','userController@search');
Route::any('work','userController@work');
Route::any('leave','userController@leave');
Route::any('checkLevel','userController@checkLevel');
Route::any('manage','leaveCheckController@manage');
Route::any('shenqing','leaveCheckController@shenqing');
Route::any('result','leaveCheckController@result');
Route::any('setUp','setUpController@setUp');
Route::any('setuptypes','setUpController@setuptypes');
Route::any('yearleave','setUpController@yearleave');
Route::any('changeyear','setUpController@changeyear');
Route::any('deleteleave','setUpController@deleteleave');
Route::any('usermanage','setUpController@usermanage');
Route::any('deleteuser','userController@deleteuser');
Route::any('out','loginController@out');
Route::any('changepassword','loginController@changepassword');
Route::any('searchleave','leaveCheckController@searchleave');
Route::any('getdays','leaveCheckController@getdays');
Route::any('searchone','leaveCheckController@searchone');
Route::any('seachmy','leaveCheckController@seachmy');
Route::any('getleaveday','leaveCheckController@getleaveday');
Route::any('resetpass','userController@resetpass');














?>
