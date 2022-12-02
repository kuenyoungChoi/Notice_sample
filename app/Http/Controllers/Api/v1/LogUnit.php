<?php

namespace App\Http\Controllers\Api\v1;



use App\Notifications\slackNotification;

class LogUnit
{
use HttpTrait;

const USER = [
  'ctr_task_progress' => 0,
  'date_updated' => 0,
  'id' => 0,
  'task_title' => '',
  'username' => '',
];

public static function exec(): void
{
    $outs = self::setItem();
    $outs = self::setItemMsg($outs);
    slackNotification::exec($outs);
}

private static function getTasks(): array
{
    $headers = ['Authorization' => env('CLICK_UP_TOKEN')];

    $url = 'https://api.clickup.com/api/v2/list/223020343/task';

    $query = 'archived=false&statuses[0]=in progress (처리중)';

    $outs = self::get($url, $query, $headers);
    return (isset($outs['tasks'])) ? $outs['tasks'] : [];
}

    private static function setItemMsg($items): array
    {
        $outs = [];

        try {
            foreach ($items as $item) {
                $outs[$item['id']] =
                    $item['username'] . '; ' .
                    '진행 ' . $item['ctr_task_progress'] . '; ' .
                    '변경 ' . otGetCarbon(($item['date_updated']) / 1000)->toDateTimeString() . '; ' .
                    $item['task_title'];
            }
        } catch (\Exception $e) {
            dump($e->getMessage());
        }

        return $outs;
    }


    private static function setItem(): array
    {
        $outs = [];

        try {
            $tasks = self::getTasks();
            foreach ($tasks as $task) {
                if(!(isset($task['assignees']))) continue;
                foreach ($task['assignees'] as $assignee) {
                    if(!(isset($outs[$assignee['id']]))) {
                        $outs[$assignee['id']] = self::USER;
                        $outs[$assignee['id']]['id'] = $assignee['id'];
                        $outs[$assignee['id']]['username'] = $assignee['username'];
                    }
                    $out = $outs[$assignee['id']];
                    $out['ctr_task_progress'] +=1;
                    $out['date_updated'] = (intval($out['date_updated']) < intval($task['date_updated'])) ? intval($task['date_updated']) : intval($out['date_updated']);
                    $out['task_title'] = $out['task_title'] . mb_substr($task['name'], 0, 20, 'UTF-8') . '; ';
                    $outs[$assignee['id']] = $out;
                    //$outs[$assignee['id']]['status'][$task['status']['status']][$task['id']] = [
                    //    'id' => $task['id'],
                    //    'name' => $task['name'],
                    //    'text_content' => mb_substr($task['text_content'], 0, 1024, 'UTF-8'),
                    //];
                }
            }
        } catch (\Exception $e) {
            dump($e->getMessage());
        }

        return $outs;
    }

}
