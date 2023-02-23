<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Bug;


class Child_Controller extends Controller
{
    
    public function BasicInformation(){
        $ChildId=session()->get('SessionChildId');
        $ChildName=session()->get('SessionChildName');
        
        $result=DB::table('new__account__creatings')->select('ChildId','FullName','InitializedName','Address','District','Area','MotherName','FatherName','Email','ContactNo', 'AMWId', 'AMWName', 'created_at')->where('ChildId',$ChildId)->get();
        return view('ChildPage')->with('BasicInfoDetails',$result)->with('Name',$ChildName);
       // return redirect("BasicInfo")->with('got',$result)
    }

    public function BasicInformationWithMsg($fact){
        $ChildId=session()->get('SessionChildId');
        $ChildName=session()->get('SessionChildName');

        echo "<script>   if(typeof window.history.pushState == 'function') {
            window.history.pushState({}, 'Hide', 'http://127.0.0.1:8000/Child'); } </script>";
        
        $result=DB::table('new__account__creatings')->select('ChildId','FullName','InitializedName','Address','District','Area','MotherName','FatherName','Email','ContactNo', 'AMWId', 'AMWName', 'created_at')->where('ChildId',$ChildId)->get();
        if($fact=='CBug'){
            echo "<script> alert('Bug Reported'); </script>";
        }else if($fact=='CPwrd'){
            echo "<script> alert('Your Password Changed'); </script>";
        }
        return view('ChildPage')->with('BasicInfoDetails',$result)->with('Name',$ChildName);
    }

    public function BirthInformation(){
        
        $ChildId=session()->get('SessionChildId');
        $ChildName=session()->get('SessionChildName');

        $result=DB::table('child_birth_infos')->where('BChildId',$ChildId)->get();
        return view('ChildPage')->with('BirthInfoDetails',$result)->with('Name',$ChildName);
       // return redirect("BasicInfo")->with('got',$result)
    }

    public function ChildWeightCharts(){

        $ChildId=session()->get('SessionChildId');
        $ChildName=session()->get('SessionChildName');

        //$ResultX=DB::table('child__routine_datas')->where('ChildId',$ChildId)->pluck('ClinicNo');
        $WeightKgY=DB::table('child__routine_datas')->where('ChildId',$ChildId)->pluck('WeightInKg');
        $WeightGY=DB::table('child__routine_datas')->where('ChildId',$ChildId)->pluck('WeightInG');
        
        $Weights=[];
        foreach($WeightKgY as $key=>$val){
            $Weights[$key]=(float)$WeightKgY[$key].".".$WeightGY[$key];
        }

        $Weight=[];
        foreach($Weights as $key=>$val){
            $Weight[$key]=(float)$val;
        }
        //dd($Weight);
        return view('Chart')->with('GraphWeightY',$Weight);
    }

    public function ChildHeightCharts(){

        $ChildId=session()->get('SessionChildId');
        $ChildName=session()->get('SessionChildName');

        //$ResultX=DB::table('child__routine_datas')->where('ChildId',$ChildId)->pluck('ClinicNo');
        $HeightY=DB::table('child__routine_datas')->where('ChildId',$ChildId)->pluck('Height');
        $PerimeterY=DB::table('child__routine_datas')->where('ChildId',$ChildId)->pluck('HeadPerimeter');
        
        
        return view('Chart')->with('GraphHeightY',$HeightY)->with('GraphPerimeterY',$PerimeterY);    
    }

    public function VaccinationInformation(){

        $ChildId=session()->get('SessionChildId');
        $ChildName=session()->get('SessionChildName');

        $result=DB::table('child_vaccinations')->where('ChildId',$ChildId)->latest()->get();
        return view('ChildPage')->with('VaccineDetails',$result)->with('Name',$ChildName);
    }

    public function ChildNotifications(){ 
        $ChildId=session()->get('SessionChildId');
        $ChildName=session()->get('SessionChildName');

        $result=DB::table('m_w__send__messages')->whereIn('MWClient', ['AllChild', $ChildId] )->latest()->get();
        return view('ChildPage')->with('NotificationDetails',$result);
    }
    
    public function MyChildNotifications(){
        $ChildId=session()->get('SessionChildId');
        $ChildName=session()->get('SessionChildName');

        $result=DB::table('m_w__send__messages')->where('MWClient', $ChildId)->latest()->get();
        return view('ChildPage')->with('MyNotificationDetails',$result);
    }

    public function ClinicInformation(){ 

        $ChildId=session()->get('SessionChildId');
        $ChildName=session()->get('SessionChildName');

        $result=DB::table('child__routine_datas')->where('ChildId',$ChildId)->latest()->get();
        return view('ChildPage')->with('ClinicDetails',$result)->with('Name',$ChildName);
    }

    public function ChildBugs(Request $Bugs){
        
        $CBugObjects= new Bug;
        $ChildId=session()->get('SessionChildId');
        $ChildName=session()->get('SessionChildName');
    
        $CBugObjects->Bug=$Bugs->Message;
        $CBugObjects->CreatorId = $ChildId;
        $CBugObjects->CreatorName = $ChildName;
        if(isset($Bugs->CBugModel)){
            $CBugObjects->BugModel=$Bugs->CBugModel;
        }
        $CBugObjects->save();
        return redirect("Child/CBug");
    }

    public function CheckPwrdFunc($pwrd){
        //dd($pwrd);
        $ChildId=session()->get('SessionChildId');
        $ChildName=session()->get('SessionChildName');
        $EncryptedPwrd=sha1($pwrd);
    
        $result=DB::table('new__account__creatings')->where([ ['ChildId',$ChildId] , ['Password',$EncryptedPwrd] ])->exists();
        
        if($result==1){
            return 1;
        } else { return 0;}
    }

    public function SavePwrdFunc(Request $PasswordDetails){
        $ChildId=session()->get('SessionChildId');
        //dd($ChildId);
        $ChildName=session()->get('SessionChildName'); 
        $EncryptNewPwrd=sha1($PasswordDetails->NewPwrd);
        var_dump($PasswordDetails->NewPwrd);
        var_dump($EncryptNewPwrd);
        //dd();
        DB::table('new__account__creatings')->where('ChildId',$ChildId)->update(
            ['RawPassword'=>$PasswordDetails->NewPwrd , 'Password'=>$EncryptNewPwrd]  );
        return redirect("Child/CPwrd");
    }




}
