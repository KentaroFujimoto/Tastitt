@extends('layouts.app')

@section('content')
<section class="listSec">
    <div class="container">
        <div class="listSec-top">
            <h2 class="listSec-title">タスク一覧</h2>
            <a class="add-icon" href="{{ route('create') }}">＋タスクを追加</a>
        </div>
        <table class="task-list" border="1">
            <tr>
                <th>タスク名</th>
                <th>追加日</th>
                <th>内容</th>
                <th>期限</th>
            </tr>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?php echo $task['title'];?></td>
                    <td><?php echo $task['created_at'];?></td>
                    <td><?php echo $task['content'];?></td>
                    <td><?php echo $task['updated_at'];?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</section>
@endsection
