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
<div class="back">
    <a href="{{ route('redirect.role') }}">Назад</a>
</div>
<div class="info">
    <div class="nick">
        <h5>Нинейм:</h5>
        <div class="br"></div>
        <h4>{{ $user_id['username']}}</h4>
        <div class="br"></div>
    </div>
    <div class="last_date">
        <h5>Последнее посещение:</h5>
        <div class="br"></div>
        <h4>@if($last_date ) {{ date('d.m.Y H:i', strtotime($last_date )) }}@else  @endif </h4>
        <div class="br"></div>
        <p class="">@if($difference != 'Нет посещений!') Прошло: {{ $difference }} час(ов)@else {{ $difference }} @endif</p>
    </div>
    <div class="lvl">
        <h5>Уровень пользователя:</h5>
        <div class="br"></div>
        <h4>{{ $lvl }}</h4>
    </div>
</div>

<div class="battle_action">
    <form action="{{ route('user.add_session', $user_id['id']) }}" method="post" class=" @if($difference < 12 || $user_id['sub'] == false) displayNone @endif">
        @csrf
        <button type="submit" class="btn_session"><h5>Добавить посещение</h5></button>
    </form>

    <form action="{{ route('user.give_gift', $user_id['id']) }}" method="post" class=" @if($last_gift ==  $lvl || $difference < 12 || $user_id['sub'] == false) displayNone @endif">

        <input type="hidden" name="lvl" value="{{ $last_gift+1 }}">
        <button type="submit" class="btn_gift"><h5>Выдать приз</h5></button>
    </form>
    @if($user_id['sub'] == false)
    <form action="{{ route('user.give_sub', $user_id['id']) }}" method="post">
        @csrf
        @method('Patch')
        <button type="submit" class="btn_gift"><h5>Выдать боевой пропуск</h5></button>
    </form>
    @endif
</div>

<div class="session_table">
    <h3>Дата и время последнего посещения:</h3>
    @if($user_id['sub'] == false)
        <p>У пользователя нет боевого пропуска!</p>
    @endif
    @foreach($session as $date)
        <h5>{{ date('d.m.Y H:i', strtotime($date['created_at'])) }}</h5>
    @endforeach

</div>
</body>
</html>
