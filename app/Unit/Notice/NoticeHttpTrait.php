<?php

namespace App\Unit\Notice;

use Illuminate\Support\Facades\Http;

trait NoticeHttpTrait
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
