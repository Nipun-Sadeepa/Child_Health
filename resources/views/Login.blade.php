<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChildDev Login</title>

    <style>
        #ErrorMessage{
            color: red;
        }
    </style>

</head>
<body>
    
    <h1>Welcome to Child Dev Project</h1>
    <p>This is the application that providing your baby's childhood all details</p><br>
    <p id="ErrorMessage">@if(isset($Error)){{$Error}} <br><br> @endif</p>
    <form action="Login" method="post">
        {{csrf_field()}}
        <input type="text" name="LoginId" placeholder="Enter Your Id"><br><br>
        <input type="password" name="pwrd" placeholder="Password here"><br><br><br>
        <input type="submit" name="submit" value="Log In">
        <input type="reset" name="reset" value="Reset All">
    </form>
   
</body>
</html>