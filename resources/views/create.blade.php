@extends('layouts.app')

@section('content')
<section class="createSec">
    <div class="container">
        @if (session('message'))
            <p class="flash-message">{{ session('message') }}</p>
        @endif
        <div class="createSec-top">
            <h2 class="createSec-title">タスク追加</h2>
            <a class="createSec-link" href="{{ route('home') }}">ホーム</a>
        </div>
        @error('cerate_miss')
            <p class="form-alert">{{ $message }}</p>
        @enderror
        <form action="{{ route('store') }}" method="POST">
            @csrf
            <table>
                <tr>
                    <th>内容</th>
                    <td class="form-content">
                        <textarea id="input-content" name="content" cols="25" rows="5">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="form-alert">{{ $message }}</p>
                        @enderror
                        <ul>
                            <li><input type="checkbox" id="radio" name="level" value="1" {{ old('level') === '1' ? 'checked' : '' }}><label for="radio" class="form-radio">重要</label></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>期限</th>
                    <td class="form-datetime">
                        <div class="form-datetime-date">
                            <label for="input-date">日付 </label>
                            <input id="input-date" name="date" type="date" value="{{ old('date') }}">
                            @error('date')
                                <p class="form-alert">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-datetime-time">
                            <label for="form-time">時間 </label>
                            <input id="input-time" name="time" type="time" value="{{ old('time') }}">
                            @error('time')
                            <p class="form-alert">{{ $message }}</p>
                        @enderror
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>通知</th>
                    <td class="form-notify">
                        <ul>
                            <li><input type="checkbox" id="1month" name="notify[]" value="month" onclick="inputNotifyCheck();" {{ is_array(old('notify')) && array_keys(old('notify'), "month") ? 'checked' : '' }}><label for="1month" class="checkbox">1ヶ月</label></li>
                            <li><input type="checkbox" id="3week" name="notify[]" value="21" onclick="inputNotifyCheck();" {{ is_array(old('notify')) && array_keys(old('notify'), "21") ? 'checked' : '' }}><label for="3week" class="checkbox">3週間</label></li>
                            <li><input type="checkbox" id="2week" name="notify[]" value="14" onclick="inputNotifyCheck();" {{ is_array(old('notify')) && array_keys(old('notify'), "14") ? 'checked' : '' }}><label for="2week" class="checkbox" >2週間</label></li>
                            <li><input type="checkbox" id="1week" name="notify[]" value="7" onclick="inputNotifyCheck();" {{ is_array(old('notify')) && array_keys(old('notify'), "7") ? 'checked' : '' }}><label for="1week" class="checkbox">1週間</label></li>
                        </ul>
                        <ul>
                            <li><input type="checkbox" id="6day" name="notify[]" value="6" onclick="inputNotifyCheck();" {{ is_array(old('notify')) && array_keys(old('notify'), "6") ? 'checked' : '' }}><label for="6day" class="checkbox">6日</label></li>
                            <li><input type="checkbox" id="5day" name="notify[]" value="5" onclick="inputNotifyCheck();" {{ is_array(old('notify')) && array_keys(old('notify'), "5") ? 'checked' : '' }}><label for="5day" class="checkbox">5日</label></li>
                            <li><input type="checkbox" id="4day" name="notify[]" value="4" onclick="inputNotifyCheck();" {{ is_array(old('notify')) && array_keys(old('notify'), "4") ? 'checked' : '' }}><label for="4day" class="checkbox">4日</label></li>
                            <li><input type="checkbox" id="3day" name="notify[]" value="3" onclick="inputNotifyCheck();" {{ is_array(old('notify')) && array_keys(old('notify'), "3") ? 'checked' : '' }}><label for="3day" class="checkbox">3日</label></li>
                            <li><input type="checkbox" id="2day" name="notify[]" value="2" onclick="inputNotifyCheck();" {{ is_array(old('notify')) && array_keys(old('notify'), "2") ? 'checked' : '' }}><label for="2day" class="checkbox">2日</label></li>
                            <li><input type="checkbox" id="1day" name="notify[]" value="1" onclick="inputNotifyCheck();" {{ is_array(old('notify')) && array_keys(old('notify'), "1") ? 'checked' : '' }}><label for="1day" class="checkbox">1日</label></li>
                        </ul>
                    </td>
                </tr>
            </table>
            <div class="form-submit">
                <input id="input-submit" class="input-submit" name="submit" type="submit" value="追加">
            </div>
        </form>
    </div>
</section>
@endsection
