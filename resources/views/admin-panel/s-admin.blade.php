<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <title>Панель администратора</title>
</head>
<body>
{{--    <h1>{{ $roles[0] }}</h1>--}}
<div class="contain">
    <div class="alert">
        @if(session()->has('error'))
            <div class="error">
                <h3>{{ session()->get('error') }}</h3>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="success">
                <h3>{{ session()->get('success') }}</h3>
            </div>
        @endif
    </div>
    <div class="logo">
        <img src="{{ asset('media/logo.png') }}" alt="">
    </div>
    <div class="br"></div>
    <div class="logout">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit"><img src="{{ asset('media/exit.svg') }}" alt=""></button>
        </form>
    </div>
    <div class="br"></div>
    <div class="user_serch">
        <h3>Поиск пользователя</h3>
        <div class="br"></div>
        <form action="{{ route('user.redirect') }}" method="post">
            @csrf
            <input type="number" name="user_id" placeholder="Введите id пользователя"><br><br>
            <button type="submit">найти</button>
        </form>
    </div>
    <div class="br"></div>
    <div class="user_serch">
        <h3>Полученые призы</h3>
        <div class="br"></div>
        <div class="list">
            @foreach($gifts as $gift)
            <div class="item">
                <h5>{{ $gift -> username }}</h5>
                <p>{{ $gift -> gift }}</p>
            </div>

            @endforeach
        </div>
    </div>


</div>
</body>
</html>
