<!DOCTYPE html>
<html>
<head>
    <title>Vítajte na stránke eĎieta</title>
</head>

<body>
<h2>Vítajte {{$user->username}}</h2>
<br/>
Registrovali ste s mailom {{$user->email}} , prosím kliknite na odkaz na overenie Vášho konta.
<br/>
<a href="{{url('user/verify', $user->verifyUser->token)}}">Overiť</a>
</body>

</html>