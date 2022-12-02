<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

trait HttpTrait
{
    private static function get(string $hostPath = '', string $query = null, array $headers = [])
    {
        $res = Http::asForm()->withHeaders($headers)->get($hostPath, $query);

        return $res->json();
    }

    private static function post(string $hostPath = '', array $params = [], array $headers = [])
    {
        $res = Http::asForm()->withHeaders($headers)->post($hostPath, $params);

        return $res->json();
    }
}

//trait CkyTrait
//{
//    private static function send($users, new InvoicePaid($invoice));
//}
