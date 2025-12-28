@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css')}}">
@endsection

@section('link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endsection

@section('content')
<div class="container">
    <div class="container-inner">

        <form class="edit-form" action="{{ route('weight_logs.update', $weightLog) }}" method="post">
        @csrf
        @method('PUT')

            <h2 class="edit-title">Weight Log</h2>
            <label class="edit-name">日付</label>
            <input class="edit-form__data" type="date" name="date" value="{{ old('date', $weightLog->date->toDateString()) }}">
            <div class="edit__error">
                @error('date')
                {{ $message }}
                @enderror
            </div>

            <label class="edit-weight">体重</label>
            <div class="edit-form__unit">
            <input class="edit-form__data" type="number" step="0.1" name="weight" value="{{ old('weight', $weightLog->weight) }}">
            <span class="edit-form__unit-text">kg</span>
            </div>
            <div class="edit__error">
                @error('weight')
                {{ $message }}
                @enderror
            </div>

            <label class="edit-calorie">摂取カロリー</label>
            <div class="edit-form__unit">
            <input class="edit-form__data" type="number" name="calories" value="{{ old('calories', $weightLog->calories) }}">
            <span class="edit-form__unit-text">kcal</span>
            </div>
            <div class="edit__error">
                @error('calories')
                {{ $message }}
                @enderror
            </div>

            <label class="edit-exercise">運動時間</label>
            <input class="edit-form__data" type="time" name="exercise_time" value="{{ old('exercise_time', $weightLog->exercise_time) }}">
            <div class="edit__error">
                @error('exercise_time')
                {{ $message }}
                @enderror
            </div>

            <label class="edit-textarea">運動内容</label>
            <textarea class="edit-form__textarea" name="exercise_content">{{ old('exercise_content', $weightLog->exercise_content) }}
            </textarea>
            <div class="edit__error">
                @error('exercise_content')
                {{ $message }}
                @enderror
            </div>

            <div class="modal-button-group">
            <button class="edit-button__update" type="submit">更新</button>
            <a class="edit-button__back" href="{{ route('weight_logs.index') }}">戻る</a>
        </form>

            <form class="edit-button" action="{{ route('weight_logs.delete', $weightLog) }}" method="post" onsubmit="return confirm('削除しますか？')">
            @csrf
            @method('DELETE')
            <button class="edit-button__delete">
                <i class="fa-solid fa-trash"></i>
            </button>
            </form>
            </div>
    </div>
</div>
@endsection
