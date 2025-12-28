<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    @yield('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>

<body>
    <div class="app">
        <header class="header">
            <h1 class="header__logo">PiGly</h1>
                @auth
                <div class="header__links">
                    <i class="fa-solid fa-gear"></i>
                    <a href="{{ route('weight_logs.goal_setting') }}">目標体重設定</a>
                    <form class="form" action="{{ route('logout') }}" method="post">
                        @csrf
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <button type="submit">ログアウト</button>
                    </form>
                </div>
                @endauth
            @yield('link')
        </header>
        <div class="content">
        @yield('content')
        </div>
    </div>
    @yield('js')
</body>
</html>