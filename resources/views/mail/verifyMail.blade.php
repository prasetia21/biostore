<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data['title'] }}</title>
</head>
<body>
    
    <p>Hi, {{ $data['name'] }}, Welcome to Referral system</p>

    <p><a href="{{ $data['url'] }}">Click here to verify your email</a></p>
    <p>thank you</p>
</body>
</html>