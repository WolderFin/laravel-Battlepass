<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/reg.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход</title>
</head>
<body>
    <main>
        <div class="user_form">
            <img src="{{ asset('media/hightech.jpg') }}" alt="">
            <a href="https://ru.freepik.com/free-photo/hightech-helmets-on-humanoid-being-generative-ai_39858803.htm#query=games&position=9&from_view=keyword&track=sph"><img src="{{ asset('media/info.png') }}" alt="" class="img_info"></a>
            <div class="form" >

                @error('password')
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
                <a href="{{ route('index') }}"><img src="{{ asset('media/logo.png') }}" alt=""></a>
                <h1>С возвращением!</h1>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <input type="text" name="username" required class="text" placeholder="Логин"><br>
                    <input type="password" name="password" required class="text" placeholder="Пароль"><br><br>
                    <a href="#">Забыли пароль?</a><br><br>
                    <button type="submit" class="form-btn-login">Войти</button>
                </form>
                <p>Нет аккаунта? <a href="{{ route('register')}}">Регистрация</a></p>
                <p>Остались вопросы или проблемы? <a href="https://t.me/Strike_arena_su_robot">Поддержка</a></p><br><br>
            </div>

        </div>
    </main>
</body>
</html>
