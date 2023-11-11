<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}">
    <title>Strike Arena Курган</title>
</head>
<body>
<input type="hidden" name="bp_date_end" value="{{ $settings['bp_date_end'] }}">
<div class="modal" id="modalWin">
    <div class="modal-window">
        <ol>
            <li>Покупка бп:</li>
            <ol>
                <li>покупая боевой пропуск вы совершаете добровольные денежные пожертвование</li>
                <li>после покупки вы получаете доступ к боевому пропуску и всем находящемся в нем призам в зависимости от текущего уровня.</li>
            </ol>
            <li>Уровень БП и выдача призов:</li>
            <ol>
                <li>уровень выдаться вручную администраторами, после непосредственного посещения и покупки услуг от 150 рублей (не считая бара)</li>
                <li>посещение начисляться 1 раз в 12 часов, после начисление посещения приз выдаеться также 1 раз в 12 часов (время считается с последнего посещения)</li>
            </ol>
            <li>Возврат средств:</li>
            <ol>
                <li>Возврат денежных средств возможен только если с момента покупки прошло не более 12 часов, а также если вам не выдавали посещение (у вас нет призов ожидающие активацию)</li>
            </ol>
        </ol>
        <button class="btn-close" data-easy-toggle="#modalWin" data-easy-class="h">X</button>
    </div>
    <div class="overlay" data-easy-toggle="#modalWin" data-easy-class="h" ></div>
</div>

<header>
    <div class="logo">
        <img src="{{ asset('media/logo.png') }}" alt="logo">
    </div>

    @if(Auth::check())
    <div class="logout">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit"><img src="{{ asset('media/exit.svg') }}" alt=""></button>
        </form>
        <h3>Ваш ID: {{Auth::id()}}</h3>
    </div>
    @else
    <!-- Скрытие/отображение панели входа и регистрации -->
    <div class="user">
        <img src="{{ asset('media/user.png') }}" alt="user_img">
        <div class="menu-user">
            <a href="{{ route('login') }}" class=""><h5>Вход</h5></a><br>
            <a href="{{ route('register')}}" class=""><h5>Регистрация</h5></a>
        </div>
    </div>
    <!-- Скрытие/отображение панели входа и регистрации -->
    <div class="mobile_user">
        <a href="{{ route('login') }}">
            <div class="user_btn_mobile">
                <img src="{{ asset('media/user.png') }}" alt="">
                <h5>Войти</h5>
            </div>
        </a>
    </div>
    @endif
</header>

<main>
    <div class="banner">
        <div class="content_banner">
            <h1>Боевой пропуск уже активен.<br>Море сочных призов ждут тебя</h1>
            <div class="timer">
                <p>до конца:</p>
                <div class="br"></div>
                <div class="timer__items">
                    <h1><div class="timer__item timer__days">00</div></h1>
                    <h1> : </h1>
                    <h1><div class="timer__item timer__hours">00</div></h1>
                    <h1> : </h1>
                    <h1><div class="timer__item timer__minutes">00</div></h1>
                    <h1> : </h1>
                    <h1><div class="timer__item timer__seconds">00</div></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-banner">
        <div class="mobile_content_banner">
            <h1>Боевой пропуск уже активен. Море сочных призов ждут тебя</h1>
            <div class="mobile-timer">
                <p>до конца:</p>
                <div class="br"></div>
                <div class="timer__items">
                    <h1><div class="timer__item mbtimer__days">00</div></h1>
                    <h1> : </h1>
                    <h1><div class="timer__item mbtimer__hours">00</div></h1>
                    <h1> : </h1>
                    <h1><div class="timer__item mbtimer__minutes">00</div></h1>
                    <h1> : </h1>
                    <h1><div class="timer__item mbtimer__seconds">00</div></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="alert_pay @if($response == null) displayNone @endif">
        <h5>У вас есть незавершенный платеж</h5>
        <div class="alert_menu">
            <a href="{{ route('payment.check') }}"><p>Проверить</p></a>
            <a href="{{ $response['payUrl']?? '#' }}"><p>Оплатить</p></a>
            <a href="{{ route('payment.cancel') }}"><p>Отменить</p></a>
        </div>
    </div>
    <!-- Скрытие/отображение банера для покукпи БП -->
    <div class="alert @if($user_data->sub ?? true) displayNone @endif">
        <div class="buy">
            <div class="buy_content">
                <img src="{{ asset('media/star.png') }}" alt="">
                <h1>У вас все еще нет активной подписки?</h1>
                <a href="{{ route('payment.create') }}"><div class="btn_buy"><h1>купить</h1></div></a>
            </div>
            <div class="accept">
                <p>Нажимая на кнопку вы соглашаетесь с условиями <u><a href="#" class="btn_modal" data-easy-toggle="#modalWin" data-easy-class="show"><p>боевого пропуска</p></a></u>
            </div>
        </div>
    </div>

    <!-- Скрытие/отображение банера для покукпи БП -->
    <div class="mobile-alert @if($user_data->sub ?? true) displayNone @endif">
        <div class="mobile_buy">
            <div class="mobile_buy_content">
                <img src="{{ asset('media/star.png') }}" alt="">
                <h1>У вас все еще нет активной подписки?</h1>
                <a href="{{ route('payment.create') }}"><div class="mobile_btn_buy"><h1>купить</h1></div></a>
            </div>
            <div class="accept">
                <p>Нажимая на кнопку вы соглашаетесь с условиями <u><a href="#" class="btn_modal" data-easy-toggle="#modalWin" data-easy-class="show"><p>боевого пропуска</p></a></u>
            </div>
        </div>
    </div>

    <div class="cards" id="style-3">
        @foreach($battlepass as $item)
            <div class="card @if($item -> lvl <= $last_gift['gift_id']) get @endif @if($item -> lvl <= $lvl) ready @endif @if($item -> lvl >= $lvl) nolvl @endif">
                <div class="card_titel">
                    <h5>Уровень {{ $item -> lvl }}</h5>
                </div>
                <div class="br"></div>
                <div class="card-body">
                    <img src="{{ asset('media/'.$item -> plug) }}" class="img_gift" alt="" draggable="false">
                    <div class="br"></div>
                    <p>{{ $item -> description }}</p>
                </div>
            </div>
        @endforeach
    </div>
</main>

<footer>
    <div class="bmodal" id="bmodalWin">
        <div class="bmodal-window">
            <p>Сайт находиться в активном бета-тесте. При возникновении проблем или ошибок можете обратиться в <a href="https://t.me/Strike_arena_su_robot" class="tech">тех.поддержку сайта</a></p>
            <button class="btn-close" data-easy-toggle="#bmodalWin" data-easy-class="h">X</button>
        </div>
        <div class="overlay" data-easy-toggle="#bmodalWin" data-easy-class="h" ></div>
    </div>

    <a href="{{ $settings['vk_url'] }}"><img src="{{ asset('media/vk.png') }}" alt="VK"></a>
    <p>{{ $settings['address'] }}</p>
    <div class="br"></div>
    <a href="https://t.me/w0lderfin"><div class="wolderfin">
            <h1>W</h1>
        </div></a>
    <div class="br"></div>
    <a href="#" class="btn_modal" data-easy-toggle="#bmodalWin" data-easy-class="show"><div class="beta">
            <h5>beta</h5>
            <img src="{{ asset('media/info.png') }}" alt="" >
        </div></a>
</footer>

<script src="{{ asset('js/time.js') }}"></script>
<script src="{{ asset('js/mdtime.js') }}"></script>
<script src="{{ asset('js/modal.js') }}"></script>
<script src="{{ asset('js/scroll.js') }}"></script>
</body>
</html>

