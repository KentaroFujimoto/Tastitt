<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use DateTime;
use App\User;
use App\Task;
use DB;

class NotifyTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:NotifyTasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'タスク通知';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = new DateTime("now");
        $now_day = $now->format('Y-m-d');
        $now_time = $now->format('H:i');

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
                $date = new DateTime($task['date']);
                $interval = intval($now->diff($date)->format('%d')) + 1;
                $date = explode("-", $task['date']);
                $date = ltrim($date[1], '0')."/".ltrim($date[2], '0')."(".$task['week'].") ";
                $message = "\n".$interval."日前です\n".$task['content']."\n期限:".$date." ".$task['time'];

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
        
                $ch = curl_init('https://notify-api.line.me/api/notify');
                curl_setopt_array($ch, $options);
                curl_exec($ch);
                curl_close($ch);
            }

        }
    }
}
