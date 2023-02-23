<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Main Page</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script> 
    <script>
        $(document).ready(function(){

            $('#CurrentPwrd').change(function(){
                var Pwrd= $(this).val();
                //$.get("CheckPwrd",{Pwrd}, function(data,status){
                $.get("CCheckPwrd/"+Pwrd, function(data,status){
                    //console.log(data);
                    if(data==1){
                        $('.RightPwrd').removeClass('hidden');
                        $('#CurrentPwrd').addClass('hidden');
                        $('.PasswordError').addClass('hidden');
                        
                    }else{ 
                        $('.PasswordError').removeClass('hidden');    
                    }
                });
                
            });

        });
    </script>
   

    <style>

        a{
            font-weight:bold;
            text-decoration: none;
            padding: 10px 25px;
        }
        table{
            width:800px;
        }
        tr{
            text-align:center;
            height:40px;
        }
        th, td{
            text-align: center; 
            padding: 10px 30px; 
        }
        h2{
            text-align:center;
        }
        .btn-info{
            margin: 5px 10px;
            text-align:center;
        }
        .hidden{
            display: none;
        }
        p.PasswordError{
            color:red;
        }
        .BasicInfo p, .BirthInfo p{
            font-weight:bold;
            color:#78756f;
            font-size: 15px;
            margin-top: 20px;
        }
    </style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>



<div class="ChildTabs">
    <nav class="navbar navbar-default nav-justified navbar-fixed-top" style="height:60px;">
        <div class="container-fluid">
            <span class="hovering">
                <a href="Child" class="active">Home Page</a>
                <a href="BirthInfo" id="BirthInformation">Birth Information</a> 
                <a href="VaccinationInfo" id="Vaccinations">Vaccination Details</a>
                <a href="ClinicInfo" id="ClinicDetails">Clinic Details</a>
                <a href="ChildChart" id="Charts">Charts</a>
                <a href="CNotifications" id="Notifications">Notifications</a>
                <a href="CBugs" id="Bugs">Report Bugs</a>
                <a href="CChangePwrd" id="Pwrd">Change Password</a>
            </span>
                <button class="navbar-btn btn-danger"><a href="LogOut">Log Out</a></button>
        </div>
    </nav>
</div>  <!-- ChildTabs --> <br><br><br>
 

<h1 class="text-info">CHILDREN</h1> <br><br>

<div class="ChildAllContent">

    <div class="BasicInfo">
        @if(isset($BasicInfoDetails))
            @php $BasicInfo=json_decode($BasicInfoDetails,true); @endphp
            <h2 class="well">Basic Information Regarding to &nbsp;{{$Name}}</h2><br>
                <p>Full Name           : {{ $BasicInfo[0]['FullName'] }} </p>
                <p>Initialized Name    : {{ $BasicInfo[0]['InitializedName'] }} </p>
                <p>Id                  : {{ $BasicInfo[0]['ChildId'] }} </p>
                <p>Address             : {{ $BasicInfo[0]['Address'] }} </p>
                <p>District            : {{ $BasicInfo[0]['District'] }} </p>
                <p>Area                : {{ $BasicInfo[0]['Area'] }} </p>
                <p>Mother Name         : {{ $BasicInfo[0]['MotherName'] }} </p>
                <p>Father Name         : {{ $BasicInfo[0]['FatherName'] }} </p>
                <p>Guardian Email      : {{ $BasicInfo[0]['Email'] }} </p>
                <p>Guardian Contact No : {{ $BasicInfo[0]['ContactNo'] }} </p>
                <p>Registered Admin Mid Wife : {{ $BasicInfo[0]['AMWName'] }} ( {{ $BasicInfo[0]['AMWId'] }} ) </p>
                <p>Registered Date : {{ $BasicInfo[0]['created_at'] }} </p>

        @endif    
    </div><!-- BasicInfo -->



    <div class="BirthInfo">
        @if(isset($BirthInfoDetails))
            @php $BirthInfo=json_decode($BirthInfoDetails,true); 
            $BirthDateBrake=explode(' ',$BirthInfo[0]['BirthDate']);
            $ExplodedBirthDate=$BirthDateBrake[0];
            $ExplodedBirthTime=$BirthDateBrake[1];
            @endphp
            
            <h2 class="well" >Birth Details regarding to &nbsp; {{$Name}}</h2><br>

            <p>Id                         : {{ $BirthInfo[0]['BChildId'] }} </p>
            <p>Birth Date                 : {{ $ExplodedBirthDate }} </p>
            <p>Birth Time                 : {{ $ExplodedBirthTime }} </p>
            <p>Weight At Birth            : {{ $BirthInfo[0]['WeightInKg'] }} Kg  {{ $BirthInfo[0]['WeightInG'] }} g </p>
            <p>Height At Birth            : {{ $BirthInfo[0]['Height'] }} cm</p>
            <p>Head Perimeter At Birth    : {{ $BirthInfo[0]['Perimeter'] }} cm</p>
            <p>Hospital                   : {{ $BirthInfo[0]['Hospital'] }} </p>
            <p>Baby Delivered Method      : {{ $BirthInfo[0]['DeliveredType'] }} </p>

            <lable> Apga count :
            <table class="table-bordered table-hover table-responsive">
                <tr class="info">
                    <th>In first Minute</th> <th>In first 5 Minute</th> <th>In first 10 Minute</th>
                </tr>
                <tr>
                    <td> {{ $BirthInfo[0]['Apga1'] }} </td> 
                    <td> {{ $BirthInfo[0]['Apga5'] }} </td> 
                    <td> {{ $BirthInfo[0]['Apga10'] }} </td>
                </tr>
            </table> </lable> <br>

            <lable> Breast Milk :
            <table class="table-bordered table-hover">
                <tr class="info">
                    <th>Breast Milk in First Hour</th> <th>Sthapitaya</th> <th>Connection</th>
                </tr>
                <tr>
                    <td> {{ $BirthInfo[0]['Milk'] }} </td> 
                    <td> {{ $BirthInfo[0]['Sthapitaya'] }} </td> 
                    <td> {{ $BirthInfo[0]['Connection'] }} </td>
                </tr>
            </table> </lable>

            
            <p>Vitamin K        : {{ $BirthInfo[0]['VitaminK'] }} </p>
            <p>Test for Lede    : {{ $BirthInfo[0]['Test'] }} </p>
            <p>B.C.G.           : {{ $BirthInfo[0]['BCG'] }} </p>
            <p>Skin Color       : {{ $BirthInfo[0]['SkinColor'] }} </p>
            <p>Eye              : {{ $BirthInfo[0]['Eyes'] }} </p>
            <p>Pekaniya         : {{ $BirthInfo[0]['Pekaniya'] }} </p>
            <p>Temperature      : {{ $BirthInfo[0]['Temperature'] }} </p>
            <p>Registered Admin Mid Wife : {{ $BirthInfo[0]['AMWName'] }} ( {{ $BirthInfo[0]['AMWId'] }} ) </p>
            <p>Registered Date  : {{ $BirthInfo[0]['created_at'] }} </p>
        @endif
    </div><!-- BirthInfo -->



    <div class="VaccinationInfo">
        @if(isset($VaccineDetails))
            @php $VaccinationInfo=json_decode($VaccineDetails,true); @endphp
            
            <h2 class="well">Vaccination Details regarding to &nbsp; {{$Name}} </h2><br>
            @if(empty($VaccineDetails[0]))
                <p class="Error">There is No Previous Vaccinations Details regading to you</p>
            @else
                
                <table class="table-bordered table-hover table-striped table-responsive">
                    <tr>
                        <th>Vaccine Name</th> <th>Vitamin Name</th> <th>Vaccinated Date</th> <th>Mid Wife Id</th>
                    </tr> 
                        
                        @foreach($VaccinationInfo as $temp)
                            <tr>
                            <td> {{$temp['Vaccine']}} </td>
                            <td> @if($temp['Vitamin']=='Null')
                                        Not Given
                                    @else   {{$temp['Vitamin']}}  
                                    @endif
                            </td>
                            <td> {{$temp['created_at']}} </td>
                            <td> {{ $temp['MWName'] }} ( {{ $temp['MWId'] }} ) </td>
                            </tr>
                        @endforeach
                        
                    
                </table> <br>
            @endif
        @endif
    </div><!-- VaccinationInfo -->



    <div class="ClinicInfo">
        @if(isset($ClinicDetails))
            @php $ClinicInfo=json_decode($ClinicDetails,true); @endphp

            <h2 class="well" >Clinic Details regarding to &nbsp; {{$Name }}</h2><br>
            @if(empty($ClinicDetails[0]))
                <p class="Error">There is No Previous Clinic Details regading to you</p>
            @else
                <table class="table-bordered table-hover table-striped table-responsive">
                    <tr>
                        <th>Clinic No</th> <th>Weight</th> <th>Height</th> <th>Head Perimeter</th> <th>Mid Wife</th> <th>Clinic Date</th>  
                    </tr>

                    @foreach($ClinicInfo as $temp)
                        <tr>
                            <td> {{ $temp['ClinicNo'] }} </td>
                            <td> {{ $temp['WeightInKg'] }} &nbsp; Kg &nbsp; {{ $temp['WeightInG'] }} &nbsp; g </td>
                            <td> {{ $temp['Height'] }} &nbsp; cm </td>
                            <td> {{ $temp['HeadPerimeter'] }} &nbsp; cm </td>
                            <td> {{ $temp['MWName'] }} ( {{ $temp['MWId'] }}  )</td>
                            <td> {{ $temp['created_at'] }} </td>
                        </tr>
                    @endforeach

                </table>
            @endif
        @endif
    </div><!-- ClinicInfo -->


    
    <div class="Notifications">

        <div class="AllNotifications">
            @if(isset($NotificationDetails))
                @php   $ChildNotifications=json_decode($NotificationDetails,true); @endphp
                <h2 class="well" >All Notifications</h2><br>
                <button class="btn-info"><a href="MyMessage">Messages For Me</a></button><br><br>
                @if(empty($NotificationDetails[0]))
                    <p class="Error">There is No Any Message for you</p>
                @else
                    @foreach($ChildNotifications as $temp)
                        <div class="OneofAllMessage" id="{{$temp['Id']}}" style="border:1px solid;"> 
                            <p>Subject of Message : {{ $temp['Subject'] }}</p>
                            <p>{{ $temp['Message'] }}</p>
                            <p> Scheduled Date  : @if( empty($temp['ScheduledDate']) )  Not Mentioned 
                                                @else {{ $temp['ScheduledDate'] }}   @endif   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Scheduled Time  : @if( empty($temp['ScheduledTime']) )  Not Mentioned 
                                                @else {{ $temp['ScheduledTime'] }}   @endif &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Scheduled Venue : @if( empty($temp['ScheduledVenue']) )  Not Mentioned 
                                                @else {{ $temp['ScheduledVenue'] }}   @endif &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </p>
                            <p> Send By : {{ $temp['MWName'] }} ( {{ $temp['MWId'] }} ) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Sended On : {{ $temp['created_at'] }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Send For : @if($temp['MWClient']=='AllChild') All Children
                                            @else {{$temp['MWClient']}}  @endif
                            </p>
                        </div><!-- OneofAllMessage --> <br><br>
                    @endforeach
                @endif
            @endif
        </div><!-- AllNotifications -->

        <div class="MyNotifications">
            @if(isset($MyNotificationDetails))
                @php   $JsonMyNotificationDetails=json_decode($MyNotificationDetails,true); @endphp
                <h2 class="well">My Notifications</h2><br>
                <button class="btn-info"><a href="CNotifications">Check All Messages</a></button><br><br>
                @if(empty($MyNotificationDetails[0]))
                    <p class="Error">There is No Any Message for you</p>
                @else
                    @foreach($JsonMyNotificationDetails as $temp)
                        <div class="OneofMyMessage" id="{{$temp['Id']}}" style="border:1px solid;"> 
                            <p>Subject of Message : {{ $temp['Subject'] }}</p>
                            <p>{{ $temp['Message'] }}</p>
                            <p> Scheduled Date  : @if( empty($temp['ScheduledDate']) )  Not Mentioned 
                                                  @else {{ $temp['ScheduledDate'] }}   @endif   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Scheduled Time  : @if( empty($temp['ScheduledTime']) )  Not Mentioned 
                                                  @else {{ $temp['ScheduledTime'] }}   @endif &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Scheduled Venue : @if( empty($temp['ScheduledVenue']) )  Not Mentioned 
                                                  @else {{ $temp['ScheduledVenue'] }}   @endif &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </p>
                            <p> Send By : {{ $temp['MWName'] }} ( {{ $temp['MWId'] }} ) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Sended On : {{ $temp['created_at'] }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Send For : @if($temp['MWClient']=='AllChild') All Children
                                           @else {{$temp['MWClient']}}  @endif
                            </p>
                        </div><!-- OneofMyMessage --> <br><br>
                    @endforeach
                @endif
            @endif
        </div><!-- MyNotifications -->

    </div><!-- Notifications -->



    <div class="Bugs">
        @if(isset($CBugInfo))
            <h2 class="well" >Reporting Bugs</h2><br>
            <form id="SubmitChildBug" action="CBugsSave" method="post">
                {{csrf_field()}}  
                <textarea name="Message" rows="10" cols="150"> </textarea><br><br>
                <lable> Model related to Bug <select name="CBugModel" id="CBugModel">
                        <option value="" selected>None</option>
                        <option value="(C) Basic Information Menu">Basic Information Menu</option>        
                        <option value="(C) Birth Information Menu">Birth Information Menu</option>
                        <option value="(C) Charts Menu">Charts Menu</option>
                        <option value="(C) Vaccination Details Menu">Vaccination Details Menu</option>
                        <option value="(C) Guardian's Concerns Menu">Guardian's Concerns Menu</option>
                        <option value="(C) Report Bugs Menu">Report Bug Menu</option>
                </select> </lable><br><br>
                <input class="btn-primary" type="submit" name="submit" value="Send"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input class="btn-warning" type="reset" name="reset" value="Reset All">
            </form>
        @endif
    </div><!-- Bugs -->

    <div class="ChangePwrd">
        @if(isset($CChangePwrd))
        <h2 class="well" >Change Password</h2><br>
            <input type="text" class="" name="CurrentPwrd" id="CurrentPwrd" placeholder="Enter Your Current Password"><br>
            <p class="PasswordError hidden">Entered current password is not right one.</p>
            <div class="RightPwrd hidden">
                <form action="CSavePwrd" method="post">
                    {{csrf_field()}}
                    <p>Entered password is right. Now enter your New Password</p>
                    <input type="text" name="NewPwrd" id="NewPwrd" placeholder="Enter Your New Password"><br><br>
                    <input type="text" name="ReNewPwrd" id="ReNewPwrd" placeholder="Re-Enter Your New Password"><br><br>
                    <input class="btn-primary" type="submit" name="submit" value="Change">
                    <input class="btn-warning" type="reset" name="reset" value="Reset All">
                    </form>
            </div><!-- RightPwrd -->
        @endif
    </div><!-- ChangePwrd -->
    


    <div class="GuardianConcerns">
    </div><!-- GuardianConcerns -->

</div><!-- ChildAllContent -->   
</body>
</html>