<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Child_Routine_Data;

use App\ChildVaccination;
use App\MW_Send_Message;
use App\Bug;

class MidWife_Controller extends Controller
{

    public function ShowBasic(){
        $MidWifeId=session()->get('SessionMidWifeId');
        $MidWifeName=session()->get('SessionMidWifeName');
        
        $AllChildDetails=DB::table('new__account__creatings')->select('ChildId', 'InitializedName', 'BirthDate_Time', 'Area' , 'MotherName', 'FatherName' , 'Email', 'ContactNo', 'AMWId', 'created_at')->latest()->get();
        return view('MidWifePage')->with('ChildDetails',$AllChildDetails); 
    }

    public function ShowBasicWithMsg($fact,$factId){
        $MidWifeId=session()->get('SessionMidWifeId');
        $MidWifeName=session()->get('SessionMidWifeName');

        echo "<script>   if(typeof window.history.pushState == 'function') {
            window.history.pushState({}, 'Hide', 'http://127.0.0.1:8000/MidWife'); } </script>";
        
        $AllChildDetails=DB::table('new__account__creatings')->select('ChildId', 'InitializedName', 'BirthDate_Time', 'Area' , 'MotherName', 'FatherName' , 'Email', 'ContactNo', 'AMWId', 'created_at')->latest()->get();
        
        // Categorizing Messages
        if($fact=='ClinicDataSave'){
            echo "<script> alert('Clinic Data of $factId Numbered Child was saved'); </script>";
        }else if($fact=='VaccineSave'){
            echo "<script> alert('Vaccination Data of $factId Numbered Child was saved'); </script>";
        }else if($fact=='MWMsgSave'){
            if($factId=='AllChild'){
                echo "<script> alert('Notification sent to All Child'); </script>";
            }else{
                echo "<script> alert('Message sent to $factId Numbered Child'); </script>";
            }  
        }else if($fact=='MWBug'){
            echo "<script> alert('Bug Reported'); </script>";
        }else if($fact=='MWPwrd'){
            echo "<script> alert('Your password changed'); </script>";
        }else if($fact=='ChildUpdated'){
            echo "<script> alert('$factId Numbered Child data updated'); </script>";
        }
        
        return view('MidWifePage')->with('ChildDetails',$AllChildDetails); 
    }
    

    public function SearchChild(Request $Searchfacts){

        if( !empty($Searchfacts['Id']) && empty($Searchfacts['Area']) ){
            $SearchigResult=DB::table('new__account__creatings')->select('ChildId', 'InitializedName', 'BirthDate_Time', 'Area', 'MotherName', 'FatherName' , 'Email', 'ContactNo', 'AMWId', 'created_at')->where('ChildId',$Searchfacts['Id'])->get();
        }else if( !empty($Searchfacts['Area']) && empty($Searchfacts['Id']) ){
            $SearchigResult=DB::table('new__account__creatings')->select('ChildId', 'InitializedName', 'BirthDate_Time', 'Area', 'MotherName', 'FatherName' , 'Email', 'ContactNo', 'AMWId', 'created_at')->where('Area',$Searchfacts['Area'])->get();
        }else if( !empty($Searchfacts['Id']) && !empty($Searchfacts['Area']) ){
            $SearchigResult=DB::table('new__account__creatings')->select('ChildId', 'InitializedName', 'BirthDate_Time', 'Area', 'MotherName', 'FatherName' , 'Email', 'ContactNo', 'AMWId', 'created_at')->where([ ['ChildId',$Searchfacts['Id']], ['Area',$Searchfacts['Area']] ])->get();
        }
        return view('MidWifePage')->with('SearchigResult',$SearchigResult);
    }

    public function ChildMoreFunc($ChildId){
        echo "<script>    
            if(typeof window.history.pushState == 'function') {
            window.history.pushState({}, 'Hide', 'http://127.0.0.1:8000/ChildMore'); } </script>";
        $result=DB::table('new__account__creatings')->Join('child_birth_infos', 'ChildId', '=', 'BChildId')->where('ChildId',$ChildId)->get();
        return view('MidWifePage')->with('ChildMoreDetails',$result);
    }

    public function ChildUpdate($ChildId){
        echo "<script>    
        if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, 'Hide', 'http://127.0.0.1:8000/EditChild'); } </script>";
        $ToUpdateCDetails=DB::table('new__account__creatings')->select('ChildId', 'FullName', 'InitializedName', 'Address' , 'Area', 'MotherName', 'FatherName', 'Email', 'ContactNo')->where('ChildId',$ChildId)->get();
        return view('MidWifePage')->with('ToUpdateCDetails',$ToUpdateCDetails);
    }

    public function SaveChildUpdatesFunc(Request $CUpdatingDetails){
        $MidWifeId=session()->get('SessionMidWifeId');
        $MidWifeName=session()->get('SessionMidWifeName');
        $CurrentTime=date('Y-m-d H:i:s');
        $Prev=json_decode($CUpdatingDetails->CPrevAll,true);

        if($Prev[0]['FullName']==$CUpdatingDetails->FullName){ $PreviousFullName ="None";
        }else { $PreviousFullName=$Prev[0]['FullName'].'@'.$CUpdatingDetails->FullName; }

        if($Prev[0]['InitializedName']==$CUpdatingDetails->InitializedName){ $PreviousInitializedName ="None";
        }else { $PreviousInitializedName=$Prev[0]['InitializedName'].'@'.$CUpdatingDetails->InitializedName; }

        if($Prev[0]['Address']==$CUpdatingDetails->Address){ $PreviousAddress ="None";
        }else { $PreviousAddress=$Prev[0]['Address'].'@'.$CUpdatingDetails->Address; }

        if($Prev[0]['Area']==$CUpdatingDetails->Area){ $PreviousArea ="None";
        }else { $PreviousArea=$Prev[0]['Area'].'@'.$CUpdatingDetails->Area; }

        if($Prev[0]['ContactNo']==$CUpdatingDetails->ContactNo){ $PreviousContactNo ="None";
        }else { $PreviousContactNo=$Prev[0]['ContactNo'].'@'.$CUpdatingDetails->ContactNo; }

        if($Prev[0]['Email']==$CUpdatingDetails->Email){ $PreviousEmail ="None";
        }else { $PreviousEmail=$Prev[0]['Email'].'@'.$CUpdatingDetails->Email; }

        if($Prev[0]['MotherName']==$CUpdatingDetails->MotherName){ $PreviousMotherName ="None";
        }else { $PreviousMotherName=$Prev[0]['MotherName'].'@'.$CUpdatingDetails->MotherName; }

        if($Prev[0]['FatherName']==$CUpdatingDetails->FatherName){ $PreviousFatherName ="None";
        }else { $PreviousFatherName=$Prev[0]['FatherName'].'@'.$CUpdatingDetails->FatherName; }
        
        DB::table('new__account__creatings')->where('ChildId',$CUpdatingDetails->ChildId)->update(
            [ 'FullName'=>$CUpdatingDetails->FullName , 'InitializedName'=>$CUpdatingDetails->InitializedName , 'Address'=>$CUpdatingDetails->Address ,
            'Area'=>$CUpdatingDetails->Area , 'ContactNo'=>$CUpdatingDetails->ContactNo , 'Email'=>$CUpdatingDetails->Email ,
            'MotherName'=>$CUpdatingDetails->MotherName, 'FatherName'=>$CUpdatingDetails->FatherName , 'updated_at'=>$CurrentTime]
        );

        DB::table('child_updating_infos')->insert([ ['ChildId'=>$CUpdatingDetails->ChildId, 'FullName'=>$PreviousFullName, 
        'InitializedName'=>$PreviousInitializedName , 'Address'=>$PreviousAddress ,'Area'=>$PreviousArea , 
        'ContactNo'=>$PreviousContactNo , 'Email'=>$PreviousEmail , 'MotherName'=>$PreviousMotherName, 'FatherName'=>$PreviousFatherName,
        'MWId'=>$MidWifeId, 'MWName'=>$MidWifeName,  'Date'=>$CurrentTime ] ]);

        $fact2=$CUpdatingDetails->ChildId;
        return redirect("MidWife/ChildUpdated/$fact2");
    }

    public function SpecificChildClinicData($ChildId){
        echo "<script>    
            if(typeof window.history.pushState == 'function') {
            window.history.pushState({}, 'Hide', 'http://127.0.0.1:8000/AddClinicData'); } </script>";
        $result=DB::table('Child__routine_datas')->where('ChildId',$ChildId)->latest()->get();
        $results=json_decode($result,true);
        //dd($results);
        
        
        //dd($ClinicNo);
        if(empty($result[0])){
            $NextClinicNo=0;
            return view('MidWifePage')->with('ChildClinicSet','set')->with('ChildId',$ChildId)->with('NextClinicNo',$NextClinicNo); 
        }else{
            $NextClinicNo=$results[0]['ClinicNo']+1;
            return view('MidWifePage')->with('ChildClinicDetails',$result)->with('ChildClinicSet','set')->with('ChildId',$ChildId)->with('NextClinicNo',$NextClinicNo);
        }
    }   

    public function ChildRoutineSaving(Request $ChildRoutineDetails){
        //dd($ChildRoutineDetails->all());
        $ChildRoutine=new Child_Routine_Data;
        $MidWifeId=session()->get('SessionMidWifeId');
        $MidWifeName=session()->get('SessionMidWifeName');

        $ChildRoutine->ChildId= $ChildRoutineDetails->ChildId;
        $ChildRoutine->ClinicNo= $ChildRoutineDetails->ClinicNo;
        $ChildRoutine->WeightInKg= $ChildRoutineDetails->WeightInKg;
        $ChildRoutine->WeightInG= $ChildRoutineDetails->WeightInG;
        $ChildRoutine->Height= $ChildRoutineDetails->Height;
        $ChildRoutine->HeadPerimeter= $ChildRoutineDetails->Perimeter;
        $ChildRoutine->MWId = $MidWifeId;
        $ChildRoutine->MWName = $MidWifeName;
        $ChildRoutine->save();
        
        $Id=$ChildRoutineDetails->ChildId;
        //return redirect()->back();
        return redirect("MidWife/ClinicDataSave/$Id");
    }


    public function SpecificChildVaccination($ChildId){
        echo "<script>    
        if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, 'Hide', 'http://127.0.0.1:8000/AddVaccine'); } </script>";
        $result=DB::table('child_vaccinations')->where('ChildId',$ChildId)->latest()->get();
        if(empty($result[0])){
            //return view('MidWifePage')->with('ChildVaccineSet','set')->with('ChildVaccineDetails',$result);
            return view('MidWifePage')->with('ChildVaccineSet','set')->with('ChildId',$ChildId);  
        }else{
            return view('MidWifePage')->with('ChildVaccineSet','set')->with('ChildId',$ChildId)->with('ChildVaccineDetails',$result);
        }
    }

    public function ChildVaccination(Request $ChildVaccineDetails){
        $ChildVaccineObj= new ChildVaccination;
        $MidWifeId=session()->get('SessionMidWifeId');
        $MidWifeName=session()->get('SessionMidWifeName');

        //echo "Mid Wife Id is : ".$MidWifeId;
        $ChildVaccineObj->ChildId= $ChildVaccineDetails->ChildId;
        $ChildVaccineObj->Vaccine= $ChildVaccineDetails->Vaccine;
        $ChildVaccineObj->Vitamin= $ChildVaccineDetails->Vitamin;
        $ChildVaccineObj->MWId = $MidWifeId;
        $ChildVaccineObj->MWName = $MidWifeName;
        $ChildVaccineObj->save();

        $Id=$ChildVaccineDetails->ChildId;
        return redirect("MidWife/VaccineSave/$Id");
    }

    
    public function MidWifeSendMessage(Request $SendMessage){
        $MessageObj= new MW_Send_Message;
        $MidWifeId=session()->get('SessionMidWifeId');
        $MidWifeName=session()->get('SessionMidWifeName');
        
        $MessageObj->MWClient= $SendMessage->MWClient;
        $MessageObj->Subject= $SendMessage->Subject;
        $MessageObj->Message= $SendMessage->Message;
         
        if(isset($SendMessage->Date)){
            $MessageObj->ScheduledDate= $SendMessage->Date; 
        }
        
        if(isset($SendMessage->Time)){
            $MessageObj->ScheduledTime= $SendMessage->Time; 
        }
        
        if(isset($SendMessage->Venue)){
            $MessageObj->ScheduledVenue= $SendMessage->Venue; 
        }
        $MessageObj->MWId = $MidWifeId;
        $MessageObj->MWName = $MidWifeName;

        $MessageObj->save();
        $Id=$SendMessage->MWClient;
        return redirect("MidWife/MWMsgSave/$Id");
    }

    public function MWReceivedMessage(){
        $MidWifeId=session()->get('SessionMidWifeId');
        $AllMWRecvdMsg=DB::table('a_m_w_send_messages')->whereIn('AMWClient', ['AllMidWife',$MidWifeId])->latest()->get();
        //$MeRecvdMsg=DB::table('a_m_w_send_messages')->where('AMWClient',$MidWifeId)->latest()->get();
        
        return view('MidWifePage')->with('AllMWRecvdMsg',$AllMWRecvdMsg);
        //print_r($AMWRecvdMsg);
    }

    public function MWMyReceivedMessage(){
        $MidWifeId=session()->get('SessionMidWifeId');
        $MeRecvdMsg=DB::table('a_m_w_send_messages')->where('AMWClient',$MidWifeId)->latest()->get();
        
        return view('MidWifePage')->with('MWMyRecvdMsg',$MeRecvdMsg);
        //print_r($AMWRecvdMsg);
    }
    
    public function MWProfile(){
        $MidWifeId=session()->get('SessionMidWifeId');
        $MidWifeName=session()->get('SessionMidWifeName');

        $results=DB::table('mid_wife_details')->where('MidWifeId',$MidWifeId)->select('MidWifeId', 'FullName', 'InitializedName', 'NationalId', 'RegisterdYear', 'RegisterdDistrict', 'PermanentAddress', 'Area', 'ContactNo', 'Email', 'created_at', 'AMWId', 'AMWName', 'AdminPromoted', 'PromotedDate', 'PromotedAMWId', 'PromotedAMWName')->get();
        return view('MidWifePage')->with('MWProfileDetails',$results);
    
    }

    public function MidWifeBugs(Request $Bugs){
        $MWBugObjects= new Bug;
        $MidWifeId=session()->get('SessionMidWifeId');
        $MidWifeName=session()->get('SessionMidWifeName');

        $MWBugObjects->Bug=$Bugs->Message;
        $MWBugObjects->CreatorId = $MidWifeId;
        $MWBugObjects->CreatorName = $MidWifeName;
        if(isset($Bugs->MWBugModel)){
            $MWBugObjects->BugModel=$Bugs->MWBugModel;
        }
        $MWBugObjects->save();

        return redirect("MidWife/MWBug/Bug");
    }

    public function CheckPwrdFunc($pwrd){
        $MidWifeId=session()->get('SessionMidWifeId');
        $MidWifeName=session()->get('SessionMidWifeName');
        $EncryptedPwrd=sha1($pwrd);
    
        $result=DB::table('mid_wife_details')->where([ ['MidWifeId',$MidWifeId] , ['Password',$EncryptedPwrd] ])->exists();
        
        if($result==1){
            return 1;
        } else { return 0;}
    }
    
    public function SavePwrdFunc(Request $PasswordDetails){
        $MidWifeId=session()->get('SessionMidWifeId');
        $MidWifeName=session()->get('SessionMidWifeName');
        $EncryptNewPwrd=sha1($PasswordDetails->NewPwrd);

        DB::table('mid_wife_details')->where('MidWifeId',$MidWifeId)->update(
            ['RawPassword'=>$PasswordDetails->NewPwrd , 'Password'=>$EncryptNewPwrd]  );
       
        return redirect("MidWife/MWPwrd/set");
    }

}