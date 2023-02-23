<?php

use Illuminate\Support\Facades\Route;

// Test purposes
// child   19138Mat@0001    111
// MiWife   555
// AMW

Route::get('TView',function(){
    return view('Test');
});

Route::get('TestContentView',function(){
    $FirstArray=array();
    $FirstArray[0]='Amma'; $FirstArray[1]='Tatta';
    return view('Test')->with('firsts',$FirstArray);
});
Route::get('TestContentViews',function(){
    $SecArray=array();
    $SecArray[0]='Aiya'; $SecArray[1]='Akka';
    return view('Test')->with('Sec',$SecArray);
});
Route::get('AddForm',function(){
    $x='1';
    return view('Test')->with('x',$x);
});


Route::post('Test','TestController@Explode');
Route::get('TestEncrypt','TestController@Encrypt');
Route::get('TestRedirect','TestController@Redirect');
Route::get('SessionDelete',function(){
    session()->flush(); 
});

Route::get('RetreiveRedirect/{a}',function($q){
    print_r($q);
});

Route::get('TestExist','TestController@CheckExistQuery');








//   Basic Login Routes
Route::get('/',function(){
    return view('Login');
});

Route::post('Login','Basic_Controller@Login');

Route::get('LogOut',function(){
    session()->flush();
    return redirect('/');
});





//  Admin Mid Wife

Route::get('AdminMidWife','Admin_MidWife_Controller@MWShowBasic');
Route::get('AdminMidWife/{fact}/{factId}','Admin_MidWife_Controller@MWShowBasicWithMsg');

Route::post('SearchingMW','Admin_MidWife_Controller@SearchMidWife');

Route::get('MWMore/{id}','Admin_MidWife_Controller@MWMoreFunc');

Route::get('EditMW/{id}','Admin_MidWife_Controller@MWUpdate');

Route::post('SaveMWUpdates','Admin_MidWife_Controller@SaveMWUpdatesFunc');

Route::get('MWPromote/{id}','Admin_MidWife_Controller@MWPromoteFunc');

//sending message

Route::get('AMWSendMsgAll',function(){
    return view('AdminMidWifePage')->with('AMWSendMsgSet','set');
});

Route::get('AMWSendMsg/{id}',function($Id){
    echo "<script>   if(typeof window.history.pushState == 'function') {
    window.history.pushState({}, 'Hide', 'http://127.0.0.1:8000/AMWSendMsg'); } </script>";
    return view('AdminMidWifePage')->with('AMWSendMsgSet','set')->with('ReceiverId',$Id);
});

Route::post('AMWSendMessage','Admin_MidWife_Controller@AMWSendMessage');



//Adding child & his birth infomation 
Route::get('CreateChild',function(){
   return view('AdminMidWifePage')->with('AddChildSet','set');
});

Route::post('AddChild','Admin_MidWife_Controller@ChildDetailsSaving');

Route::get('SendChildCredentials',function(){
    $ReceiverId=session()->get('TempChildId');
    $ReceiverName=session()->get('TempChildName');
    $ReceiverMail=session()->get('TempChildEmail');
    $ReceiverPwrd=session()->get('TempChildPwrd'); 
    $SenderAMWId=session()->get('SessionAdminMidWifeId');
    $SenderAMWName=session()->get('SessionAdminMidWifeName');

    $CredentialData = [
        'ReceiverId'=>$ReceiverId, 'ReceiverName'=>$ReceiverName,'ReceiverPwrd'=>$ReceiverPwrd,
        'SenderAMWId'=>$SenderAMWId,'SenderAMWName'=>$SenderAMWName
    ];
    
    \Mail::to($ReceiverMail)->send(new \App\Mail\SendCredentials($CredentialData));
    session()->forget(['TempChildName', 'TempChildEmail', 'TempChildPwrd']);
    return redirect("AdminMidWife/AMWSndEmail/$ReceiverId"); 
});

//Adding Mid Wife
Route::get('CreateMidWife',function(){
    return view('AdminMidWifePage')->with('AddMidWifeSet','set');
 });
 
Route::post('AddMidWife','Admin_MidWife_Controller@MidWifeDetailsSaving');

Route::get('SendMWCredentials',function(){
    $ReceiverId=session()->get('TempMWId');
    $ReceiverName=session()->get('TempMWName');
    $ReceiverMail=session()->get('TempMWEmail');
    $ReceiverPwrd=session()->get('TempMWPwrd'); 
    $SenderAMWId=session()->get('SessionAdminMidWifeId');
    $SenderAMWName=session()->get('SessionAdminMidWifeName');

    $CredentialData = [
        'ReceiverId'=>$ReceiverId, 'ReceiverName'=>$ReceiverName,'ReceiverPwrd'=>$ReceiverPwrd,
        'SenderAMWId'=>$SenderAMWId,'SenderAMWName'=>$SenderAMWName
    ];
    
    \Mail::to($ReceiverMail)->send(new \App\Mail\SendCredentials($CredentialData));
    session()->forget(['TempMWName', 'TempMWEmail', 'TempMWPwrd']);
    return redirect("AdminMidWife/MWSndEmail/$ReceiverId"); 
});

Route::get('AMWProfile','Admin_MidWife_Controller@AMWProfile');

Route::get('AMWBug',function(){
    return view('AdminMidWifePage')->with('AMWBugSet','set');
});

Route::post('AMWBugSave','Admin_MidWife_Controller@AdminMidWifeBugs');

Route::get('AMWChangePwrd',function(){
    return view('AdminMidWifePage')->with('AMWChangePwrd','set');
});

Route::get('AMWCheckPwrd/{pwrd}','Admin_MidWife_Controller@CheckPwrdFunc');

Route::post('AMWSavePwrd','Admin_MidWife_Controller@SavePwrdFunc');










// MidWife

Route::get('MidWife','MidWife_Controller@ShowBasic');
Route::get('MidWife/{fact}/{factId}','MidWife_Controller@ShowBasicWithMsg');

Route::post('SearchingChild','MidWife_Controller@SearchChild');


// Table columns
Route::get('ChildMore/{x}','MidWife_Controller@ChildMoreFunc');

Route::get('EditChild/{id}','MidWife_Controller@ChildUpdate');

Route::post('SaveChildUpdates','MidWife_Controller@SaveChildUpdatesFunc');

Route::get('AddClinicData/{Id}','MidWife_Controller@SpecificChildClinicData');

Route::post('ChildDataSave','MidWife_Controller@ChildRoutineSaving');

Route::get('AddVaccine/{Id}','MidWife_Controller@SpecificChildVaccination');

Route::post('ChildVaccination','MidWife_Controller@ChildVaccination');

Route::get('MWSendMsgAll',function(){
    return view('MidWifePage')->with('MWSendMsgInfo','set');
});
Route::get('MWSendMsg/{Id}',function($ChildId){
    echo "<script>    
    if(typeof window.history.pushState == 'function') {
    window.history.pushState({}, 'Hide', 'http://127.0.0.1:8000/MWSendMsg'); } </script>";
    return view('MidWifePage')->with('MWSendMsgInfo','set')->with('ReceiverId',$ChildId);
});


Route::post('MWSendMessage','MidWife_Controller@MidWifeSendMessage');

Route::get('MWReceivedMsg','MidWife_Controller@MWReceivedMessage');
Route::get('MWMyReceivedMsg','MidWife_Controller@MWMyReceivedMessage');

Route::get('MWProfile','MidWife_Controller@MWProfile');

Route::get('MWBugs',function(){
    return view('MidWifePage')->with('MWBugInfo','set');
});
Route::post('MWBugsSave','MidWife_Controller@MidWifeBugs');

Route::get('MWChangePwrd',function(){
    return view('MidWifePage')->with('MWChangePwrd','set');
});

Route::get('MWCheckPwrd/{pwrd}','MidWife_Controller@CheckPwrdFunc');

Route::post('MWSavePwrd','MidWife_Controller@SavePwrdFunc');










// child

Route::get('Child','Child_Controller@BasicInformation');

Route::get('Child/{fact}','Child_Controller@BasicInformationWithMsg');

Route::get('BirthInfo','Child_Controller@BirthInformation');

Route::get('ChildChart','Child_Controller@ChildWeightCharts');

Route::get('HeightChart','Child_Controller@ChildHeightCharts');

Route::get('VaccinationInfo','Child_Controller@VaccinationInformation');

Route::get('CNotifications','Child_Controller@ChildNotifications');
Route::get('MyMessage','Child_Controller@MyChildNotifications');

Route::get('ClinicInfo','Child_Controller@ClinicInformation');

Route::get('CBugs',function(){
    return view('ChildPage')->with('CBugInfo','set');
});
Route::post('CBugsSave','Child_Controller@ChildBugs');

Route::get('CChangePwrd',function(){
    return view('ChildPage')->with('CChangePwrd','set');
});

Route::get('CCheckPwrd/{pwrd}','Child_Controller@CheckPwrdFunc');

Route::post('CSavePwrd','Child_Controller@SavePwrdFunc');

//Route::get('GuardianConcern','TestController@SinhalaTest');


