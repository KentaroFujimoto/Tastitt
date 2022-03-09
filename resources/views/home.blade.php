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
        <div class="listSec-top">
            <img class="add-icon" src="{{ asset("image/ico_add.png") }}" alt="追加">
            <a class="add-text" href="{{ route('create') }}">タスクを追加</a>
        </div>
        <ul class="task-list">
            @foreach ($tasks as $task)
            <li>
                <div class="task-list-main">
                    <div class="task-list-various">
                        <p class="task-list-content">
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
                        <a class="task-list-notify" href="javascript:;" onclick="displayControll('<?php echo 'notify-'.$task['id'] ?>')">通知</a>
                    </div>
                </div>
                <div id="{{ "notify-".$task['id'] }}" class="task-list-sub" style="display: none">
                    <?php 
                    $notify_date = array(
                        $task['notify_date_1'],
                        $task['notify_date_2'],
                        $task['notify_date_3']
                    );
                    $notify_week = array(
                        $task['notify_week_1'],
                        $task['notify_week_2'],
                        $task['notify_week_3']
                    );

                    for ($i=0; $i<count($notify_date); $i++) : 
                        if (!empty($notify_date[$i])):
                    ?>
                    <p class="task-notify">
                        <?php
                        $notify_date_text = explode("-", $notify_date[$i]);

                        echo ltrim($notify_date_text[1], '0')."/".ltrim($notify_date_text[2], '0')."(".$notify_week[$i].") ";
                        ?>
                    </p>
                    <?php
                        endif;
                    endfor; 
                    ?>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</section>
@endsection
