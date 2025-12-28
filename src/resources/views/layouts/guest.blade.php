<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/auth.css')}}">
    @yield('css')
</head>

<body class="auth-page">
    <main class="auth-container">
        <div class="auth-card">
            @yield('content')
        </div>
    </main>
</body>

</html>