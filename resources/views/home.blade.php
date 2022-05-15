@extends('layouts.app')

@section('content')
<section class="listSec">
    <div class="container">
        @if (session('message_success'))
            <p class="flash flash-success">{{ session('message_success') }}</p>
        @endif
        @if (session('message_failure'))
            <p class="flash flash-failure">{{ session('message_failure') }}</p>
        @endif
        <div id="task-complete" class="task-complete" style="display: none">
            <div class="display-confirm">
                <form class="form-complete" action="{{ route('complete') }}" method="post">
                    @csrf
                    <input class="input-complete-id" type="hidden" name="id" value="">
                    <input class="input-complete-yes" type="submit" value="タスクを完了する">
                </form>
                <a class="link-complete-no" href="javascript:;" onclick="taskComplete('task-complete', null)">キャンセル</a>
            </div>
        </div>
        <div class="listSec-top">
            <img class="add-icon" src="{{ asset("image/ico_add.png") }}" alt="追加">
            <a class="add-text" href="{{ route('create') }}">タスクを追加</a>
        </div>
        <ul class="task-list">
            @foreach ($tasks as $task)
            <li class="{{ $task['date'] < $today ? 'past-deadline' : '' }}">
                <div class="task-list-main">
                    <div class="task-list-various">
                        <p class="task-list-content">
                            @if ($task['date'] < $today)
                                <span class="past-deadline-txt">期限切れ</span>
                            @endif
                            <span 
                            class="task-list-level"
                            style="{{ $task['level'] === 1 ? 'display: inline' : 'display: none' }}"
                            >☆</span>
                            {!! nl2br(e($task['content'])) !!}
                        </p>
                        <p class="task-list-date">
                            <?php 
                            //日付表示
                            $date = explode("-", $task['date']);
                            echo ltrim($date[1], '0')."/".ltrim($date[2], '0')."(".$task['week'].") ";

                            //時間表示
                            if (!empty($task['time'])) {
                                $time = explode(":", $task['time']);
                                echo $time[0].":".$time[1];
                            }
                        ?>
                        </p>
                    </div>
                    <div class="task-list-operates">
                        <a class="task-list-edit" href="{{ route('edit', ['id' => $task['id']]) }}">編集</a>
                        <a class="task-list-notify" href="javascript:;" onclick="taskComplete('task-complete', '{{ $task['id'] }}')">完了</a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</section>
@endsection
