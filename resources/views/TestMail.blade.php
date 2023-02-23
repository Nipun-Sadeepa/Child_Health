<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mailing</title>
</head>
<body>
    <h2>Login credentials regarding to {{$CredentialDetails['ReceiverName']}}</h2>
    <p>Login Credentials for ChildDev Application were mentioned in below.</p>
    <p>You can change password after login ChildDev Application by using this credentials</p><br>
    <p>Login Id : {{$CredentialDetails['ReceiverId']}}</p>
    <p>password : {{$CredentialDetails['ReceiverPwrd']}}</p><br><br>
    <p>Your registration was done by {{$CredentialDetails['SenderAMWName']}} ( {{$CredentialDetails['SenderAMWId']}} )</p>
    <p>Thank You</p>
</body>
</html>
