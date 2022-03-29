<?php

namespace App\Services;

use App\Task;

class PostControllService
{
    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function postStore($posts)
    {
        $create = Task::create([
            'user_id' => \Auth::id(),
            'content' => $posts['content'],
            'level' =>$posts['level'],
            'date' => $posts['date'],
            'week' => $posts['week'],
            'time' => $posts['time'],
            'notify_time' => $posts['notify_time'],
            'notify_date_1' => $posts['notify_date'][0],
            'notify_week_1' => $posts['notify_week'][0],
            'notify_date_2' => $posts['notify_date'][1],
            'notify_week_2' => $posts['notify_week'][1],
            'notify_date_3' => $posts['notify_date'][2],
            'notify_week_3' => $posts['notify_week'][2]
        ]);

        if ($create) {
            $return = true;
        } else {
            $return = false;
        }

        return $return;
    }

    public function postUpdate($posts)
    {
        $update = Task::where('user_id', '=', \Auth::id())
            ->where('id', '=', $posts['id'])
            ->update([
                'user_id' => \Auth::id(),
                'content' => $posts['content'],
                'level' =>$posts['level'],
                'date' => $posts['date'],
                'week' => $posts['week'],
                'time' => $posts['time'],
                'notify_time' => $posts['notify_time'],
                'notify_date_1' => $posts['notify_date'][0],
                'notify_week_1' => $posts['notify_week'][0],
                'notify_date_2' => $posts['notify_date'][1],
                'notify_week_2' => $posts['notify_week'][1],
                'notify_date_3' => $posts['notify_date'][2],
                'notify_week_3' => $posts['notify_week'][2]
            ]);
        
        if ($update) {
            $return = true;
        } else {
            $return = false;
        }
        
        return $return;
    }

    public function postDestroy($posts)
    {   
        $destroy = Task::destroy($posts['id']);

        if ($destroy !== 1) {
            $destroy = false;
        } else {
            $destroy = true;
        }

        return $destroy;
    }

    public function postComplete($posts)
    {   
        dd('here');
        $complete = Task::destroy($posts['id']);

        if ($destroy !== 1) {
            $destroy = false;
        } else {
            $destroy = true;
        }

        return $destroy;
    }
}