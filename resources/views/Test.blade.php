<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script> 
    <script>   

    $(document).ready(function(){

        $("#one").click(function(){
            //alert('one');
            //$(".first").removeClass('hidden');
            $(".cont").load("TestContentView .first");
            
            
        });

        $("#two").click(function(){
            //alert('two');
            $(".cont").load("TestContentViews .two",function(responseTxt){
                //$(".cont").html(responseTxt);
            });
            //$(".two").removeClass('hidden');
        });

    });

    </script>

    <style>
        .hidden{
            display:none;
        }
    </style>
</head>
<body>
        <br><br>
        <a href="" id="one">One</a><br>
        <a href="" id="two">Two</a><br>
        <a href="AddForm">Add Form</a><br>
        <a href="TestContentView">check view</a><br>
        <a href="TestContentViews">check view 12</a>
        

        <div class="cont">

        </div>

    <div class="first">
        <!-- <h1>lsjkadl;as</h1> -->
        @if(isset($firsts))
            
            <!-- @foreach($firsts as $temp) -->
                <p> first one : {{$firsts[0]}}</p>
                <p> first Second: {{$firsts[1]}}</p>
            <!-- @endforeach -->
        @endif
    </div>

    <div class="two">
        @if(isset($Sec))
            
                <p> Second one : {{$Sec[0]}}</p>
                <p> Second Sec: {{$Sec[1]}}</p>
            
        @endif
    </div>
    
    <?php 
    // print_r($got); // $got; 
    // $x=json_decode($got,true);
    // echo "<br><br>";
    // //echo $got[0]['Id'];  // meka werdiy. obj ekk array ekk wdyta uise kran a belu.
    // //echo $got->Id;
    // echo "<br><br>";
    // print_r ($x); echo "<br><br>";
    // echo $x[0]['Id'];echo "<br><br>";  // 0 nethuwa demmoth Id kiyala instance ekk ne klioyanwa
    // echo $x[0]['UniqueId'];

    // print_r dennaone ne. echoth athy. meka json object ekk nisay ehema puluwan wenne. 
    ?><br><br> 
    <!--php echo kiyana ekay = samana lakuna dana ekay 2kma ekay. -->
    <?php
        //echo $got['Id'];   // Id kiyanne undefinerd arraylu.
        //echo $got->Id;  // does not existlu
        //echo $items['Id'];  // $items kiyanne undefined var ekklu. 
        //echo $items->Id;
    ?>
    @if(isset($x))
    <img src="" alt=""><br><br><br>
    <form class="test" action="Test" method="post" autocomplete="on"> 
    {{csrf_field()}}
    <input type="datetime-local" name="BirthDateAndTime" placeholder="Select Birth Day & Time"><br>
   <input type="submit" name='submit' placeholder='next'>
   </form>
   @endif

   @if(isset($got)) 
    $a=json_decode($got,true);
   
        <p>item : {{ $a[0]['item'] }}</p>
        <p>its status : {{ $a[0]['status'] }}</p>
   @endif

   
</body>
</html>