<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div class="first">
        @if(isset($firsts))
            @php  $Jsonfirsts=json_decode($firsts,true);   @endphp
            @foreach($Jsonfirsts as $temp)
                <p> first one : {{$temp[0]}}</p>
                <p> first Second: {{$temp[1]}}</p>
            @endforeach
        @endif
    </div>

    <div class="two">
        @if(isset($Sec))
            @php  $JsonSec=json_decode($Sec,true);   @endphp
            @foreach($JsonSec as $temp)
                <p> Second one : {{$temp[0]}}</p>
                <p> Second Sec: {{$temp[1]}}</p>
            @endforeach
        @endif
    </div>

</body>
</html>l