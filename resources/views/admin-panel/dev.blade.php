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
    <div class="modal" id="modalWin">
        <div class="modal-window">
            <form action="{{ route('global.edit') }}" method="post">
                @csrf
                @method('Patch')
                <input type="checkbox" name="work" @if($settings['works']) checked @endif  >
                <label for="work">Включить режим тех.работ</label><br>
                <h5><label for="date">Дата окончания БП</label><br></h5>
                <input type="date" name="bp_date_end" class="bp_date_end" value="{{ $settings['bp_date_end'] }}"><br>
                <button type="submit">Сохранить</button>
            </form>
            <hr>
            <form action="{{ route('dattlePass.drop') }}" method="post">
                @csrf
                @method('Delete')
                <h5><input type="submit" value="Сброс боевого пропуска"></h5>
            </form>
            <form action="{{ route('user.subdrop') }}" method="post">
                @csrf
                @method('Patch')
                <h5><input type="submit" value="Сброс подписок"></h5>
            </form>
            <hr>
            <form action="{{ route('dattlePass.full') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="bp_csv" accept=".csv"><br>
                <button type="submit">Отправить</button>
            </form>
            <hr>
            <form action="{{ route('setting.update') }}" method="post">
                @csrf
                @method('Patch')
                <input type="text" name="address" class="setting_row" value="{{ $settings['address'] }}"><br><br>
                <input type="text" name="vk_url" class="setting_row" value="{{ $settings['vk_url'] }}"><br>
                <button type="submit">Сохранить</button>
            </form>
            <button class="btn-close" data-easy-toggle="#modalWin" data-easy-class="h">X</button>
        </div>
        <div class="overlay" data-easy-toggle="#modalWin" data-easy-class="h" ></div>
    </div>
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
    <a href="#" data-easy-toggle="#modalWin" data-easy-class="show"><h5>Настройки</h5></a>
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
    <script src="{{ asset('js/modal.js') }}"></script>
</body>
</html>
