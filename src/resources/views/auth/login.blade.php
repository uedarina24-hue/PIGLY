@extends('layouts.guest')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css')}}">
@endsection


@section('content')
<div class="register-form">
        <div class="register-form__text">
            <!-- タイトル -->
            <div class="register-form__head">
                <h1 class="register-form__heading">PiGly</h1>
                <h2 class="register-form__new">ログイン</h2>
            </div>
            <form class="login-form" action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                <!-- メールアドレス入力 -->
                <div class="form-group">
                    <label class="form-label" for="email">メールアドレス</label>
                    <input class="form-input" type="email" id="email" name="email" placeholder="メールアドレスを入力" required>
                    <div class="auth__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                    </div>
                </div>

                <!-- パスワード入力 -->
                <div class="form-group">
                    <label class="form-label" for="password">パスワード</label>
                    <input class="form-input" type="password" id="password" name="password"  placeholder="パスワードを入力" required>
                    <div class="auth__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                    </div>
                </div>

                <!-- 次の画面にすすむボタン -->
                <div class="form-button">
                    <button class="auth-button" type="submit">
                        ログイン
                    </button>
                </div>
            </form>

            <!-- アカウント作成リンク -->
            <div class="form-link">
                <a class="auth-link" href="{{ route('register') }}">
                    アカウント作成はこちら
                </a>
            </div>
        </div>
    </div>
</div>
@endsection