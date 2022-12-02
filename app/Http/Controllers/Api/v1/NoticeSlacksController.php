<?php

namespace App\Notifications;

use App\Notifications\slackNotification;
use Illuminate\Support\Facades\Notification;

class SlackNotificationUnit
{
    public static function exec($msgs = [], $to=0, $force = false): array
    {
        return self::setItem($msgs, $to, $force);
    }

    private static function setItem($msg, $to, $force): array
    {
      $outs = [];

      if (0) return $outs;

        try {
            Notification::route('slack',env( 'SLACK_WEBHOOK'))->notify(new slackNotification($msg, $to));
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
        return  $outs;
    }
}
