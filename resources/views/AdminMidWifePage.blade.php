<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Mid Wife Main Page</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script> 
    <script>

        $(document).ready(function(){

            $('#CurrentPwrd').change(function(){
                    var Pwrd= $(this).val();
                    //$.get("CheckPwrd",{Pwrd}, function(data,status){
                    $.get("AMWCheckPwrd/"+Pwrd, function(data,status){
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

        a{    
            font-weight:bold;
            text-decoration: none;
            padding: 10px 25px;
        }
        tr{
            height:40px;
        }
        th, td{
            text-align: center; 
        }
        h2,h3{
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
        .MidWifeMore p, .AMWProfile p{
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

    <div class="AdminMidWifeTabs">
        <nav class="navbar-default nav-justified navbar-fixed-top" style="height:60px;">
            <a href="AdminMidWife">Home Page</a>
            <a href="CreateChild">Add New Child</a>
            <a href="CreateMidWife">Add New Mid Wife</a>
            <a href="MidWife">Duty as a Mid Wife</a>
            <a href="AMWSendMsgAll">Send Notifications</a>
            <a href="AMWProfile">My Profile</a>
            <a href="AMWBug" id="AMWBugs">Report Bug</a>
            <a href="AMWChangePwrd" id="AMWPwrd">Change Password</a>
            <button class="navbar-btn btn-danger"><a href="LogOut">Log Out</a></button>
        </nav>
    </div>  <!-- AdminMidWifeTabs --> <br><br><br>

    <h1 class="text-info">ADMIN MID WIFE</h1><br><br>

<div class="AMWAllDetails">

    <div class="BasicMWShow">
        @if(isset($MWBasicDetails))
            @php $JsonMWBasicDetails=json_decode($MWBasicDetails,true); @endphp

            <form action="SearchingMW" method="post">
                {{csrf_field()}}
                <lable>Id : <input type="text" name="MWId"> </lable> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <lable>Registered Mid Wife : <input type="text" name="AMWId"> </lable>
                <input class="btn-info" type="submit" name="submit" value="Search">
            </form> <br><br>

                <table class="table-bordered table-hover table-striped table-responsive">
                    <tr>
                        <th>Mid Wife Id</th> <th>Name</th> <th>National Id</th> <th>Area</th> <th>Email</th> <th>Contact No</th> <th>Registered District</th> <th>Registered AMW Id</th> <th>Registered Date</th> 
                        <th>View More</th> <th>Send Message</th>  <th>Admin Promotion</th> 
                    </tr>

                    
                        @foreach($JsonMWBasicDetails as $temp)
                        <tr>
                            <td>{{$temp['MidWifeId']}}</td>
                            <td>{{$temp['InitializedName']}}</td>
                            <td>{{$temp['NationalId']}}</td>
                            <td>{{$temp['Area']}}</td>
                            <td>{{$temp['Email']}}</td>
                            <td>{{$temp['ContactNo']}}</td>
                            <td>{{$temp['RegisterdDistrict']}}</td>
                            <td>{{$temp['AMWId']}}</td>
                            <td>{{$temp['created_at']}}</td>
                            <td><button class="btn-info"><a href="MWMore/{{$temp['MidWifeId']}}">View More</a></button></td>
                            <td><button class="btn-info"><a href="AMWSendMsg/{{$temp['MidWifeId']}}">Send Message</a></button></td>
                            <td><button class="btn-info"><a href="MWPromote/{{$temp['MidWifeId']}}">Promotion</a></button></td>
                        </tr>
                        @endforeach
                    
                </table>
        @endif
    </div><!-- BasicMWShow -->
    


    <div class="SearchedMWShow">
        @if(isset($SearchigMWResult))
            @php $JsonSearchigMWResult=json_decode($SearchigMWResult,true); @endphp

            <form action="SearchingMW" method="post">
                {{csrf_field()}}
                <lable>Id : <input type="text" name="MWId"> </lable> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <lable>Registered Mid Wife : <input type="text" name="AMWId"> </lable>
                <input type="submit" name="submit" value="Search">
            </form>  

            <table class="table-bordered table-hover table-striped table-responsive">
                    <tr>
                        <th>Mid Wife Id</th> <th>Name</th> <th>National Id</th> <th>Area</th>  <th>Email</th> <th>Contact No</th> <th>Registered District</th> <th>Registered AMW Id</th> <th>Registered Date</th> 
                        <th>View More</th> <th>Send Message</th>  <th>Admin Promotion</th> 
                    </tr>

                    
                    @foreach($JsonSearchigMWResult as $temp)
                        <tr>
                            <td>{{$temp['MidWifeId']}}</td>
                            <td>{{$temp['InitializedName']}}</td>
                            <td>{{$temp['NationalId']}}</td>
                            <td>{{$temp['Area']}}</td>
                            <td>{{$temp['Email']}}</td>
                            <td>{{$temp['ContactNo']}}</td>
                            <td>{{$temp['RegisterdDistrict']}}</td>
                            <td>{{$temp['AMWId']}}</td>
                            <td>{{$temp['created_at']}}</td>
                            <td><button class="btn-info"><a href="MWMore/{{$temp['MidWifeId']}}">View More</a></button></td>
                            <td><button class="btn-info"><a href="AMWSendMsg/{{$temp['MidWifeId']}}">Send Message</a></button></td>
                            <td><button class="btn-info"><a href="MWPromote/{{$temp['MidWifeId']}}">Promotion</a></button></td>
                        </tr>
                    @endforeach
                    
            </table>
        @endif

    </div><!-- SearchedMWShow -->  
    


    <div class="MidWifeMore">
        @if(isset($MWMoreDetails))
            @php  $JsonMWMoreDetails= json_decode($MWMoreDetails,true); @endphp

            <h2 class="well"> View All Details regarding to {{$JsonMWMoreDetails[0]['InitializedName']}} ({{$JsonMWMoreDetails[0]['MidWifeId']}})</h2><br><br>
            <button class="btn-info"><a href="EditMW/{{$JsonMWMoreDetails[0]['MidWifeId']}}">Edit Details</a></button><br><br>
            <p>Mid Wife Id : {{$JsonMWMoreDetails[0]['MidWifeId']}}</p>
            <p>Full Name : {{$JsonMWMoreDetails[0]['FullName']}}</p>
            <p>Initialized Name : {{$JsonMWMoreDetails[0]['InitializedName']}}</p>
            <p>National Id : {{$JsonMWMoreDetails[0]['NationalId']}}</p>
            <p>Working Area : {{$JsonMWMoreDetails[0]['Area']}}</p>
            <p>Address : {{$JsonMWMoreDetails[0]['PermanentAddress']}}</p>
            <p>Contact No : {{$JsonMWMoreDetails[0]['ContactNo']}}</p>
            <p>Email : {{$JsonMWMoreDetails[0]['Email']}}</p>
            <p>Registered Year : {{$JsonMWMoreDetails[0]['RegisterdYear']}}</p>
            <p>Registered District : {{$JsonMWMoreDetails[0]['RegisterdDistrict']}}</p>
            <p>Registered AMW Id : {{$JsonMWMoreDetails[0]['AMWId']}}</p>
            <p>Registered AMW Name : {{$JsonMWMoreDetails[0]['AMWName']}}</p>
            <p>Registered Date : {{$JsonMWMoreDetails[0]['created_at']}}</p>
        @endif
    </div><!-- MidWifeMore -->


    <div class="UpdateMW">
        @if(isset($ToUpdateMWDetails))
            @php  $JsonUpdateMWDetails= json_decode($ToUpdateMWDetails,true); @endphp
            <h2 class="well">Information regarding to {{$JsonUpdateMWDetails[0]['MidWifeId']}} Numbered MidWife</h2>
            <form action="SaveMWUpdates" method="post">
                {{csrf_field()}}
                <input type="hidden" name="MWPrevAll" value="{{$ToUpdateMWDetails}}">
                <input type="hidden" name="MidWifeId" value="{{$JsonUpdateMWDetails[0]['MidWifeId']}}">
                <lable>Full Name : </lable><input type="text" name="FullName" value="{{$JsonUpdateMWDetails[0]['FullName']}}"><br><br>
                <lable>Initialized Name : </lable><input type="text" name="InitializedName" value="{{$JsonUpdateMWDetails[0]['InitializedName']}}"><br><br>
                <lable>National Id : </lable><input type="text" name="NationalId" value="{{$JsonUpdateMWDetails[0]['NationalId']}}"><br><br>
                <lable>Working Area : </lable><input type="text" name="Area" value="{{$JsonUpdateMWDetails[0]['Area']}}"><br><br>
                <lable>Permanent Address : </lable><input type="text" name="PermanentAddress" value="{{$JsonUpdateMWDetails[0]['PermanentAddress']}}"><br><br>
                <lable>Contact No : </lable><input type="text" name="ContactNo" value="{{$JsonUpdateMWDetails[0]['ContactNo']}}"><br><br>
                <lable>Email : </lable><input type="text" name="Email" value="{{$JsonUpdateMWDetails[0]['Email']}}"><br><br>
                <input class="btn-info" type="submit" value="Update">
            </form>
        @endif
    </div><!-- UpdateMW -->
    


    <div class="AddNewChild">
        @if(isset($AddChildSet))
            <h2 class="well">Add Child Information</h2><br>
            <p>Please enter following details to create account for child</p>
            <form class="NewAccount" action="AddChild" method="post" autocomplete="on"> 
            {{csrf_field()}}

                <div class="BasicInfo">
                
                    <lable> Full Name : </lable><input type="text" name="FullName" placeholder="Full Name"><br><br>
                    <lable> Initialized Name : </lable><input type="text" name="Name" placeholder="Name with Initials"><br><br>
                    <lable> Birth Date & Time : </lable><input type="datetime-local" name="BirthDateAndTime" placeholder="Select Birth Day & Time"><br><br>
                    <lable> Address : </lable><input type="text" name="Address" placeholder="Address"><br><br>

                    <lable> District : &nbsp <select name="District" id="District" >
                        <option value="Matara" selected>Matara</option>
                        <option value="Colombo">Colombo</option>
                        <option value="Galle">Galle</option>
                        <option value="Gampaha">Gampaha</option>
                        <option value="Kalutara">Kalutara</option>
                    </select>    </lable>    <br> <br>

                    <lable> Area : &nbsp <select name="Area" id="Area" >
                        <option value="Horana" selected>horana</option>
                        <option value="pokunuwita">pokunuwita</option>
                        <option value="Galle">bandaragama</option>
                        <option value="Gampaha">piliyandala</option>
                        <option value="Kalutara">kahathuduwa</option>
                    </select>    </lable>    <br> <br>

                    <lable> Mother Name : </lable><input type="text" name="MotherName" placeholder="Mother Name"><br><br>
                    <lable> Father Name : </lable><input type="text" name="FatherName" placeholder="Father Name"><br><br>
                    <lable> Email : </lable><input type="email" name="Email" placeholder="Guardian's email"><br><br>
                    <lable> Contact No : </lable><input type="text" name="ContactNo" placeholder="Guardian's Contact No"><br><br>
                </div><!-- BasicInfo -->


                <div class="BirthInfo">
                
                    <h3 class="well">Child Birth Information</h3><br>
                
                    <lable>Weight in Birth : &nbsp 
                        <input type="number" name="WeightInKg" value="0" min="0" max="100" step="1"> &nbsp Kg &nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="number" name="WeightInG" value="0" min="0" max="999" step="50">&nbsp g
                    </lable><br><br>
                    <lable>Height in Birth : &nbsp 
                        <input type="number" name="Height" value="0" min="0" max="100" step="1"> &nbsp cm </lable><br><br>
                    <lable>Perimeter of the head in Birth: &nbsp 
                        <input type="number" name="Perimeter" value="0" min="0" max="100" step="1"> &nbsp cm </lable><br><br>
                    <lable> Hospital : <input type="text" name="Hospital" placeholder="Hospital"><br><br> </lable>
                    <lable>Baby Delivered Type : 
                    <select name="DeliveredType" required>
                        <option value=""></option>
                        <option value="Normal Deliver">Normal Deliver</option>
                        <option value="Low Deliver">Low Deliver</option>
                        <option value="Using Vacum">Using Vacum</option>
                        <option value="Scerian Operation">Scerian Operation</option>
                    </select></lable><br><br>
                    <lable>No of Apga : <br>
                    <lable> In first 1 minute <input type="number" name="Apga1" value="0" step="1"><br><br> </lable>
                    <lable> In first 5 minute <input type="number" name="Apga5" value="0" step="1"><br><br> </lable>
                    <lable> In first 10 minute <input type="number" name="Apga10" value="0" step="1"><br><br> </lable>
                    </lable>

                    <lable>Vitamin K </lable> : <label for="VitaminKYes">Yes</label> <input type="radio" name="VitaminK" id="VitaminKYes" value="Yes">&nbsp;&nbsp;&nbsp;
                    <label for="VitaminKNo">No</label> <input type="radio" name="VitaminK" id="VitaminKNo" value="No"><br><br>

                    <lable>Maw kiri in first Minute </lable> : <label for="MilkYes">Yes</label> <input type="radio" name="Milk" id="MilkYes" value="Yes">&nbsp;&nbsp;&nbsp;
                    <label for="MilkNo">No</label> <input type="radio" name="Milk" id="MilkNo" value="No"><br><br>

                    <lable>Sthapitaya </lable> : <label for="EstablishYes">Yes</label> <input type="radio" name="Establish" id="EstablishYes" value="Yes">&nbsp;&nbsp;&nbsp;
                    <label for="EstablishNo">No</label> <input type="radio" name="Establish" id="EstablishNo" value="No"><br><br>

                    <lable>Sambandaya </lable> : <label for="ConnectionYes">Yes</label> <input type="radio" name="Connection" id="ConnectionYes" value="Yes">&nbsp;&nbsp;&nbsp;
                    <label for="ConnectionNo">No</label> <input type="radio" name="Connection" id="ConnectionNo" value="No"><br><br>

                    <lable>Test for Ajanma lede </lable> : <label for="TestYes">Yes</label> <input type="radio" name="Test" id="TestYes" value="Yes">&nbsp;&nbsp;&nbsp;
                    <label for="TestNo">No</label> <input type="radio" name="Test" id="TestNo" value="No"><br><br>

                    <lable> B.C.G. Vaccination : <label for="bcgYes">Yes</label> <input type="radio" name="BCG" id="bcgYes" value="Yes">&nbsp;&nbsp;&nbsp;
                    <label for="bcgNo">No</label> <input type="radio" name="BCG" id="bcgNo" value="No"><br><br>

                    <lable> Skin Color : <input type="text" name="SkinColor"></lable><br><br>
                    <lable> Eyes : <input type="text" name="Eyes"></lable><br><br>
                    <lable> Nature of Pekaniya : <input type="text" name="Pekaniya"></lable><br><br>
                    <lable> Temperature : <input type="text" name="Temperature"></lable><br><br>
                
                </div><!-- BirthInfo -->
                &nbsp;&nbsp;&nbsp;
                <input class="btn-info" type="submit" name="submit" value="Save"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input class="btn-warning" type="reset" name="reset" value="Reset All">
            </form>
        @endif
    </div><!-- AddNewChild --> 



    <div class="AddNewMidWife">
        @if(isset($AddMidWifeSet))
            <h2 class="well">Add Mid Wife Information</h2><br>
            <p>Please enter following details to create account for Mid MidWifeDetailsSaving</p><br><br>
            <form class="MidWifeNewAccount" action="AddMidWife" method="post" autocomplete="on"> 
                {{csrf_field()}}
                <lable> Full Name : </lable><input type="text" name="FullName" placeholder="Full Name"><br><br>
                <lable> Initialized Name : </lable><input type="text" name="Name" placeholder="Name with Initials"><br><br>
                <lable> Registered Month : </lable><input type="month" name="RegisterdMonth" placeholder="Registerd Month"><br><br>
                
                <lable> Registered District : &nbsp <select name="RegisterdDistrict" id="District" >
                    <option value="Matara" selected>Matara</option>
                    <option value="Colombo">Colombo</option>
                    <option value="Galle">Galle</option>
                    <option value="Gampaha">Gampaha</option>
                    <option value="Kalutara">Kalutara</option>
                </select>    </lable>    <br> <br>

                <lable> National Id : </lable><input type="text" name="NationalId" placeholder="National Identity No"><br><br>
                <lable> Working Area : </lable><input type="text" name="Area" placeholder="Working Area"><br><br>
                <lable> Address : </lable><input type="text" name="Address" placeholder="Address"><br><br>
                <lable> Contact No : </lable><input type="text" name="ContactNo" placeholder="Contact Number"><br><br>
                <lable> Email : </lable><input type="email" name="Email" placeholder="Email"><br><br>
                &nbsp;&nbsp;&nbsp;
                <input class="btn-info" type="submit" name="submit" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input class="btn-warning" type="reset" name="reset" value="Reset All">
            </form>
        @endif
    </div><!-- AddNewMidWife -->



    <div class="AMWSendMsg">
        @if(isset($AMWSendMsgSet))
            <h2 class="well">Send Message </h2><br>
            <form id="SubmitAMWMsg" action="AMWSendMessage" method="post"> 
                {{csrf_field()}} 
                @if(isset($ReceiverId))
                    <p>Message Receiver : {{$ReceiverId}}</p>
                    <input type="hidden" name="AMWClient" value="{{$ReceiverId}}">
                @else
                    <p>Message Receiver : All Mid Wifes</p>
                    <input type="hidden" name="AMWClient" value="AllMidWife">
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
    </div><!-- AMWSendMsg -->



    <div class="AMWProfile">
        @if(isset($AMWProfileDetails))
            @php  $JsonAMWProfileDetails= json_decode($AMWProfileDetails,true); @endphp 

            <h2 class="well"> My Profile Details</h2><br><br>

            <p>Id : {{$JsonAMWProfileDetails[0]['MidWifeId']}}</p>
            <p>Full Name : {{$JsonAMWProfileDetails[0]['FullName']}}</p>
            <p>Initialized Name : {{$JsonAMWProfileDetails[0]['InitializedName']}}</p>
            <p>Working Area : {{$JsonAMWProfileDetails[0]['Area']}}</p>
            <p>National Id : {{$JsonAMWProfileDetails[0]['NationalId']}}</p>
            <p>Address : {{$JsonAMWProfileDetails[0]['PermanentAddress']}}</p>
            <p>Contact No : {{$JsonAMWProfileDetails[0]['ContactNo']}}</p>
            <p>Email : {{$JsonAMWProfileDetails[0]['Email']}}</p>
            <p>Registered Year : {{$JsonAMWProfileDetails[0]['RegisterdYear']}}</p>
            <p>Registered District : {{$JsonAMWProfileDetails[0]['RegisterdDistrict']}}</p>
            @if($JsonAMWProfileDetails[0]['AdminPromoted']==1)
                <p>Admin Mid Wife who you promoted : {{$JsonAMWProfileDetails[0]['PromotedAMWId']}}</p>
                <p>Promoted Date : {{$JsonAMWProfileDetails[0]['PromotedDate']}}</p>
            @endif
            <p>Admin Mid Wife who you registered : {{$JsonAMWProfileDetails[0]['AMWName']}} ( {{$JsonAMWProfileDetails[0]['AMWId']}} )</p>
            <p>Registered Date : {{$JsonAMWProfileDetails[0]['created_at']}}</p>
        @endif
    </div><!-- AMWProfile -->



    <div class="AMWBugs">
        @if(isset($AMWBugSet))
            <h2 class="well">Report Bug </h2><br>
            <form id="SubmitAMWBug" action="AMWBugSave" method="post">
                {{csrf_field()}}  
                <textarea name="Message" rows="10" cols="150"> </textarea><br><br>
                <lable> Model related to Bug <select name="AMWBugModel" id="AMWBugModel">
                        <option value="" selected>None</option>
                        <option value="(AMW) Add New Child Menu">Add New Child Menu</option>        
                        <option value="(AMW) Add New Mid Wife Menu">Add New Mid Wife Menu</option>
                        <option value="(AMW) Promote Mid Wife Menu">Promote Mid Wife Menu</option>
                        <option value="(AMW) Duty as Mid Wife Menu">Duty as Mid Wife Menu</option>
                        <option value="(AMW) Send Messages Menu">Send Messages Menu</option>
                        <option value="(AMW) Received Messages Menu">Received Messages Menu</option>
                </select> </lable><br><br>
                &nbsp;&nbsp;&nbsp;
                <input class="btn-info" type="submit" name="submit" value="Send"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input class="btn-warning" type="reset" name="reset" value="Reset All">
            </form>
        @endif
    </div><!-- AMWBugs -->


    <div class="AMWPwrd">
        @if(isset($AMWChangePwrd))
            <h2 class="well">Change Password</h2><br>
            <input type="text" class="" name="CurrentPwrd" id="CurrentPwrd" placeholder="Enter Your Current Password"><br>
            <p class="PasswordError hidden">Entered current password is not right one.</p>
            <div class="RightPwrd hidden">
                <form action="AMWSavePwrd" method="post">
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

</div><!-- AMWAllDetails -->


</body>
</html>