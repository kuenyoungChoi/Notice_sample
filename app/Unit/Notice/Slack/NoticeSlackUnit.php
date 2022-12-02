<?php

namespace App\Unit\Notice\Slack;

use App\Notifications\noticeSlackNotification;
use Illuminate\Support\Facades\Notification;

class NoticeSlackUnit
{
    public static function exec($msgs = [], $to = 0, $force = false): array
    {
        return self::setItem($msgs, $to, $force);
    }

    private static function setItem($msgs, $to, $force): array
    {
        $outs = [];

        if (0) return $outs;

        try {
            Notification::route('slack', env('SLACK_WEBHOOK'))->notify(new NoticeSlackNotification($msgs, $to));
        } catch (\Exception $e) {
            dump($e->getMessage());
        }

        return $outs;
    }
}
