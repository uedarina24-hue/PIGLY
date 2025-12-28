@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal_setting.css')}}">
@endsection

@section('content')
<div class="container">
    <div class="container-inner">

        <form class="goal-form" action="{{ route('weight_logs.goal_update') }}" method="post">
        @csrf
        @method('PUT')

            <label class="goal-form__label">目標体重設定</label>
            <div class="goal-form__unit">
            <input class="goal-form__data" type="number" step="0.1" name="target_weight"
            value="{{ old('target_weight', $target->target_weight) }}">
            <span class="goal-form__unit-text">kg</span>
            </div>

            <div class="goal__error">
                @error('target_weight')
                {{ $message }}
                @enderror
            </div>
            <div class="goal-button-group">
                <a class="goal-button__back" href="{{ route('weight_logs.index') }}">戻る</a>
                <button class="goal-button__update" type="submit">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection
