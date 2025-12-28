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
                <h2 class="register-form__new">新規会員登録</h2>
                <p class="register-form__inf">ステップ2：アカウント情報の登録</p>
            </div>

            <form class="register-form" action="{{ route('register.step2.store') }}" method="POST" novalidate>
                @csrf

                <!-- 名前入力 -->
                <div class="form-group">
                    <label class="form-label" for="latest_weight">現在の体重</label>
                    <div class="input-unit">
                        <input class="form-input" type="number" step="0.1" name="latest_weight"  placeholder="現在の体重を入力" value="{{ old('latest_weight') }}" required>
                        <span class="form-unit">kg</span>
                    </div>
                    <div class="auth__error">
                    @error('latest_weight')
                    {{ $message }}
                    @enderror
                    </div>
                </div>
                <!-- メールアドレス入力 -->
                <div class="form-group">
                    <label class="form-label" for="target_weight">目標の体重</label>
                    <div class="input-unit">
                        <input class="form-input" type="number" step="0.1" name="target_weight" placeholder="現在の体重を入力" value="{{ old('target_weight') }}" required>
                        <span class="form-unit">kg</span>
                    </div>
                    <div class="auth__error">
                    @error('target_weight')
                    {{ $message }}
                    @enderror
                    </div>
                </div>

                <!-- 次の画面にすすむボタン -->
                <div class="form-button">
                    <button class="auth-button" type="submit">
                        アカウント作成
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection