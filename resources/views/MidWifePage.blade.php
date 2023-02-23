<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mid Wife Main Page</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script> 
    <script>
           
        $(document).ready(function(){

            $('#CurrentPwrd').change(function(){
                var Pwrd= $(this).val();
                //$.get("CheckPwrd",{Pwrd}, function(data,status){
                $.get("MWCheckPwrd/"+Pwrd, function(data,status){
                    console.log(data);
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
        body{
            background-image:url('download.jpg');
        }
        a{
            font-weight:bold;
            text-decoration: none;
            padding: 10px 25px;
        }
        tr{
            height:50px
        }
        th, td{
            text-align: center;
            padding: 5px 10px;
        }
        h2, h3{
            text-align:center;
        }
        .Error{
            color:red;
        }
        .hidden{
            display: none;
        }
        p.PasswordError{
            color:red;
        }
        .btn-info{
            margin: 5px 10px;
            text-align:center;
        }
        .ChildMore p, .MWProfile p{
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


    <div class="MidWifeTabs">
        <nav class="navbar-default nav-justified navbar-fixed-top">
            @php $SessionChecking=session()->get('SessionAdminMidWifeId'); @endphp
            @if(isset($SessionChecking))
            <a href='AdminMidWife' id='GoAMW'>Go to Admin Mid Wife Menu</a>
            @endif

            <a href="MidWife" Id="SendMsg">Home Page</a>
            <a href="MWReceivedMsg" Id="MWReceivedMsg">Received Messages</a>
            <a href="MWSendMsgAll" Id="SendMsg">Send Notification</a>
            <a href="MWProfile" Id="Bugs">My Profile</a>
            <a href="MWBugs" Id="Bugs">Report Bugs</a>
            <a href="MWChangePwrd" Id="ChangePwrd">Change Password</a>
            <button class="navbar-btn btn-danger"><a href="LogOut">Log Out</a></button>
        </nav>
    </div>  <!-- MidWifeTabs --><br><br><br>

<h1 class="text-info">MID WIFE</h1><br><br>

<div class="AllMWContent">

    <div class="BasicChildShow">
        @if(isset($ChildDetails))
            @php $JsonChildDetails=json_decode($ChildDetails,true); @endphp

            <form action="SearchingChild" method="post">
                {{csrf_field()}}
                <lable>Id : <input type="text" name="Id"> </lable> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <lable>Living Area : <input type="text" name="Area"> </lable>&nbsp;&nbsp;&nbsp;
                <input class="btn-info" type="submit" name="submit" value="Search">
            </form> <br><br>

            <table class="table-bordered table-hover table-striped table-responsive">
                <tr>
                    <th>child Id</th> <th>Name</th> <th>Birth Date</th> <th>Area</th> <th>Mother Name</th> <th>Father Name</th> <th>Email</th> <th>Contact No</th> <th>Registered AMW Id</th> <th>Registered Date</th> 
                    <th style="width:10px;">View More</th> <th >Add Clinic Data</th>
                    <th style="width:20px;" >Vaccination</th>  <th>Send Message</th>  
                </tr>

                
                @foreach($JsonChildDetails as $temp)
                    <tr>
                        <td>{{$temp['ChildId']}}</td>
                        <td>{{$temp['InitializedName']}}</td>
                        <td>{{$temp['BirthDate_Time']}}</td>
                        <td>{{$temp['Area']}}</td>
                        <td>{{$temp['MotherName']}}</td>
                        <td>{{$temp['FatherName']}}</td>
                        <td>{{$temp['Email']}}</td>
                        <td>{{$temp['ContactNo']}}</td>
                        <td>{{$temp['AMWId']}}</td>
                        <td>{{$temp['created_at']}}</td>
                        <td><button class="btn-info"><a href="ChildMore/{{$temp['ChildId']}}">View More</a></button></td>
                        <td><button class="btn-info"><a href="AddClinicData/{{$temp['ChildId']}}">Add Clinic Data</a></button></td>
                        <td><button class="btn-info"><a href="AddVaccine/{{$temp['ChildId']}}">Vaccine</a></button></td>
                        <td><button class="btn-info"><a href="MWSendMsg/{{$temp['ChildId']}}">Send Message</a></button></td>
                    </tr>
                @endforeach
                
            </table>
        @endif
    </div><!-- BasicChildShow -->



    <div class="SearchedChildShow">
        @if(isset($SearchigResult))
            @php $JsonSearchigResult=json_decode($SearchigResult,true); @endphp
            
            <form action="SearchingChild" method="post">
                {{csrf_field()}}
                <lable>Id : <input type="text" name="Id"> </lable> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <lable>Living Area : <input type="text" name="Area"> </lable> &nbsp;&nbsp;&nbsp;
                <input class="btn-info" type="submit" name="submit" value="Search">
            </form>  <br><br>

            @if(empty($SearchigResult[0]))
                <p class="Error">There is No Any results according to your searching facts. Please try again with appropriate searching facts</p>
            @else

                <table class="table-bordered table-hover table-striped table-responsive">
                    <tr>
                        <th>child Id</th> <th>Name</th> <th>Birth Date</th> <th>Area</th> <th>Mother Name</th> <th>Father Name</th> <th>Email</th> <th>Contact No</th> <th>Registered AMW Id</th> <th>Registered Date</th> 
                        <th>View More</th> <th>Add Clinic Data</th>  <th>Vaccination</th>  <th>Send Message</th>  
                    </tr>

                    
                    @foreach($JsonSearchigResult as $temp)
                        <tr>
                            <td>{{$temp['ChildId']}}</td>
                            <td>{{$temp['InitializedName']}}</td>
                            <td>{{$temp['BirthDate_Time']}}</td>
                            <td>{{$temp['Area']}}</td>
                            <td>{{$temp['MotherName']}}</td>
                            <td>{{$temp['FatherName']}}</td>
                            <td>{{$temp['Email']}}</td>
                            <td>{{$temp['ContactNo']}}</td>
                            <td>{{$temp['AMWId']}}</td>
                            <td>{{$temp['created_at']}}</td>
                            <td><button class="btn-info"><a href="ChildMore/{{$temp['ChildId']}}">View More</a></button></td>
                            <td><button class="btn-info"><a href="AddClinicData/{{$temp['ChildId']}}">Add Clinic Data</a></button></td>
                            <td><button class="btn-info"><a href="AddVaccine/{{$temp['ChildId']}}">Vaccine</a></button></td>
                            <td><button class="btn-info"><a href="MWSendMsg/{{$temp['ChildId']}}">Send Message</a></button></td>
                        </tr>
                    @endforeach
                    
                </table>
            @endif
        @endif

    </div><!-- SearchedChildShow -->   



    <div class="ChildMore">
        @if(isset($ChildMoreDetails))
            @php  $JsonChildMoreDetails= json_decode($ChildMoreDetails,true);
                $BirthDateBrake=explode(' ',$JsonChildMoreDetails[0]['BirthDate_Time']);
                $ExplodedBirthDate=$BirthDateBrake[0];
                $ExplodedBirthTime=$BirthDateBrake[1]; 
            @endphp

            <h2 class="well"> View All Details regarding to {{$JsonChildMoreDetails[0]['InitializedName']}} ({{$JsonChildMoreDetails[0]['ChildId']}})</h2><br><br>
            <button class="btn-info"><a href="EditChild/{{$JsonChildMoreDetails[0]['ChildId']}}">Edit Details</a></button><br>
            <div class="More">
                <h3 class="well">Basic Information</h3><br>
                <p>ChildId : {{$JsonChildMoreDetails[0]['ChildId']}}</p>
                <p>Full Name : {{$JsonChildMoreDetails[0]['FullName']}}</p>
                <p>Initialized Name : {{$JsonChildMoreDetails[0]['InitializedName']}}</p>
                <p>BirthDate & Time: {{$ExplodedBirthDate}}</p>
                <p>Birth Time : {{$ExplodedBirthTime}}</p>
                <p>Address : {{$JsonChildMoreDetails[0]['Address']}}</p>
                <p>District : {{$JsonChildMoreDetails[0]['District']}}</p>
                <p>Area : {{$JsonChildMoreDetails[0]['Area']}}</p>
                <p>Mother Name : {{$JsonChildMoreDetails[0]['MotherName']}}</p>
                <p>Father Name : {{$JsonChildMoreDetails[0]['FatherName']}}</p>
                <p>Guardian Email : {{$JsonChildMoreDetails[0]['Email']}}</p>

                <br><br><h3 class="well">Birth Information</h3><br>
                <p>Weight at Birth : {{$JsonChildMoreDetails[0]['WeightInKg']}} kg {{$JsonChildMoreDetails[0]['WeightInG']}} g</p>
                <p>Height at Birth : {{$JsonChildMoreDetails[0]['Height']}}</p>
                <p>Head Perimeter at Birth : {{$JsonChildMoreDetails[0]['Perimeter']}}</p> 
                <p>Hospital : {{$JsonChildMoreDetails[0]['Hospital']}}</p>
                <p>Delivered Type : {{$JsonChildMoreDetails[0]['DeliveredType']}}</p>
                
                <lable> Apga count :
                    <table style="border:1px solid black;">
                        <tr>
                            <th>In first Minute</th> <th>In first 5 Minute</th> <th>In first 10 Minute</th>
                        </tr>
                        <tr>
                            <td><?= $JsonChildMoreDetails[0]['Apga1'] ?></td> 
                            <td><?= $JsonChildMoreDetails[0]['Apga5'] ?></td> 
                            <td><?= $JsonChildMoreDetails[0]['Apga10'] ?></td>
                        </tr>
                    </table> 
                </lable> <br>

                    <lable> Breast Milk :
                        <table style="border:1px solid black;">
                            <tr>
                                <th>Breast Milk in First Hour</th> <th>Sthapitaya</th> <th>Connection</th>
                            </tr>
                            <tr>
                                <td><?= $JsonChildMoreDetails[0]['Milk'] ?></td> 
                                <td><?= $JsonChildMoreDetails[0]['Sthapitaya'] ?></td> 
                                <td><?= $JsonChildMoreDetails[0]['Connection'] ?></td>
                            </tr>
                        </table> 
                    </lable>

                    
                    <p>Vitamin K        : <?= $JsonChildMoreDetails[0]['VitaminK']?></p>
                    <p>Test for Lede    : <?= $JsonChildMoreDetails[0]['Test']?></p>
                    <p>B.C.G.           : <?= $JsonChildMoreDetails[0]['BCG']?></p>
                    <p>Skin Color       : <?= $JsonChildMoreDetails[0]['SkinColor']?></p>
                    <p>Eye              : <?= $JsonChildMoreDetails[0]['Eyes']?></p>
                    <p>Pekaniya         : <?= $JsonChildMoreDetails[0]['Pekaniya']?></p>
                    <p>Temperature      : <?= $JsonChildMoreDetails[0]['Temperature']?></p>
                
                <p>Registered Admin Mid Wife Id : {{$JsonChildMoreDetails[0]['AMWId']}}</p>
                <p>Registered Admin Mid Wife Name : {{$JsonChildMoreDetails[0]['AMWName']}}</p>
                <p>Registered Date : {{$JsonChildMoreDetails[0]['created_at']}}</p>
            </div><!-- More -->

        @endif
    </div><!-- ChildMore -->



    <div class="UpdateChild">
        @if(isset($ToUpdateCDetails))
            @php  $JsonUpdateCDetails= json_decode($ToUpdateCDetails,true); @endphp
            <h2 class="well">Information regarding to {{$JsonUpdateCDetails[0]['ChildId']}} Numbered MidWife</h2>
            <form action="SaveChildUpdates" method="post">
                {{csrf_field()}}
                <input type="hidden" name="CPrevAll" value="{{$ToUpdateCDetails}}">
                <input type="hidden" name="ChildId" value="{{$JsonUpdateCDetails[0]['ChildId']}}">
                <lable>Full Name : </lable><input type="text" name="FullName" value="{{$JsonUpdateCDetails[0]['FullName']}}"><br><br>
                <lable>Initialized Name : </lable><input type="text" name="InitializedName" value="{{$JsonUpdateCDetails[0]['InitializedName']}}"><br><br>
                <lable>Address : </lable><input type="text" name="Address" value="{{$JsonUpdateCDetails[0]['Address']}}"><br><br>
                <lable>Living Area : </lable><input type="text" name="Area" value="{{$JsonUpdateCDetails[0]['Area']}}"><br><br>
                <lable>Mother Name : </lable><input type="text" name="MotherName" value="{{$JsonUpdateCDetails[0]['MotherName']}}"><br><br>
                <lable>Father Name : </lable><input type="text" name="FatherName" value="{{$JsonUpdateCDetails[0]['FatherName']}}"><br><br>
                <lable>Guardian's Email : </lable><input type="text" name="Email" value="{{$JsonUpdateCDetails[0]['Email']}}"><br><br>
                <lable>Contact No : </lable><input type="text" name="ContactNo" value="{{$JsonUpdateCDetails[0]['ContactNo']}}"><br><br>&nbsp;&nbsp;&nbsp;
                <input class="btn-info" type="submit" value="Update">
            </form>
        @endif
    </div><!-- UpdateChild -->



    <div class="AddChildClinicData">

        <div class="ShowingPreviosClinicDetails">
            @if(isset($ChildClinicSet))
                @if(!empty($ChildClinicDetails[0]))
                    @php $JsonChildClinicDetails= json_decode($ChildClinicDetails,true); @endphp
                    <h2 class="well">Adding child clinic data</h2><br>
                    <table class="table-bordered table-hover table-striped table-responsive">
                        <tr>
                            <th>Child Id</th> <th>Clinic No</th> <th>Weight</th> <th>Height</th> <th>Head Perimeter</th> <th>Mid Wife Id</th> <th>Mid Wife Name</th> <th>Date</th> 
                        </tr>
                        @foreach($JsonChildClinicDetails as $temp)
                            <tr>
                                <td>{{$temp['ChildId']}}</td>
                                <td>{{$temp['ClinicNo']}}</td>
                                <td>{{$temp['WeightInKg']}} kg {{$temp['WeightInG']}} g</td>
                                <td>{{$temp['Height']}}</td>
                                <td>{{$temp['HeadPerimeter']}}</td>
                                <td>{{$temp['MWId']}}</td>
                                <td>{{$temp['MWName']}}</td>
                                <td>{{$temp['created_at']}}</td>
                            </tr>
                        @endforeach
                    </table><br><br>
                @else <p class="Error"> There is No previous clinic details regarding to &nbsp;&nbsp;&nbsp;{{$ChildId}}</p><br><br>
                @endif    
            @endif
        </div><!-- ShowingPreviosClinicDetails -->
        
        <div class="AddChildNewClinicData">
            @if(isset($ChildClinicSet))
                <form id="ChildData" action="ChildDataSave" method="post">
                    {{csrf_field()}}
                    <p>Child Id : {{$ChildId}}</p>
                    <input type="hidden" name="ChildId" value="{{$ChildId}}">
                    <lable>Clinic Number : &nbsp<input type="number" name="ClinicNo" value="{{$NextClinicNo}}" min="1" max="50" step="1"> </lable><br><br>
                    <lable>Weight : &nbsp <input type="number" name="WeightInKg" value="0" min="0" max="100" step="1"> &nbsp Kg &nbsp&nbsp&nbsp&nbsp&nbsp
                    <input type="number" name="WeightInG" value="0" min="0" max="999" step="50">&nbsp g
                    </lable><br><br>
                    <lable>Height : &nbsp <input type="number" name="Height" value="0" min="0" max="100" step="1"> &nbsp cm </lable><br><br>
                    <lable>Perimeter of the head : &nbsp <input type="number" name="Perimeter" value="0" min="0" max="100" step="1"> &nbsp cm </lable><br><br>
                    
                    &nbsp;&nbsp;&nbsp;
                    <input class="btn-info" type="submit" id="SubmitChildData" name="submit" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="btn-warning" type="reset" name="reset" value="Reset All">
                </form>
            @endif
        </div><!-- AddChildNewClinicData -->

    </div><!-- AddChildClinicData -->



    <div class="AddChildVaccineData">

        <div class="ShowingPreviosVaccineDetails">
            @if(isset($ChildVaccineSet))
                @if(!empty($ChildVaccineDetails[0]))
                    @php $JsonChildVaccineDetails= json_decode($ChildVaccineDetails,true); @endphp
                    <h2 class="well">Vaccination and Medicines</h2><br>

                    <table class="table-bordered table-hover table-striped table-responsive">
                        <tr>
                            <th>Child Id</th> <th>Vaccine Name</th> <th>Vitamin Name</th> <th>Mid Wife Id</th> <th>Mid Wife Name</th> <th>Date</th> 
                        </tr>
                        @foreach($JsonChildVaccineDetails as $temp)
                            <tr>
                                <td>{{$temp['ChildId']}}</td>
                                <td> {{$temp['Vaccine']}} </td>
                                <td> @if($temp['Vitamin']=='Null')
                                            Not Given
                                    @else   {{$temp['Vitamin']}}  
                                    @endif
                                </td>
                                <td> {{$temp['MWId']}} </td>
                                <td> {{$temp['MWName']}} </td>
                                <td> {{$temp['created_at']}} </td> 
                            </tr>
                        @endforeach
                    </table><br><br>
                @else <p class="Error"> There is No previous clinic details regarding to &nbsp;&nbsp;&nbsp;{{$ChildId}}</p><br><br>
                @endif
            @endif   
        </div><!-- ShowingPreviosVaccineDetails -->

        <div class="AddChildNewVaccineData">
            
            @if(isset($ChildVaccineSet))
                    <form id="SubmitVaccination" action="ChildVaccination" method="post">
                        {{csrf_field()}}  
                        <p>Child Id : {{$ChildId}}</p>
                        <input type="hidden" name="ChildId" value="{{$ChildId}}">
                        <lable> Vaccine type &nbsp <select name="Vaccine" id="VaccineId" required>
                        <option value=""></option>
                        <option value="B.C.G. 1">B.C.G. 1</option>
                        <option value="Poliyo 1">Poliyo 1</option>
                        <option value="Penta 1">Penta 1</option>
                        <option value="Poliyo 2">Poliyo 2</option>
                        <option value="Dead Poliyo">Dead Poliyo</option> 
                        <option value="Penta 2">Penta 2</option>
                        <option value="Poliyo 3">Poliyo 3</option>
                        <option value="Penta 3">Penta 3</option>
                        <option value="Sarampa">Sarampa</option>
                        <option value="Kammulgaya">Kammulgaya </option>
                        <option value="Rubella 1">Rubella 1</option>
                        <option value="Poliyo 4">Poliyo 4</option>
                        <option value="Triple Vaccine">Triple Vaccine</option>
                    </select>    </lable>    <br> <br>

                    <lable> Vitamin type &nbsp <select name="Vitamin" required>
                        <option value=""></option>
                        <option value="Null">Not Today</option>
                        <option value="Vitamin A">Vitamin A</option>
                        <option value="Multi Vitamin">Multi Vitamin</option>
                        <option value="Panu Beheth">Panu Beheth</option>
                    </select>    </lable>    <br> <br>
                    &nbsp;&nbsp;&nbsp;
                    <input class="btn-info" type="submit" name="submit" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="btn-warning" type="reset" name="reset" value="Reset All">
                </form>
            @endif
        </div><!-- AddChildNewVaccineData -->

    </div><!-- AddChildVaccineData -->



    <div class="MWSendMsg">
        @if(isset($MWSendMsgInfo))   
            <h2 class="well"> Send Message  </h2><br>
                <form id="SubmitMsg" action="MWSendMessage" method="post">
                    {{csrf_field()}} 

                    @if(isset($ReceiverId))
                        <p>Message Receiver : {{$ReceiverId}}</p>
                        <input type="hidden" name="MWClient" value="{{$ReceiverId}}">
                    @else
                        <p>Message Receiver : All Children</p>
                        <input type="hidden" name="MWClient" value="AllChild">
    
                    @endif
                    <lable> Subject : <input type="text" name="Subject" placeholder="Subject of Message"></lable> <br><br> 
                    <lable> Message : <br><textarea name="Message" rows="15" cols="150"> </textarea> </lable><br><br>
                    <lable> Scheduled Date : &nbsp; <input type="date" name="Date" placehoder="Scheduled Date(Optional)"> </lable> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <lable> Scheduled Time : &nbsp; <input type="time" name="Time" placehoder="Scheduled Time(Optional)">  </lable> <br><br>
                    <lable> Scheduled Venue : &nbsp; <input type="text" name="Venue" placehoder="Scheduled Venue(Optional)"> </lable> <br><br>
                    &nbsp;&nbsp;&nbsp;
                    <input class="btn-info" type="submit" name="submit" value="Send">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="btn-warning" type="reset" name="reset" value="Reset All">
                </form>
        @endif
    </div><!-- MWSendMsg -->



    <div class="AllMWReceivedMessages">
    
        <div class="AllMWRecvdMsg">
            
            @if(isset($AllMWRecvdMsg))
                @php $JsonAllMWRecvdMsg=json_decode($AllMWRecvdMsg,true);  @endphp
                
                <h2 class="well">All Received Messages</h2>
                <button class="btn-info"><a href="MWMyReceivedMsg">Check Messages received for only me</a></button><br><br>


                @if(empty($AllMWRecvdMsg[0])) 
                    <p class="Error">There is No Any Messages.</p>

                @else
                    @foreach($JsonAllMWRecvdMsg as $temp)
                        <div class="OneOfMWAllmessage" id="{{$temp['Id']}}" style="border:1px solid;"> 
                            <p>Subject of Message : {{ $temp['Subject'] }}</p>
                            <p>{{ $temp['Message'] }}</p>
                            <p> Scheduled Date  : @if( empty($temp['ScheduledDate']) )  Not Mentioned 
                                                @else {{ $temp['ScheduledDate'] }}   @endif   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Scheduled Time  : @if( empty($temp['ScheduledTime']) )  Not Mentioned 
                                                @else {{ $temp['ScheduledTime'] }}   @endif &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Scheduled Venue : @if( empty($temp['ScheduledVenue']) )  Not Mentioned 
                                                @else {{ $temp['ScheduledVenue'] }}   @endif &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </p>
                            <p> 
                                Send By : {{ $temp['AMWName'] }} ({{ $temp['AMWId'] }}) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Client base : @if( $temp['AMWClient']=='All_MW' ) For All Mid Wifes 
                                @else For {{$temp['AMWClient']}}  @endif &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Sended On : {{ $temp['created_at'] }}
                            </p>
                        </div><!-- OneOfMWAllmessage --> <br><br>
                    
                    @endforeach
                @endif
            @endif

        </div><!-- AllMWRecvdMsg -->

        <div class="MWMeRecvdMsg">
            @if(isset($MWMyRecvdMsg))
                @php $JsonMWMyRecvdMsg=json_decode($MWMyRecvdMsg,true);  @endphp
                <h2 class="well">All Received Messages For Me</h2>
                <button class="btn-info"><a href="MWReceivedMsg">Check All Messages</a></button>

                @if(empty($MWMyRecvdMsg[0])) 
                    <p class="Error">There is No Messages that send to you specifically.</p>
                
                @else
                    @foreach($JsonMWMyRecvdMsg as $temp)
                    
                        <div class="message" id="{{$temp['Id']}}" style="border:1px solid;"> 
                            <p>Subject of Message : {{ $temp['Subject'] }}</p>
                            <p>{{ $temp['Message'] }}</p>
                            <p> Scheduled Date  : @if( empty($temp['ScheduledDate']) )  Not Mentioned 
                                                @else {{ $temp['ScheduledDate'] }}   @endif   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Scheduled Time  : @if( empty($temp['ScheduledTime']) )  Not Mentioned 
                                                @else {{ $temp['ScheduledTime'] }}   @endif &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Scheduled Venue : @if( empty($temp['ScheduledVenue']) )  Not Mentioned 
                                                @else {{ $temp['ScheduledVenue'] }}   @endif &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </p>
                            <p> 
                                Send By : {{ $temp['AMWName'] }} ({{ $temp['AMWId'] }}) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Sended On : {{ $temp['created_at'] }}
                            </p>
                        </div><!-- message --> <br><br>
                    @endforeach
                @endif
            @endif
        
        </div><!-- MWMeRecvdMsg -->

    </div><!-- AllMWReceivedMessages -->



    <div class="MWProfile">
        @if(isset($MWProfileDetails))
            @php  $JsonMWProfileDetails= json_decode($MWProfileDetails,true); @endphp 

            <h2 class="well"> My Profile Details</h2><br><br>
            <p>Id : {{$JsonMWProfileDetails[0]['MidWifeId']}}</p>
            <p>Full Name : {{$JsonMWProfileDetails[0]['FullName']}}</p>
            <p>Initialized Name : {{$JsonMWProfileDetails[0]['InitializedName']}}</p>
            <p>National Id : {{$JsonMWProfileDetails[0]['NationalId']}}</p>
            <p>Working Area : {{$JsonMWProfileDetails[0]['Area']}}</p>
            <p>Address : {{$JsonMWProfileDetails[0]['PermanentAddress']}}</p>
            <p>Contact No : {{$JsonMWProfileDetails[0]['ContactNo']}}</p>
            <p>Email : {{$JsonMWProfileDetails[0]['Email']}}</p>
            <p>Registered Year : {{$JsonMWProfileDetails[0]['RegisterdYear']}}</p>
            <p>Registered District : {{$JsonMWProfileDetails[0]['RegisterdDistrict']}}</p>
            @if($JsonMWProfileDetails[0]['AdminPromoted']==1)
                <p>Admin Mid Wife who you promoted : {{$JsonMWProfileDetails[0]['PromotedAMWId']}} ( {{$JsonMWProfileDetails[0]['PromotedAMWName']}} )</p>
                <p>Promoted Date : {{$JsonMWProfileDetails[0]['PromotedDate']}}</p>
            @endif
            <p>Admin Mid Wife who you registered : {{$JsonMWProfileDetails[0]['AMWName']}} ( {{$JsonMWProfileDetails[0]['AMWId']}} )</p>
            <p>Registered Date : {{$JsonMWProfileDetails[0]['created_at']}}</p>
        @endif
    </div><!-- AMWProfile -->



    <div class="MWBugs">
        @if(isset($MWBugInfo))
            <h2 class="well">Report Bug</h2><br>
            <form id="SubmitBug" action="MWBugsSave" method="post">
                {{csrf_field()}}  
                <textarea name="Message" rows="10" cols="150"> </textarea><br><br>
                <lable> Model related to Bug <select name="MWBugModel" id="MWBugModel">
                        <option value="" selected>None</option>
                        <option value="(MW) Adding Child Data Menu">Adding Child Data Menu</option>        
                        <option value="(MW) Vaccination & Medicine Menu">Vaccination & Medicine Menu</option>
                        <option value="(MW) Send Messages Menu">Send Messages Menu</option>
                        <option value="(MW) Received Messages Menu">Received Messages Menu</option>
                        <option value="(MW) Information about Special Concerns">Information about Special Concerns</option>
                        <option value="(MW) Report Bugs Menu">Report Bug Menu</option>
                </select> </lable><br><br>
                &nbsp;&nbsp;&nbsp;
                <input class="btn-info" type="submit" name="submit" value="Send">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input class="btn-warning" type="reset" name="reset" value="Reset All">
            </form>
        @endif
    </div><!-- MWBugs -->



    <div class="MWPwrd">
        @if(isset($MWChangePwrd))
            <h2 class="well">Change Password</h2><br>
            <input type="text" class="" name="CurrentPwrd" id="CurrentPwrd" placeholder="Enter Your Current Password"><br>
            <p class="PasswordError hidden">Entered current password is not right one.</p>
            <div class="RightPwrd hidden">
                <form action="MWSavePwrd" method="post">
                    {{csrf_field()}}
                    <p>Entered password is right. Now enter your New Password</p>
                    <input type="text" name="NewPwrd" id="NewPwrd" placeholder="Enter Your New Password"><br><br>
                    <input type="text" name="ReNewPwrd" id="ReNewPwrd" placeholder="Re-Enter Your New Password"><br><br>
                    &nbsp;&nbsp;&nbsp;
                    <input class="btn-info" type="submit" name="submit" value="Change">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="btn-warning" type="reset" name="reset" value="Reset All">
                </form>
            </div><!-- RightPwrd -->
        @endif
    </div><!-- AMWPwrd -->


</div><!-- AllMWContent -->

</body>
</html>