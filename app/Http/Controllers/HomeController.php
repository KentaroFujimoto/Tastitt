<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Services\PostControllService;
use App\User;
use App\Task;
use DB;
use Carbon\Carbon; 
use DateTime;

class HomeController extends Controller
{
    private $postControllService;

    public function __construct(PostControllService $postControllService)
    {
        $this->middleware('auth');
        $this->postControllService = $postControllService;
    }

    //タスク取得
    public function index()
    {
        $today = new DateTime('now');
        $today = $today->format('Y-m-d');

        $tasks = Task::where('user_id', '=', \Auth::id())
            ->orderBy('date', 'ASC')
            ->get();

        return view('home', compact('today', 'tasks'));
    }

    //タスク追加ページ遷移
    public function create()
    {
        return view('create');
    }

    //タスク追加
    public function store(PostStoreRequest $request)
    {
        $posts = $request->all(); 

        //重要がチェックされていたら1、されていなければ0。
        if (! isset($posts['level'])) {
            $posts['level'] = 0;
        }

        //時間が選択されていなければ00:00:00に。
        if (! isset($posts['time'])) {
            $posts['time'] = "00:00";
        }

        //期限曜日を追加。
        $week_array = array("日", "月", "火", "水", "木", "金", "土");
        $post_date = new DateTime($posts['date']);
        $week_key = intval($post_date->format('w'));
        $posts['week'] = $week_array[$week_key];

        //通知時間。
        if (isset($posts['time'])) {
            if ($posts['time'] !== "00:00") {
                $notify_time = explode(':', $posts['time']);
                if (intval($notify_time[1]) > 0 && intval($notify_time[1]) < 30) {
                    $posts['notify_time'] = $notify_time[0].":00";
                } else if (intval($notify_time[1]) > 30) {
                    $posts['notify_time'] = $notify_time[0].":30";
                } else {
                    $posts['notify_time'] = $posts['time'];
                }
            } else {
                $posts['notify_time'] = "00:00";
            }
        } else {
            $posts['notify_time'] = "00:00";
        }

        //通知日、通知曜日。
        for ($i=0; $i<3; $i++) {
            $date = new DateTime($posts['date']);
            if (! empty($posts['notify'][$i])) {
                $notify_date = $posts['notify'][$i];
                if ($notify_date === "month") {
                    $posts['notify_date'][$i] = $date->modify("-1 month")->format("Y-m-d");
                } else {
                    $posts['notify_date'][$i] = $date->modify("-${notify_date} day")->format("Y-m-d");
                }
                $post_notify_date = new DateTime($posts['notify_date'][$i]);
                $week_key = intval($post_notify_date->format('w'));
                $posts['notify_week'][$i] = $week_array[$week_key];
            } else {
                $posts['notify_date'][$i] = null;
                $posts['notify_week'][$i] = null;
            }
        }

        $create = $this->postControllService->postStore($posts);

        if (! $create) {
            session()->flash('message_failure', "タスクの追加に失敗しました");
            return redirect()->route('create');
        }

        session()->flash('message_success', "タスクを追加しました");
        return redirect()->route('home');
    }

    //タスク編集ページ遷移
    public function edit($id) 
    {
        $task = Task::where('user_id', '=', \Auth::id())
            ->where('id', '=', $id)
            ->first();

        $date = new DateTime($task['date']);
        $notify_date = [
            $task['notify_date_1'],
            $task['notify_date_2'],
            $task['notify_date_3']
        ];
        $task['notify_date'] = array();

        for ($i=0; $i<count($notify_date); $i++) {
            if ($notify_date[$i]) {
                $target = new DateTime($notify_date[$i]);
                $interval = $target->diff($date)->format('%d');
                $intervals[] = $interval;
            }
        }
        $task['notify_date'] = $intervals;

        return view('edit', compact('task'));
    }

    //タスク更新
    public function update(PostStoreRequest $request)
    {
        $posts = $request->all();

        //重要がチェックされていたら1、されていなければ0。
        if (! isset($posts['level'])) {
            $posts['level'] = 0;
        }

        //時間が選択されていなければ00:00:00に。
        if (! isset($posts['time'])) {
            $posts['time'] = "00:00";
        }

        //期限曜日を追加。
        $week_array = array("日", "月", "火", "水", "木", "金", "土");
        $post_date = new DateTime($posts['date']);
        $week_key = intval($post_date->format('w'));
        $posts['week'] = $week_array[$week_key];

         //通知時間。
        if (isset($posts['time'])) {
            if ($posts['time'] !== "00:00") {
                $notify_time = explode(':', $posts['time']);
                if (intval($notify_time[1]) > 0 && intval($notify_time[1]) < 30) {
                    $posts['notify_time'] = $notify_time[0].":00";
                } else if (intval($notify_time[1]) > 30) {
                    $posts['notify_time'] = $notify_time[0].":30";
                } else {
                    $posts['notify_time'] = $posts['time'];
                }
            } else {
                $posts['notify_time'] = "00:00";
            }
        } else {
            $posts['notify_time'] = "00:00";
        }

        //通知日、通知曜日。
        for ($i=0; $i<3; $i++) {
            $date = new DateTime($posts['date']);
            if (! empty($posts['notify'][$i])) {
                $notify_date = $posts['notify'][$i];
                if ($notify_date === "month") {
                    $posts['notify_date'][$i] = $date->modify("-1 month")->format("Y-m-d");
                } else {
                    $posts['notify_date'][$i] = $date->modify("-${notify_date} day")->format("Y-m-d");
                }
                $post_notify_date = new DateTime($posts['notify_date'][$i]);
                $week_key = intval($post_notify_date->format('w'));
                $posts['notify_week'][$i] = $week_array[$week_key];
            } else {
                $posts['notify_date'][$i] = null;
                $posts['notify_week'][$i] = null;
            }
        }

        $update = $this->postControllService->postUpdate($posts);

        if (! $update) {
            session()->flash('message_failure', "タスクの更新に失敗しました");
            return redirect()->route('edit');
        }

        session()->flash('message_success', "タスクを更新しました");
        return redirect()->route('home');
    }

    public function destroy(Request $request)
    {
        $posts = $request->all();
        
        if (! isset($posts['id'])) {
            return redirect()->rouet('edit');
        }

        $tasks = $this->postControllService->postDestroy($posts);

        if (! $tasks) {
            session()->flash('message_failure', "タスクの削除に失敗しました");
            return  redirect()->route('edit');
        }

        session()->flash('message_success', "タスクを削除しました");
        return redirect()->route('home');
    }

    public function complete(Request $request)
    {
        $posts = $request->only('id');
        
        $update = $this->postControllService->postComplete($posts);
    }

    public function test()
    {
        $ch = curl_init('https://notify-api.line.me/api/notify');

        $now = new DateTime("now");
        $now_day = $now->format('Y-m-d');
        $now_time = $now->format('H:i');
        $now_time = '10:00';

        $users = User::get();
        
        for ($i=0; $i<count($users); $i++) {
            $tasks = array();
            $line_token = $users[$i]['line_token'];

            $tasks = Task::where('user_id', '=', $users[$i]['id'])
                ->where('notify_time', '=', $now_time)
                ->where(function($query) use ($now_day){
                    $query->where(function($query) use ($now_day){
                        $query->where('notify_date_1', '=', $now_day);
                    })
                    ->orWhere(function($query) use ($now_day){
                        $query->where('notify_date_2', '=', $now_day);
                    })
                    ->orWhere(function($query) use ($now_day){
                        $query->where('notify_date_3', '=', $now_day);
                    });
                })
                ->get();

            foreach ($tasks as $task) {
                $date = explode("-", $task['date']);
                $date = ltrim($date[1], '0')."/".ltrim($date[2], '0')."(".$task['week'].") ";
                $message = "\n".$task['content']."\n期限:".$date." ".$task['time'];

                $query = http_build_query(['message' => $message]);
                $header = [
                        'Content-Type: application/x-www-form-urlencoded',
                        'Authorization: Bearer ' . $line_token,
                        'Content-Length: ' . strlen($query)
                ];
        
                $options = [
                    CURLOPT_RETURNTRANSFER  => true,
                    CURLOPT_POST            => true,
                    CURLOPT_HTTPHEADER      => $header,
                    CURLOPT_POSTFIELDS      => $query
                ];
        
                curl_setopt_array($ch, $options);
                curl_exec($ch);
                curl_close($ch);
            }

        }
    }
}
