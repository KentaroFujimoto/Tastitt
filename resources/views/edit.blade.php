@extends('layouts.app')

@section('content')
<section class="editSec">
    <div class="container">
        @if (session('message'))
            <p class="flash-message">{{ session('message') }}</p>
        @endif
        <div class="editSec-top">
            <h2 class="createSec-title">タスク編集</h2>
            <a class="createSec-link" href="{{ route('home') }}">ホーム</a>
        </div>
        <form action="{{ route('update') }}" method="POST">
            @csrf
            <table>
                <tr>
                    <th>内容</th>
                    <td class="form-content">
                        <textarea id="input-content" name="content" cols="25" rows="5">{{ $task['content'] }}</textarea>
                        @error('content')
                            <p class="form-alert">{{ $message }}</p>
                        @enderror
                        <ul>
                            <li>
                                <input type="checkbox" id="radio" name="level" value="1" {{ $task['level'] === 1 ? 'checked' : '' }}>
                                {{-- {{ old('level', $task['level']) === '1' ? 'checked' : '' }} --}}
                                <label for="radio" class="form-radio">重要</label>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>期限</th>
                    <td class="form-datetime">
                        <div class="form-datetime-date">
                            <label for="input-date">日付 </label>
                            <input id="input-date" name="date" type="date" value="{{ $task['date'] ? $task['date'] : '' }}">
                            @error('date')
                                <p class="form-alert">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-datetime-time">
                            <label for="form-time">時間 </label>
                            <input id="input-time" name="time" type="time" value="{{ $task['time'] ? $task['time'] : '' }}">
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
                            <li><input type="checkbox" id="1month" name="notify[]" value="month" onclick="inputNotifyCheck();" {{ in_array('month', $task['notify_date'], true) ? 'checked' : '' }}><label for="1month" class="checkbox">1ヶ月</label></li>
                            <li><input type="checkbox" id="3week" name="notify[]" value="21" onclick="inputNotifyCheck();" {{ in_array('21', $task['notify_date'], true) ? 'checked' : '' }}><label for="3week" class="checkbox">3週間</label></li>
                            <li><input type="checkbox" id="2week" name="notify[]" value="14" onclick="inputNotifyCheck();" {{in_array('14', $task['notify_date'], true) ? 'checked' : '' }}><label for="2week" class="checkbox" >2週間</label></li>
                            <li><input type="checkbox" id="1week" name="notify[]" value="7" onclick="inputNotifyCheck();" {{in_array('7', $task['notify_date'], true) ? 'checked' : '' }}><label for="1week" class="checkbox">1週間</label></li>
                        </ul>
                        <ul>
                            <li><input type="checkbox" id="6day" name="notify[]" value="6" onclick="inputNotifyCheck();" {{in_array('6', $task['notify_date'], true) ? 'checked' : '' }}><label for="6day" class="checkbox">6日</label></li>
                            <li><input type="checkbox" id="5day" name="notify[]" value="5" onclick="inputNotifyCheck();" {{in_array('5', $task['notify_date'], true) ? 'checked' : '' }}><label for="5day" class="checkbox">5日</label></li>
                            <li><input type="checkbox" id="4day" name="notify[]" value="4" onclick="inputNotifyCheck();" {{in_array('4', $task['notify_date'], true) ? 'checked' : '' }}><label for="4day" class="checkbox">4日</label></li>
                            <li><input type="checkbox" id="3day" name="notify[]" value="3" onclick="inputNotifyCheck();" {{in_array('3', $task['notify_date'], true) ? 'checked' : '' }}><label for="3day" class="checkbox">3日</label></li>
                            <li><input type="checkbox" id="2day" name="notify[]" value="2" onclick="inputNotifyCheck();" {{in_array('2', $task['notify_date'], true) ? 'checked' : '' }}><label for="2day" class="checkbox">2日</label></li>
                            <li><input type="checkbox" id="1day" name="notify[]" value="1" onclick="inputNotifyCheck();" {{in_array('1', $task['notify_date'], true) ? 'checked' : '' }}><label for="1day" class="checkbox">1日</label></li>
                        </ul>
                    </td>
                </tr>
            </table>
            <div class="form-submit">
                <input type="hidden" name="id" value="{{ $task['id'] }}">
                <input id="input-submit" class="input-submit" name="submit" type="submit" value="更新">
            </div>
        </form>
        <div class="destroy-link">
            <a class="destroy-link-show" href="javascript:;" onclick="displayControll('destroy')">削除する</a>
            <div id="destroy" class="destroy-content" style="display: none">
                <div class="destroy-content-link">
                    <p>このタスクを削除しますか？</p>
                    <div class="destroy-confirm">
                        <form action="{{ route('destroy') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $task['id'] }}">
                            <input type="submit" value="はい">
                        </form>
                        <a class="destroy" href="javascript:;" onclick="displayControll('destroy')">いいえ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
