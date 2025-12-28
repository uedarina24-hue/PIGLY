@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endsection

@section('content')
<div class="container">
    <div class="container-inner">

        <!-- サマリー情報 -->
        <div class="summary-wrapper">
            <div class="summary">
                @if($goal && $latestLog)
                    <p class="summary-data">目標体重</p>
                    <p class="summary-number">{{ number_format($goal->target_weight, 1) }}kg</p>
                    <p class="summary-data">目標まで</p>
                    <p class="summary-number">{{ number_format(($goal->target_weight - ($latestLog->weight ?? 0)), 1) }}kg</p>
                    <p class="summary-data">現在体重</p>
                    <p class="summary-number">{{ number_format($latestLog->weight ?? 0, 1) }}kg</p>
                @else
                    <p class="summary-data">目標体重が設定されていません</p>
                @endif
            </div>
        </div>

        <!-- 検索 -->
        <div class="search-area">
            <form class="search-form" action="{{ route('weight_logs.search') }}" method="get">
                <input class="search-form__date" type="date" name="from" value="{{ request('from') }}">
                〜
                <input class="search-form__date" type="date" name="to" value="{{ request('to') }}">
                <button class="search-form__button" type="submit">検索</button>

                    <a class="search-form__reset" href="{{ route('weight_logs.index') }}">リセット</a>
            </form>

            <!-- データ追加 -->
            <a  class="add-button" href="#modal" >
                データを追加
            </a>
        </div>

        <!-- 一覧 -->
        <table class="weight__table">
            <tr class="weight__row">
                <th class="weight__label">日付</th>
                <th class="weight__label">体重</th>
                <th class="weight__label">摂取カロリー</th>
                <th class="weight__label">運動時間</th>
                <th class="weight__label"></th>
            </tr>
            @foreach($weightLogs as $log)
            <tr class="weight__row">
                <td class="weight__data">{{ $log->date->format('Y/m/d') }}</td>
                <td class="weight__data">{{ number_format($log->weight, 1) }}kg</td>
                <td class="weight__data">{{ $log->calories }}cal</td>
                <td class="weight__data">{{ $log->exercise_time }}</td>
                <td class="weight__data">
                    <a class="weight__detail-btn" href="{{ route('weight_logs.edit', $log) }}">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </table>

        <!-- ページネーション -->
        <div class="pagination">
            {{ $weightLogs->appends(request()->query())->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>

<!-- モーダル（登録） -->
<div id="modal" class="modal">
    <div class="modal-overlay"></div>

    <div class="modal-content">
        <form class="modal-form" action="{{ route('weight_logs.store')}}" method="post">
            @csrf
            <label class="modal-name required">日付</label>
            <input class="modal-form__data" type="date" name="date" value="{{ now()->toDateString() }}">
            <div class="weight__error">
                @error('date')
                {{ $message }}
                @enderror
            </div>

            <label class="modal-weight required">体重</label>
            <div class="edit-form__unit">
            <input class="modal-form__data" type="number" step="0.1" name="weight" value="{{ old('weight') }}">
            <span class="edit-form__unit-text">kg</span>
            </div>
            <div class="weight__error">
                @error('weight')
                {{ $message }}
                @enderror
            </div>

            <label class="modal-calories required">摂取カロリー</label>
            <div class="edit-form__unit">
            <input class="modal-form__data" type="number" name="calories" value="{{ old('calories') }}">
            <span class="edit-form__unit-text">kcal</span>
            </div>
            <div class="weight__error">
                @error('calories')
                {{ $message }}
                @enderror
            </div>

            <label class="modal-calorie required">運動時間</label>
            <input class="modal-form__data" type="time" name="exercise_time" value="{{ old('exercise_time') }}">
            <div class="weight__error">
                @error('exercise_time')
                {{ $message }}
                @enderror
            </div>

            <label class="modal-calorie">運動内容</label>
            <textarea class="modal-form__textarea" name="exercise_content">{{ old('exercise_content') }}</textarea>
            <div class="weight__error">
                @error('exercise_content')
                {{ $message }}
                @enderror
            </div>

            <div class="modal-button-group">
                <button class="modal-button__submit" type="submit">登録</button>
                <a class="modal-button__back" href="#" class="modal-close">戻る</a>
            </div>
        </form>
    </div>
</div>

@section('js')
@if ($errors->any())
<script>
    window.addEventListener('load', function () {
        location.hash = 'modal';
    });
</script>
@endif
@endsection

@endsection
