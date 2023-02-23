<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\New_Account_Creating;
use App\Child_Routine_data;
use App\ChildBirthInfo;
use App\mid_wife_detail;
use App\Bug;
use App\AMWSendMessage;



class Admin_MidWife_Controller extends Controller
{

    public function MWShowBasic(){
        $AdminMidWifeId=session()->get('SessionAdminMidWifeId');
        $AdminMidWifeName=session()->get('SessionAdminMidWifeName');
        //print_r(session()->all());
        
        $AllMWDetails=DB::table('mid_wife_details')->select('MidWifeId', 'InitializedName', 'Area', 'RegisterdYear', 'RegisterdDistrict', 'NationalId' , 'ContactNo', 'Email', 'AMWId', 'created_at')->where('AdminPromoted','0')->latest()->get();
        return view('AdminMidWifePage')->with('MWBasicDetails',$AllMWDetails);
    }

    public function MWShowBasicWithMsg($fact,$factId){

        echo "<script>   if(typeof window.history.pushState == 'function') {
            window.history.pushState({}, 'Hide', 'http://127.0.0.1:8000/AdminMidWife'); } </script>";
        
        $AllMWDetails=DB::table('mid_wife_details')->select('MidWifeId', 'InitializedName', 'RegisterdYear', 'RegisterdDistrict', 'Area', 'NationalId' , 'ContactNo', 'Email', 'AMWId', 'created_at')->where('AdminPromoted','0')->latest()->get();
        
        // Categorize alert messages

        if($fact=='AMWSndEmail'){
            session()->forget('TempChildId');
            echo "<script> alert('$factId Numbered Child data saved and Email sent with their login credentials'); </script>";
        }else if($fact=='MWSndEmail'){
            session()->forget('TempMWId');
            echo "<script> alert('$factId Numbered Mid Wife's data saved and Email sent with their login credentials'); </script>";
        }else if($fact=='MWPromote'){
            echo "<script> alert('$factId Numbered Mid Wife was promoted'); </script>";
        }else if($fact=='AMWSndMsg'){
            if($factId=='AllMidWife'){
                echo "<script> alert('Notification sent to All Mid Wives'); </script>";
            }else{
                echo "<script> alert('Message sent to $factId Numbered Mid Wife'); </script>";
            }   
        }else if($fact=='AMWBug'){
            echo "<script> alert('Bug Reported'); </script>";
        }else if($fact=='AMWPwrd'){
            echo "<script> alert('Your password changed'); </script>";
        }else if($fact=='MWUpdated'){
            echo "<script> alert('$factId Numbered Mid Wife Details updated'); </script>";
        }

        return view('AdminMidWifePage')->with('MWBasicDetails',$AllMWDetails);
    }
    
    public function SearchMidWife(Request $Searchfacts){
        $AdminMidWifeId=session()->get('SessionAdminMidWifeId');
        $AdminMidWifeName=session()->get('SessionAdminMidWifeName');
        if( !empty($Searchfacts['MWId']) && empty($Searchfacts['AMWId']) ){
            $SearchigMWResult=DB::table('mid_wife_details')->select('MidWifeId', 'InitializedName', 'RegisterdYear', 'RegisterdDistrict', 'Area', 'NationalId' , 'ContactNo', 'Email', 'AMWId', 'created_at')->where([ ['AdminPromoted','0'], ['MidWifeId',$Searchfacts['MWId']] ])->get();
        }else if( !empty($Searchfacts['AMWId']) && empty($Searchfacts['MWId']) ){
            $SearchigMWResult=DB::table('mid_wife_details')->select('MidWifeId', 'InitializedName', 'RegisterdYear', 'RegisterdDistrict', 'Area', 'NationalId' , 'ContactNo', 'Email', 'AMWId', 'created_at')->where([ ['AdminPromoted','0'], ['AMWId',$Searchfacts['AMWId']] ])->get();
        }else if( !empty($Searchfacts['MWId']) && !empty($Searchfacts['AMWId']) ){
            $SearchigMWResult=DB::table('mid_wife_details')->select('MidWifeId', 'InitializedName', 'RegisterdYear', 'RegisterdDistrict', 'Area', 'NationalId' , 'ContactNo', 'Email', 'AMWId', 'created_at')->where([ ['AdminPromoted','0'], ['MidWifeId',$Searchfacts['MWId']], ['AMWId',$Searchfacts['AMWId']] ])->get();
        }
        return view('AdminMidWifePage')->with('SearchigMWResult',$SearchigMWResult);
    }

    public function MWMoreFunc($MWId){
        echo "<script>    
        if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, 'Hide', 'http://127.0.0.1:8000/MWMore'); } </script>";
        $SearchedMWDetails=DB::table('mid_wife_details')->select('MidWifeId', 'FullName', 'InitializedName', 'RegisterdYear', 'RegisterdDistrict', 'Area', 'NationalId' , 'PermanentAddress', 'ContactNo', 'Email', 'AMWId', 'AMWName', 'created_at')->where([ ['AdminPromoted','0'], ['MidWifeId',$MWId] ])->get();
        return view('AdminMidWifePage')->with('MWMoreDetails',$SearchedMWDetails);
    }

    public function MWUpdate($MWId) {
        echo "<script>    
        if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, 'Hide', 'http://127.0.0.1:8000/EditMW'); } </script>";
        $ToUpdateMWDetails=DB::table('mid_wife_details')->select('MidWifeId', 'FullName', 'InitializedName', 'Area', 'NationalId' , 'PermanentAddress', 'ContactNo', 'Email')->where([ ['AdminPromoted','0'], ['MidWifeId',$MWId] ])->get();
        return view('AdminMidWifePage')->with('ToUpdateMWDetails',$ToUpdateMWDetails);
    }
    
    public function SaveMWUpdatesFunc(Request $MWUpdatingDetails){
        //dd($MWUpdatingDetails->all());
        $AdminMidWifeId=session()->get('SessionAdminMidWifeId');
        $AdminMidWifeName=session()->get('SessionAdminMidWifeName');
        $CurrentTime=date('Y-m-d H:i:s');
        $Prev=json_decode($MWUpdatingDetails->MWPrevAll,true);

        if($Prev[0]['FullName']==$MWUpdatingDetails->FullName){ $PreviousFullName ="None";
        }else { $PreviousFullName=$Prev[0]['FullName'].'@'.$MWUpdatingDetails->FullName; }

        if($Prev[0]['InitializedName']==$MWUpdatingDetails->InitializedName){ $PreviousInitializedName ="None";
        }else { $PreviousInitializedName=$Prev[0]['InitializedName'].'@'.$MWUpdatingDetails->InitializedName; }

        if($Prev[0]['NationalId']==$MWUpdatingDetails->NationalId){ $PreviousNationalId ="None";
        }else { $PreviousNationalId=$Prev[0]['NationalId'].'@'.$MWUpdatingDetails->NationalId; }

        if($Prev[0]['Area']==$MWUpdatingDetails->Area){ $PreviousArea ="None";
        }else { $PreviousArea=$Prev[0]['Area'].'@'.$MWUpdatingDetails->Area; }

        if($Prev[0]['PermanentAddress']==$MWUpdatingDetails->PermanentAddress){ $PreviousAddress ="None";
        }else { $PreviousAddress=$Prev[0]['Address'].'@'.$MWUpdatingDetails->PermanentAddress; }

        if($Prev[0]['ContactNo']==$MWUpdatingDetails->ContactNo){ $PreviousContactNo ="None";
        }else { $PreviousContactNo=$Prev[0]['ContactNo'].'@'.$MWUpdatingDetails->ContactNo; }

        if($Prev[0]['Email']==$MWUpdatingDetails->Email){ $PreviousEmail ="None";
        }else { $PreviousEmail=$Prev[0]['Email'].'@'.$MWUpdatingDetails->Email; }
        
        DB::table('m_w_updating_infos')->insert([ ['MidWifeId'=>$MWUpdatingDetails->MidWifeId, 'FullName'=>$PreviousFullName, 
        'InitializedName'=>$PreviousInitializedName , 'PermanentAddress'=>$PreviousAddress , 'Area'=>$PreviousArea, 'NationalId'=>$PreviousNationalId ,
        'ContactNo'=>$PreviousContactNo , 'Email'=>$PreviousEmail , 'AMWId'=>$AdminMidWifeId, 'AMWName'=>$AdminMidWifeName, 'Date'=>$CurrentTime ] ]);
        

        DB::table('mid_wife_details')->where('MidWifeId',$MWUpdatingDetails->MidWifeId)->update(
            [ 'FullName'=>$MWUpdatingDetails->FullName , 'InitializedName'=>$MWUpdatingDetails->InitializedName , 'NationalId'=>$MWUpdatingDetails->NationalId , 'Area'=>$MWUpdatingDetails->Area,
            'PermanentAddress'=>$MWUpdatingDetails->PermanentAddress , 'ContactNo'=>$MWUpdatingDetails->ContactNo , 'Email'=>$MWUpdatingDetails->Email , 'updated_at'=>$CurrentTime ]
        );

        $fact2=$MWUpdatingDetails->MidWifeId;
        return redirect("AdminMidWife/MWUpdated/$fact2");
    }
    
    public function AMWSendMessage(Request $AMWSendMsgDetails){
        //dd($AMWSendMsgDetails->AMWClient);
        $AdminMidWifeId=session()->get('SessionAdminMidWifeId');
        $AdminMidWifeName=session()->get('SessionAdminMidWifeName');
        $AMWSendMsgObj= new AMWSendMessage;
        
        $AMWSendMsgObj->AMWClient= $AMWSendMsgDetails->AMWClient;
        $AMWSendMsgObj->Subject= $AMWSendMsgDetails->Subject;
        $AMWSendMsgObj->Message= $AMWSendMsgDetails->Message;
         
        if(isset($AMWSendMsgDetails->Date)){
            $AMWSendMsgObj->ScheduledDate= $AMWSendMsgDetails->Date; 
        }
        
        if(isset($AMWSendMsgDetails->Time)){
            $AMWSendMsgObj->ScheduledTime= $AMWSendMsgDetails->Time; 
        }
        
        if(isset($AMWSendMsgDetails->Venue)){
            $AMWSendMsgObj->ScheduledVenue= $AMWSendMsgDetails->Venue; 
        }
        $AMWSendMsgObj->AMWId = $AdminMidWifeId;
        $AMWSendMsgObj->AMWName = $AdminMidWifeName;

        $AMWSendMsgObj->save();

        $fact2=$AMWSendMsgDetails->AMWClient;
        return redirect("AdminMidWife/AMWSndMsg/$fact2");
    }

    public function MWPromoteFunc($MWId){
        $AdminMidWifeId=session()->get('SessionAdminMidWifeId');
        $AdminMidWifeName=session()->get('SessionAdminMidWifeName');
        $time=date('Y-m-d H:i:s');

        DB::table('mid_wife_details')->updateOrInsert( 
            ['MidWifeId'=>$MWId , 'AdminPromoted'=>0] , 
            ['AdminPromoted'=>1, 'PromotedDate'=>$time, 'PromotedAMWId'=>$AdminMidWifeId,  'PromotedAMWName'=>$AdminMidWifeName ]
        );
        return redirect("AdminMidWife/MWPromote/$MWId");
    }



    public function ChildDetailsSaving(Request $AccDetails){
        $New_Account_obj = new New_Account_Creating;
        $ChildBirthInfoObj= new ChildBirthInfo;
        $ClinicFirstObj=new Child_Routine_data;
        

        $AdminMidWifeId=session()->get('SessionAdminMidWifeId');
        $AdminMidWifeName=session()->get('SessionAdminMidWifeName');
        

        //Creating Id by getting Registered Date
            $DistrictShort=substr($AccDetails->District,0,3);
            $BirthDate=$AccDetails->BirthDateAndTime;
            $explodedBirthDate=explode("-",$BirthDate);
            $explodedTime=explode("T",$explodedBirthDate[2]);
            $explodedYear=$explodedBirthDate[0];
            $explodedYearFinal=substr($explodedYear,2,3);
            $explodedMonth=$explodedBirthDate[1];
            $explodedMonthInt=(int)$explodedMonth;
            $explodedDate=$explodedTime[0];

            $MonthValueArray=[1=>0,2=>31,3=>59,4=>90,5=>120,6=>151,7=>181,8=>212,9=>243,10=>273,11=>304,12=>334];
            $DaysThatMonth=$MonthValueArray[$explodedMonthInt];
            $CountedAllDays=$DaysThatMonth+$explodedDate;

                if($CountedAllDays<100){
                    $CountedDays=$explodedYearFinal.'0'.($CountedAllDays);  
                }else{
                    $CountedDays=$explodedYearFinal.''.($CountedAllDays);
                }
               
            $searchingId=DB::table('new__account__creatings')->where([ ['District',$DistrictShort], ['Days',$CountedDays] ])->max('Id');
    
            if(isset($searchingId)){  
                $LengthGap=strlen($searchingId)-strlen(((int)$searchingId)+1);
                $NumOfZeros=str_repeat("0",$LengthGap);
                $InsertingId=$NumOfZeros.''.(((int)$searchingId)+1);
                //echo ('<br>Insertin Id is : '.$InsertingId);
                $FinalId=$CountedDays.''.$DistrictShort.'@'.$InsertingId;
                //echo ('<br>Final Id is : '.$FinalId);
            }else{
                $InsertingId='0001';
                $FinalId=$CountedDays.''.$DistrictShort.'@'.$InsertingId;
                //echo ('<br>Final Id is : '.$FinalId);
            }
        $Password=(rand(10,1000));
        $EncryptedPassword=sha1($Password); 

        $New_Account_obj->ChildId = $FinalId;
        $New_Account_obj->Id = $InsertingId;
        $New_Account_obj->Days = $CountedDays;
        $New_Account_obj->FullName = $AccDetails -> FullName;
        $New_Account_obj->InitializedName = $AccDetails -> Name;
        $New_Account_obj->BirthDate_Time = $AccDetails -> BirthDateAndTime;
        $New_Account_obj->Address = $AccDetails->Address;
        $New_Account_obj->District = $AccDetails->District;
        $New_Account_obj->Area = $AccDetails -> Area;
        $New_Account_obj->MotherName = $AccDetails -> MotherName;
        $New_Account_obj->FatherName = $AccDetails -> FatherName;
        $New_Account_obj->Email = $AccDetails -> Email;
        $New_Account_obj->ContactNo = $AccDetails -> ContactNo;
        $New_Account_obj->AMWId = $AdminMidWifeId;
        $New_Account_obj->AMWName = $AdminMidWifeName;
        $New_Account_obj->RawPassword = $Password;
        $New_Account_obj->Password = $EncryptedPassword;




        $ChildBirthInfoObj->BChildId= $FinalId;
        $ChildBirthInfoObj->WeightInKg= $AccDetails->WeightInKg;
        $ChildBirthInfoObj->WeightInG= $AccDetails->WeightInG;
        $ChildBirthInfoObj->Height= $AccDetails->Height;
        $ChildBirthInfoObj->Perimeter= $AccDetails->Perimeter;
        $ChildBirthInfoObj->Hospital= $AccDetails->Hospital;
        $ChildBirthInfoObj->BirthDate= $AccDetails -> BirthDateAndTime;
        $ChildBirthInfoObj->DeliveredType= $AccDetails->DeliveredType;
        $ChildBirthInfoObj->Apga1= $AccDetails->Apga1;
        $ChildBirthInfoObj->Apga5= $AccDetails->Apga5;
        $ChildBirthInfoObj->Apga10= $AccDetails->Apga10;
        $ChildBirthInfoObj->VitaminK= $AccDetails->VitaminK;
        $ChildBirthInfoObj->Milk= $AccDetails->Milk;
        $ChildBirthInfoObj->Sthapitaya= $AccDetails->Establish;
        $ChildBirthInfoObj->Connection= $AccDetails->Connection;
        $ChildBirthInfoObj->Test= $AccDetails->Test;
        $ChildBirthInfoObj->BCG= $AccDetails->BCG;
        $ChildBirthInfoObj->SkinColor= $AccDetails->SkinColor;
        $ChildBirthInfoObj->Eyes= $AccDetails->Eyes;
        $ChildBirthInfoObj->Pekaniya= $AccDetails->Pekaniya;
        $ChildBirthInfoObj->Temperature= $AccDetails->Temperature;
        $ChildBirthInfoObj->AMWId = $AdminMidWifeId;
        $ChildBirthInfoObj->AMWName = $AdminMidWifeName;


        $ClinicFirstObj->ChildId= $FinalId;
        $ClinicFirstObj->ClinicNo= 0;
        $ClinicFirstObj->WeightInKg=$AccDetails->WeightInKg;
        $ClinicFirstObj->WeightInG=$AccDetails->WeightInG;
        $ClinicFirstObj->Height=$AccDetails->Height;
        $ClinicFirstObj->HeadPerimeter=$AccDetails->Perimeter;
        $ClinicFirstObj->MWId= $AdminMidWifeId;
        $ClinicFirstObj->MWName= $AdminMidWifeName;

        $ChildBirthInfoObj->save();
        $New_Account_obj->save();
        $ClinicFirstObj->save();
        

        session()->put('TempChildId',$FinalId);
        session()->put('TempChildName',$AccDetails->Name);
        session()->put('TempChildEmail',$AccDetails->Email);
        session()->put('TempChildPwrd',$Password);
        
        return redirect('SendChildCredentials');
    }

    public function MidWifeDetailsSaving(Request $MidWifeDetails){
        //dd($MidWifeDetails->all());
        $MidWifeObj=new mid_wife_detail;
       
        $AdminMidWifeId=session()->get('SessionAdminMidWifeId');
        $AdminMidWifeName=session()->get('SessionAdminMidWifeName');

        $explodedMonth=explode('-',$MidWifeDetails -> RegisterdMonth );
        $DistrictShort=substr($MidWifeDetails->RegisterdDistrict,0,3);
        $YearShort=substr($explodedMonth[0],2,4);
        //echo "Month is : ".$explodedMonth[1];
        $MonthShort=$explodedMonth[1];
        $YearMonth=$YearShort."".$MonthShort;
        //echo "<br>Year & Month is : ".$YearMonth;
       
        $searchingId=DB::table('mid_wife_details')->where([ ['RegisterdDistrict',$MidWifeDetails->RegisterdDistrict], ['RegisterdYear',$YearMonth] ])->max('Id');
        
        if(isset($searchingId)){
            $LengthGap=strlen($searchingId)-strlen(((int)$searchingId)+1);
            $NumOfZeros=str_repeat("0",$LengthGap);
            //echo '<br>Number of zeros is : '.$NumOfZeros;
            $InsertingId=$NumOfZeros.''.(((int)$searchingId)+1);
            //echo ('<br>Insertin Id is : '.$InsertingId);
            $NewUniqueId=$YearMonth."".$DistrictShort."@".$InsertingId;
            //echo '<br>NewUniqueId is : '. $NewUniqueId;
        }else{
            $InsertingId='0001';
            $NewUniqueId=$YearMonth."".$DistrictShort."@".$InsertingId;
            //echo ('<br>Final Id is : '.$NewUniqueId);
        }

        $Password=(rand(10,1000));
        $EncryptedPassword=sha1($Password);

        session()->put('TempMWId',$NewUniqueId);
        session()->put('TempMWName',$MidWifeDetails->Name);
        session()->put('TempMWEmail',$MidWifeDetails->Email);
        session()->put('TempMWPwrd',$Password);
        
        $MidWifeObj->MidWifeId = $NewUniqueId;
        $MidWifeObj->Id = $InsertingId;
        $MidWifeObj->RegisterdYear = $YearMonth;
        $MidWifeObj->RegisterdDistrict = $MidWifeDetails -> RegisterdDistrict;
        $MidWifeObj->FullName = $MidWifeDetails -> FullName;
        $MidWifeObj->InitializedName = $MidWifeDetails -> Name;
        $MidWifeObj->NationalId = $MidWifeDetails -> NationalId;
        $MidWifeObj->PermanentAddress = $MidWifeDetails -> Address;
        $MidWifeObj->Area = $MidWifeDetails -> Area;
        $MidWifeObj->ContactNo = $MidWifeDetails -> ContactNo;
        $MidWifeObj->Email = $MidWifeDetails -> Email;
        $MidWifeObj->RawPassword = $Password;
        $MidWifeObj->Password = $EncryptedPassword;
        $MidWifeObj->AMWId = $AdminMidWifeId;
        $MidWifeObj->AMWName = $AdminMidWifeName;
        
        $MidWifeObj->save();

        
        
        return redirect("SendMWCredentials");
    }

    public function AMWProfile(){
        $AdminMidWifeId=session()->get('SessionAdminMidWifeId');
        $AdminMidWifeName=session()->get('SessionAdminMidWifeName');

        $results=DB::table('mid_wife_details')->where('MidWifeId',$AdminMidWifeId)->select('MidWifeId', 'FullName', 'InitializedName', 'Area', 'NationalId', 'RegisterdYear', 'RegisterdDistrict', 'PermanentAddress', 'ContactNo', 'Email', 'created_at', 'AMWId', 'AMWName', 'AdminPromoted', 'PromotedDate', 'PromotedAMWId')->get();
        return view('AdminMidWifePage')->with('AMWProfileDetails',$results);
    
    }

    public function AdminMidWifeBugs(Request $AMWBugDetails){
        $AdminMidWifeId=session()->get('SessionAdminMidWifeId');
        $AdminMidWifeName=session()->get('SessionAdminMidWifeName');
        $AMWBugObjects= new Bug;

        $AMWBugObjects->Bug=$AMWBugDetails->Message;
        $AMWBugObjects->CreatorId = $AdminMidWifeId;
        $AMWBugObjects->CreatorName = $AdminMidWifeName;
        if(isset($AMWBugDetails->MWBugModel)){
            $AMWBugObjects->BugModel=$AMWBugDetails->MWBugModel;
        }
        $AMWBugObjects->save();

        return redirect("AdminMidWife/AMWBug/Bug");

    }

    public function CheckPwrdFunc($pwrd){
        $AdminMidWifeId=session()->get('SessionAdminMidWifeId');
        $AdminMidWifeName=session()->get('SessionAdminMidWifeName');
        $EncryptedPwrd=sha1($pwrd);
    
        $result=DB::table('mid_wife_details')->where([ ['MidWifeId',$AdminMidWifeId] , ['Password',$EncryptedPwrd] ])->exists();
        
        if($result==1){
            return 1;
        } else { return 0;}
    }

    public function SavePwrdFunc(Request $PasswordDetails){
        $AdminMidWifeId=session()->get('SessionAdminMidWifeId');
        $AdminMidWifeName=session()->get('SessionAdminMidWifeName'); 
        $EncryptNewPwrd=sha1($PasswordDetails->NewPwrd);

        DB::table('mid_wife_details')->where('MidWifeId',$AdminMidWifeId)->update(
            ['RawPassword'=>$PasswordDetails->NewPwrd , 'Password'=>$EncryptNewPwrd]  );
        return redirect("AdminMidWife/AMWPwrd/set");
    }
    

}
