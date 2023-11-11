<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/reg.css') }}">
    <title>Регитсрация</title>
</head>
<body>
    <main>
        <div class="user_form">
            <img src="{{ asset('media/hightech.jpg') }}" alt="">
            <a href="https://ru.freepik.com/free-photo/hightech-helmets-on-humanoid-being-generative-ai_39858803.htm#query=games&position=9&from_view=keyword&track=sph"><img src="{{ asset('media/info.png') }}" alt="" class="img_info"></a>
            <div class="form" >
                <a href="{{ route('index') }}"><img src="{{ asset('media/logo.png') }}" alt=""></a>

                <h1>Добро пожаловать!</h1>
                @error('password')
                    <div class="alert">
                        <div class="error">
                            <h3>{{ $message }}</h3>
                        </div>
                    </div>
                @enderror

                @error('email')
                    <div class="alert">
                        <div class="error">
                            <h3>{{ $message }}</h3>
                        </div>
                    </div>
                @enderror

                @error('username')
                    <div class="alert">
                        <div class="error">
                            <h3>{{ $message }}</h3>
                        </div>
                    </div>
                @enderror

                @error('smart-token')
                    <div class="alert">
                        <div class="error">
                            <h3>{{ $message }}</h3>
                        </div>
                    </div>
                @enderror
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <input type="text" name="username" required maxlength="50" minlength="5" class="text" placeholder="Логин"><br>
                    <input type="email" name="email" class="text" required placeholder="Почта"><br>
                    <input type="password" name="password" minlength="8" required class="text" placeholder="Пароль"><br>
                    <input type="password" name="password_confirmation" minlength="8" required class="text" placeholder="Повторение пароля"><br>
                    <dib class="captha">
                        <x-yandex-captcha></x-yandex-captcha>
                    </dib>
                    <button type="submit" class="form-btn"><p>Зарегистрироваться</p></button>
                </form>
                <p>Есть аккаунт? <a href="{{ route('login')}}">Войти</a></p>
                <p>Остались вопросы или проблемы? <a href="https://t.me/Strike_arena_su_robot">Поддержка</a></p><br><br>
            </div>
        </div>
    </main>
</body>
</html>
