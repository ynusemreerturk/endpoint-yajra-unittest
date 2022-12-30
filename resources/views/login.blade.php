<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Kayıt</h1>
<hr>
<div style="background-color: #718096">
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
</div>
<form method="post" action="{{route('register-post')}}">
    @csrf
    <label>Ad Soyad</label>
    <input type="text" name="name"  /> <br>
    <label>E-mail </label>
    <input type="text" name="email" /> <br>
    <label>Şifre (Şifrede özel karakter(.,;₺!$#%),büyük-küçük harf ve rakam bulunmalı)</label>
    <input type="password" name="password"/> <br>
    <label>Yeniden Şifre</label>
    <input type="password" name="password_confirmation"/> <br>
    <button type="submit">Kayıt Ol</button>
</form>
</body>
</html>
