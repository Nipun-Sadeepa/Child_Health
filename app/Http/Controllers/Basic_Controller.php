<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Basic_Controller extends Controller
{
    public function Login(Request $credentials){

       // dd($credentials-> all());
       $EncryptPassword=sha1($credentials->pwrd);
       $ChildCredential=DB::table('new__account__creatings')->where([ ['ChildId',$credentials->LoginId],['Password',$EncryptPassword] ])->get();
       $MidWifeCredential=DB::table('mid_wife_details')->where([ ['MidWifeId',$credentials->LoginId],['Password',$EncryptPassword],['AdminPromoted',0] ])->get();
       $AdminMidWifeCredential=DB::table('mid_wife_details')->where([ ['MidWifeId',$credentials->LoginId],['Password',$EncryptPassword],['AdminPromoted',1] ])->get();

       if(isset($ChildCredential[0])){
            $JsonChildCredential=json_decode($ChildCredential,true);
           //$JsonChildCredential=json_decode($ChildCredential);
           session()->put('SessionChildId',$JsonChildCredential[0]['ChildId']);
           session()->put('SessionChildName',$JsonChildCredential[0]['InitializedName']);
           return redirect('Child');
       }
       else if(isset($MidWifeCredential[0])){
            $JsonMidWifeCredential=json_decode($MidWifeCredential,true);
            session()->put('SessionMidWifeId',$JsonMidWifeCredential[0]['MidWifeId']);
            session()->put('SessionMidWifeName',$JsonMidWifeCredential[0]['InitializedName']); 
        	return redirect('MidWife');
        }
        else if(isset($AdminMidWifeCredential[0])){
            $JsonAdminMidWifeCredential=json_decode($AdminMidWifeCredential,true);
            session()->put('SessionAdminMidWifeId',$JsonAdminMidWifeCredential[0]['MidWifeId']);
            session()->put('SessionAdminMidWifeName',$JsonAdminMidWifeCredential[0]['InitializedName']);
            session()->put('SessionMidWifeId',$JsonAdminMidWifeCredential[0]['MidWifeId']);
            session()->put('SessionMidWifeName',$JsonAdminMidWifeCredential[0]['InitializedName']);
        	return redirect('AdminMidWife');
        }else {
            //dd('not found');
            $ErrorMessage='Entered login credentials were not matched. Please try again with correct credentials';
            return view('Login')->with('Error',$ErrorMessage);
        }
        


    }
}
