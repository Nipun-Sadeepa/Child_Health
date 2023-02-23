<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class TestController extends Controller
{

public function Encrypt(){
    //$password=(rand(10,1000));
    $password=12345;
    $EncryptedPassword=sha1($password);
    echo $password; echo "<br>";
    echo $EncryptedPassword; echo "<br>";
    $time=date('Y-m-d H:i:s');
    echo "time is : ".$time;

}

    public function Explode(Request $req){
        echo "time is : ".$req->BirthDateAndTime.'<br>';
        $str=$req->BirthDateAndTime;
        print_r (explode("-",$str));
        $explodedBirthDate=explode("-",$str);
        echo '<br>';
        //echo $explodedBirthDate[2];
        $explodedTime=explode("T",$explodedBirthDate[2]);
        //print_r($explodedTime);
        
        $explodedYear=$explodedBirthDate[0];
        $explodedYearFinal=substr($explodedYear,2,3);
        $explodedMonth=$explodedBirthDate[1];
        $explodedMonthInt=(int)$explodedMonth;
        $explodedDate=$explodedTime[0];
        
        //echo '<br> int is : '.$x;
        
        
        echo '<br> date is : '.$explodedDate.'and year final is : '.$explodedYearFinal;

        $MonthValueArray=[1=>0,2=>31,3=>59,4=>90,5=>120,6=>151,7=>181,8=>212,9=>243,10=>273,11=>304,12=>334];
        $DaysThatMonth=$MonthValueArray[$explodedMonthInt];
        echo '<br> days is : '.$DaysThatMonth;
        $CountedAllDays=$DaysThatMonth+$explodedDate;
        echo '<br> All days is : '.$CountedAllDays;
        if($CountedAllDays<100){
            $Id=$explodedYearFinal.'0'.($CountedAllDays);  
        }else{
            $Id=$explodedYearFinal.''.($CountedAllDays);
        }
        
        echo '<br> id is : '.$Id;
        // $x=array_key_exists($explodedMonthInt,$MonthValueArray);
        // echo '<br> x is : '.$x;
        
    }

    public function SinhalaTest(){
        $result=DB::table('sinhala_test')->get();
        print_r($result);
        return view('Test')->with('got',$result);
    }

    public function Redirect(){
        $arr= array();
        $arr[0]='amma'; $arr[1]='tatta'; $arr[2]='aiya';
        $x="lol";
        session()->put('we',$arr);
        return redirect("RetreiveRedirect/{$x}");
        // single bracket tried, dual bracket tried,
        //return redirect()->route('RetreiveRedirect',$arr); 
    }

    public function CheckExistQuery(){
        $a='799';
        $ChildId='19138Mat@0001';
        $b='sd';
        echo "came";
        //$result=DB::table('new__account__creatings')->where('ChildId',$ChildId)->exists();
        
        $result=DB::table('new__account__creatings')->where([ ['ChildId',$ChildId] , ['RawPassword',$b] ])->exists();
        if($result==1){
            echo "ok";
        }else echo "faks";
        //echo $result;

    }



}
